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

        // Generate all time groups between startTime and endTime
        $allTimeGroups = $this->generateTimeGroups($startTime, $endTime, $interval);

        // Combine the counts into the desired format
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

    public function getAccessesByBlock($venueId, $startTime, $endTime)
    {
        $venue = Venue::findOrFail($venueId);

        // Get all blocks in the venue
        $blocks = Block::whereHas('stand', function ($query) use ($venueId) {
            $query->where('venue_id', $venueId);
        })->get();

        $blockData = [];
        $totalAccessCount = 0;

        foreach ($blocks as $block) {
            $markerIds = $this->getMarkerIdsForBlock($block);

            $accessCount = 0;
            if (!empty($markerIds)) {
                $accessCount = AccessLog::whereIn('marker_id', $markerIds)
                    ->whereBetween('accessed_at', [$startTime, $endTime])
                    ->count();
            }

            $totalAccessCount += $accessCount;

            $blockData[] = [
                'block_id' => $block->id,
                'block_name' => $block->name,
                'access_count' => $accessCount,
                // 'access_percent' will be calculated later
            ];
        }

        // Calculate access percentages
        foreach ($blockData as &$data) {
            if ($totalAccessCount > 0) {
                $data['access_percent'] = round(($data['access_count'] / $totalAccessCount) * 100, 2);
            } else {
                $data['access_percent'] = 0;
            }
        }

        // Sort the data by access_count descending
        usort($blockData, function ($a, $b) {
            return $b['access_count'] <=> $a['access_count'];
        });

        return $blockData;
    }

    public function getAccessesByDeviceAndBrowser($venueId, $blockId, $startTime, $endTime)
    {
        if ($venueId) {
            $venue = Venue::findOrFail($venueId);
            $markerIds = $this->getMarkerIdsForVenue($venue);
        } elseif ($blockId) {
            $block = Block::findOrFail($blockId);
            $markerIds = $this->getMarkerIdsForBlock($block);
        } else {
            throw new \Exception('Either venue_id or block_id must be provided.');
        }

        if (empty($markerIds)) {
            $devices = [];
            $browsers = [];
        } else {
            $devices = AccessLog::whereIn('marker_id', $markerIds)
                ->whereBetween('accessed_at', [$startTime, $endTime])
                ->select('device', DB::raw('COUNT(*) as access_count'))
                ->groupBy('device')
                ->orderBy('access_count', 'desc')
                ->get()
                ->map(function ($item) {
                    return [
                        'device' => $item->device ?: 'Unknown',
                        'access_count' => $item->access_count,
                    ];
                })
                ->toArray();

            $browsers = AccessLog::whereIn('marker_id', $markerIds)
                ->whereBetween('accessed_at', [$startTime, $endTime])
                ->select('browser', DB::raw('COUNT(*) as access_count'))
                ->groupBy('browser')
                ->orderBy('access_count', 'desc')
                ->get()
                ->map(function ($item) {
                    return [
                        'browser' => $item->browser ?: 'Unknown',
                        'access_count' => $item->access_count,
                    ];
                })
                ->toArray();
        }

        return [
            'devices' => $devices,
            'browsers' => $browsers,
        ];
    }


    private function generateTimeGroups($startTime, $endTime, $interval)
    {
        $start = Carbon::parse($startTime);
        $end = Carbon::parse($endTime);

        $allTimeGroups = [];
        $current = $start->copy();

        $phpDateFormat = $this->phpDateFormatFromMysqlFormat($interval['format']);

        while ($current <= $end) {
            $timeGroup = $current->format($phpDateFormat);
            $allTimeGroups[] = $timeGroup;

            // Increment current based on interval unit
            switch ($interval['unit']) {
                case 'minute':
                    $current->addMinute();
                    break;
                case 'hour':
                    $current->addHour();
                    break;
                case 'day':
                    $current->addDay();
                    break;
                case 'week':
                    $current->addWeek();
                    break;
                case 'month':
                    $current->addMonth();
                    break;
                case 'year':
                    $current->addYear();
                    break;
                default:
                    throw new \Exception('Invalid interval unit.');
            }
        }

        return $allTimeGroups;
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

    private function getMarkerIdsForVenue($venue)
    {
        $seatMarkerIds = $this->getSeatMarkerIdsForVenue($venue);
        $blockMarkerIds = $this->getBlockMarkerIdsForVenue($venue);

        return array_merge($seatMarkerIds, $blockMarkerIds);
    }

    private function getMarkerIdsForBlock($block)
    {
        $seatMarkerIds = $this->getSeatMarkerIdsForBlock($block);
        $blockMarkerIds = $block->markers()->pluck('id')->toArray();

        return array_merge($seatMarkerIds, $blockMarkerIds);
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

    private function phpDateFormatFromMysqlFormat($mysqlFormat)
    {
        $replacements = [
            '%Y' => 'Y',
            '%m' => 'm',
            '%d' => 'd',
            '%H' => 'H',
            '%i' => 'i',
            '%s' => 's',
            '%M' => 'F',
            '%b' => 'M',
            '%h' => 'h',
            '%p' => 'A',
            '%a' => 'a',
            '%W' => 'l',
            '%w' => 'w',
            '%U' => 'W',
            '%y' => 'y',
            '%C' => '', // Century (not directly supported in PHP)
            '%e' => 'j',
            '%f' => 'u',
            '%k' => 'G',
            '%l' => 'g',
            '%r' => 'h:i:s A',
            '%T' => 'H:i:s',
            '%S' => 's',
            '%V' => 'W',
        ];

        return strtr($mysqlFormat, $replacements);
    }
}
