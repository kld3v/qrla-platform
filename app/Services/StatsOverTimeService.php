<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\AccessLog;
use App\Models\Venue;
use App\Models\Block;
use App\Models\Seat;
use App\Models\Marker;
use Illuminate\Support\Facades\Log;

class StatsOverTimeService
{
    public function getAccessesOverTime($type, $id, $startTime, $endTime)
    {
        // Determine the appropriate time interval
        $interval = $this->determineInterval($startTime, $endTime);

        if ($type === 'venue') {
            $venue = Venue::findOrFail($id);

            // Get seat markers within the venue
            $seatMarkerIds = $this->getSeatMarkerIdsForVenue($venue);

            // Get block markers within the venue
            $blockMarkerIds = $this->getBlockMarkerIdsForVenue($venue);

        } elseif ($type === 'block') {
            $block = Block::findOrFail($id);

            // Get seat markers within the block
            $seatMarkerIds = $this->getSeatMarkerIdsForBlock($block);

            // Get block marker IDs (only the current block)
            $blockMarkerIds = $block->markers()->pluck('id')->toArray();
        } else {
            throw new \Exception('Invalid type parameter.');
        }

        // Get seat access counts over time
        $seatAccessCounts = $this->getAccessCountsOverTime($seatMarkerIds, $interval, $startTime, $endTime);

        // Get block access counts over time
        $blockAccessCounts = $this->getAccessCountsOverTime($blockMarkerIds, $interval, $startTime, $endTime);

        // Combine the counts into the desired format
        $allTimeGroups = array_unique(array_merge(array_keys($seatAccessCounts), array_keys($blockAccessCounts)));
        sort($allTimeGroups);

        $result = [];
        foreach ($allTimeGroups as $timeGroup) {
            $seatCount = isset($seatAccessCounts[$timeGroup]) ? $seatAccessCounts[$timeGroup] : 0;
            $blockCount = isset($blockAccessCounts[$timeGroup]) ? $blockAccessCounts[$timeGroup] : 0;
            $totalCount = $seatCount + $blockCount;

            $result[] = [
                'time_group' => $timeGroup,
                'total_access_count' => $totalCount,
                'seat_access_count' => $seatCount,
                'block_access_count' => $blockCount,
            ];
        }

        return $result;
    }


    private function determineInterval($startTime, $endTime)
    {
        $start = Carbon::parse($startTime);
        $end = Carbon::parse($endTime);
        $diffInSeconds = $start->diffInSeconds($end);

        if ($diffInSeconds <= 3600) { // 1 hour
            return ['unit' => 'minute', 'format' => '%Y-%m-%d %H:%i'];
        } elseif ($diffInSeconds <= 86400) { // 1 day
            return ['unit' => 'hour', 'format' => '%Y-%m-%d %H:00'];
        } elseif ($diffInSeconds <= 604800) { // 1 week
            return ['unit' => 'day', 'format' => '%Y-%m-%d'];
        } elseif ($diffInSeconds <= 2592000) { // 1 month
            return ['unit' => 'day', 'format' => '%Y-%m-%d'];
        } elseif ($diffInSeconds <= 31536000) { // 1 year
            return ['unit' => 'month', 'format' => '%Y-%m'];
        } else {
            return ['unit' => 'year', 'format' => '%Y'];
        }
    }

    private function getSeatMarkerIdsForVenue($venue)
    {
        return Marker::whereHasMorph('markerable', 'seat', function ($query) use ($venue) {
            $query->whereHas('block.stand', function ($query) use ($venue) {
                $query->where('venue_id', $venue->id);
            });
        })->pluck('id')->toArray();
    }

    private function getBlockMarkerIdsForVenue($venue)
    {
        return Marker::whereHasMorph('markerable', 'block', function ($query) use ($venue) {
            $query->whereHas('stand', function ($query) use ($venue) {
                $query->where('venue_id', $venue->id);
            });
        })->pluck('id')->toArray();
    }

    private function getSeatMarkerIdsForBlock($block)
    {
        return Marker::whereHasMorph('markerable', 'seat', function ($query) use ($block) {
            $query->where('block_id', $block->id);
        })->pluck('id')->toArray();
    }

    private function getAccessCountsOverTime($markerIds, $interval, $startTime, $endTime)
    {
        if (empty($markerIds)) {
            return [];
        }

        return AccessLog::whereIn('marker_id', $markerIds)
            ->whereBetween('accessed_at', [$startTime, $endTime])
            ->select([
                DB::raw("DATE_FORMAT(accessed_at, '{$interval['format']}') as time_interval"),
                DB::raw('COUNT(*) as count'),
            ])
            ->groupBy('time_interval')
            ->orderBy('time_interval')
            ->pluck('count', 'time_interval')
            ->toArray();
    }

}
