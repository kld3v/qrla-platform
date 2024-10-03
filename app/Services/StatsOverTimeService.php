<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Models\AccessLog;
use App\Models\Seat;

class StatsOverTimeService
{
    public function getAccessLogs($venueId, $blockId, Carbon $startTime, Carbon $endTime, $groupByFormat)
    {
        $query = $this->buildBaseQuery();

        if ($blockId) {
            $query = $this->applyBlockFilter($query, $blockId);
        } elseif ($venueId) {
            $query = $this->applyVenueFilter($query, $venueId);
        }

        $results = $this->fetchResults($query, $startTime, $endTime, $groupByFormat);

        $completeResults = $this->formatResults($results, $startTime, $endTime, $groupByFormat);

        return $completeResults->values();
    }

    /**
     * Build the base query for fetching access logs.
     */
    private function buildBaseQuery()
    {
        return AccessLog::query()
            ->join('markers', 'access_logs.marker_id', '=', 'markers.id');
    }

    /**
     * Apply block-specific filters to the query.
     */
    private function applyBlockFilter($query, $blockId)
    {
        $seatIds = $this->getSeatIdsByBlock($blockId);

        $query->where(function ($query) use ($blockId, $seatIds) {
            $query->where(function ($query) use ($blockId) {
                $query->where('markers.markerable_type', 'block')
                      ->where('markers.markerable_id', $blockId);
            })->orWhere(function ($query) use ($seatIds) {
                $query->where('markers.markerable_type', 'seat')
                      ->whereIn('markers.markerable_id', $seatIds);
            });
        });

        return $query;
    }

    /**
     * Apply venue-specific filters to the query.
     */
    private function applyVenueFilter($query, $venueId)
    {
        $query->join('blocks', function ($join) {
                $join->on('markers.markerable_id', '=', 'blocks.id')
                     ->where('markers.markerable_type', 'block');
            })
            ->join('stands', 'blocks.stand_id', '=', 'stands.id')
            ->join('venues', 'stands.venue_id', '=', 'venues.id')
            ->where('venues.id', $venueId);

        $seatIds = $this->getSeatIdsByVenue($venueId);

        $query->orWhere(function ($query) use ($seatIds) {
            $query->where('markers.markerable_type', 'seat')
                  ->whereIn('markers.markerable_id', $seatIds);
        });

        return $query;
    }

    /**
     * Fetch results from the database based on the built query.
     */
    private function fetchResults($query, Carbon $startTime, Carbon $endTime, $groupByFormat)
    {
        return $query->whereBetween('access_logs.accessed_at', [$startTime, $endTime])
            ->select(DB::raw("
                DATE_FORMAT(access_logs.accessed_at, '$groupByFormat') as time_group,
                COUNT(*) as total_access_count,
                SUM(CASE WHEN markers.markerable_type = 'seat' THEN 1 ELSE 0 END) as seat_access_count,
                SUM(CASE WHEN markers.markerable_type = 'block' THEN 1 ELSE 0 END) as block_access_count
            "))
            ->groupBy('time_group')
            ->orderBy('time_group')
            ->get()
            ->keyBy('time_group');
    }

    /**
     * Format the results to include all time groups, even those with zero counts.
     */
    private function formatResults($results, Carbon $startTime, Carbon $endTime, $groupByFormat)
    {
        $allTimeGroups = $this->generateTimeGroups($startTime, $endTime, $groupByFormat);

        return $allTimeGroups->map(function ($timeGroup) use ($results) {
            $timeGroupKey = $timeGroup->format('Y-m-d H:i:s');
            $data = $results->get($timeGroupKey, [
                'time_group'          => $timeGroupKey,
                'total_access_count'  => 0,
                'seat_access_count'   => 0,
                'block_access_count'  => 0,
            ]);

            return [
                'time_group'          => $timeGroupKey,
                'total_access_count'  => (int) $data['total_access_count'],
                'seat_access_count'   => (int) $data['seat_access_count'],
                'block_access_count'  => (int) $data['block_access_count'],
            ];
        });
    }

    /**
     * Get seat IDs associated with a specific block.
     */
    private function getSeatIdsByBlock($blockId)
    {
        return Seat::where('block_id', $blockId)->pluck('id');
    }

    /**
     * Get seat IDs associated with a specific venue.
     */
    private function getSeatIdsByVenue($venueId)
    {
        return Seat::join('blocks', 'seats.block_id', '=', 'blocks.id')
            ->join('stands', 'blocks.stand_id', '=', 'stands.id')
            ->where('stands.venue_id', $venueId)
            ->pluck('seats.id');
    }

    /**
     * Generate all time groups between the start and end times.
     */
    private function generateTimeGroups(Carbon $startTime, Carbon $endTime, $groupByFormat): Collection
    {
        $timeGroups = collect();
        $current = $this->alignToTimeGroup($startTime->copy(), $groupByFormat);
    
        while ($current->lessThanOrEqualTo($endTime)) {
            $timeGroups->push($current->copy());
            $current = $this->incrementTime($current, $groupByFormat);
        }
    
        return $timeGroups;
    }
    
    private function alignToTimeGroup(Carbon $time, $groupByFormat)
    {
        if (strpos($groupByFormat, '%Y-%m-%d %H:%i') !== false) {
            return $time->startOfMinute();
        } elseif (strpos($groupByFormat, '%Y-%m-%d %H') !== false) {
            return $time->startOfHour();
        } elseif (strpos($groupByFormat, '%Y-%m-%d') !== false) {
            return $time->startOfDay();
        } elseif (strpos($groupByFormat, '%Y-%m') !== false) {
            return $time->startOfMonth();
        } else {
            return $time->startOfYear();
        }
    }
    

    /**
     * Increment the time based on the group by format.
     */
    private function incrementTime(Carbon $time, $groupByFormat): Carbon
    {
        // Determine the increment based on the groupByFormat
        if (strpos($groupByFormat, '%Y-%m-%d %H:%i') !== false) {
            // Minute level
            return $time->addMinute();
        } elseif (strpos($groupByFormat, '%Y-%m-%d %H') !== false) {
            // Hour level
            return $time->addHour();
        } elseif (strpos($groupByFormat, '%Y-%m-%d') !== false) {
            // Day level
            return $time->addDay();
        } elseif (strpos($groupByFormat, '%Y-%m') !== false) {
            // Month level
            return $time->addMonth();
        } else {
            // Year level
            return $time->addYear();
        }
    }

    /**
     * Determine the time group format based on the time difference.
     */
    public function getTimeGroupFormat(Carbon $startTime, Carbon $endTime)
    {
        $diffInMinutes = $startTime->diffInMinutes($endTime);
        $diffInDays    = $startTime->diffInDays($endTime);
        $diffInMonths  = $startTime->diffInMonths($endTime);

        if ($diffInMinutes <= 60) {
            return '%Y-%m-%d %H:%i:00';
        } elseif ($diffInMinutes <= 60 * 24) {
            return '%Y-%m-%d %H:00:00';
        } elseif ($diffInDays <= 31) {
            return '%Y-%m-%d 00:00:00';
        } elseif ($diffInMonths <= 12) {
            return '%Y-%m-01 00:00:00';
        } else {
            return '%Y-01-01 00:00:00';
        }
    }
}
