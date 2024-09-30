<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Models\AccessLog;

class StatsOverTimeService
{
    public function getAccessLogs($venueId, $blockId, Carbon $startTime, Carbon $endTime, $groupByFormat)
    {
        $query = AccessLog::query()
            ->join('markers', 'access_logs.marker_id', '=', 'markers.id');

        if ($blockId) {
            $query->where('markers.markerable_type', 'block')
                ->where('markers.markerable_id', $blockId);
        } elseif ($venueId) {
            $query->join('blocks', function ($join) {
                $join->on('markers.markerable_id', '=', 'blocks.id')
                    ->where('markers.markerable_type', 'block');
            })
                ->join('stands', 'blocks.stand_id', '=', 'stands.id')
                ->join('venues', 'stands.venue_id', '=', 'venues.id')
                ->where('venues.id', $venueId);
        }

        $results = $query->whereBetween('access_logs.accessed_at', [$startTime, $endTime])
            ->select(DB::raw("
                COUNT(*) as access_count,
                DATE_FORMAT(access_logs.accessed_at, '$groupByFormat') as time_group
            "))
            ->groupBy('time_group')
            ->orderBy('time_group')
            ->get()
            ->keyBy('time_group');

        $allTimeGroups = $this->generateTimeGroups($startTime, $endTime, $groupByFormat);

        $completeResults = $allTimeGroups->map(function ($timeGroup) use ($results) {
            return [
                'time_group'    => $timeGroup->format('Y-m-d H:i:s'),
                'access_count'  => $results->has($timeGroup->format('Y-m-d H:i:s')) ? $results->get($timeGroup->format('Y-m-d H:i:s'))->access_count : 0,
            ];
        });

        return $completeResults->values();
    }

    private function generateTimeGroups(Carbon $startTime, Carbon $endTime, $groupByFormat): Collection
    {
        $timeGroups = collect();
        $current = $startTime->copy();

        while ($current->lessThanOrEqualTo($endTime)) {
            $timeGroups->push($current->copy());
            $current = $this->incrementTime($current, $groupByFormat);
        }

        return $timeGroups;
    }

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
