<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\AccessLog;
use App\Models\Marker;
use App\Models\Block;
use App\Models\Stand;
use App\Models\Venue;

class StatsController extends Controller
{
    /**
     * Get the number of accesses over time for a venue or block.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAccessesOverTime(Request $request)
    {
        $venueId   = $request->input('venue_id');
        $blockId   = $request->input('block_id');
        $startTime = $request->input('start_time');
        $endTime   = $request->input('end_time');

        // Validate inputs
        if (!$venueId && !$blockId) {
            Log::error('Validation failed: Either venue_id or block_id is required.');
            return response()->json(['error' => 'Either venue_id or block_id is required.'], 400);
        }

        if (!$startTime || !$endTime) {
            Log::error('Validation failed: Start time and end time are required.');
            return response()->json(['error' => 'Start time and end time are required.'], 400);
        }

        try {
            $startTime = Carbon::parse($startTime);
            $endTime   = Carbon::parse($endTime);
            Log::info('Parsed start and end times successfully', [
                'start_time' => $startTime,
                'end_time' => $endTime
            ]);
        } catch (\Exception $e) {
            Log::error('Invalid date format for start_time or end_time', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'Invalid date format for start_time or end_time.'], 400);
        }

        if ($startTime->greaterThan($endTime)) {
            Log::error('Validation failed: start_time must be before end_time.');
            return response()->json(['error' => 'start_time must be before end_time.'], 400);
        }

        // Determine time grouping format based on the time range
        $groupByFormat = $this->getTimeGroupFormat($startTime, $endTime);

        // Build the query
        $query = AccessLog::query()
            ->join('markers', 'access_logs.marker_id', '=', 'markers.id');

        if ($blockId) {
            $query->where('markers.markerable_type', '=', Block::class)
                ->where('markers.markerable_id', '=', $blockId);
        } elseif ($venueId) {
            // Join with blocks, stands, and venues to filter markers for the venue
            $query->join('blocks', function ($join) {
                $join->on('markers.markerable_id', '=', 'blocks.id')
                    ->where('markers.markerable_type', '=', Block::class);
            })
                ->join('stands', 'blocks.stand_id', '=', 'stands.id')
                ->join('venues', 'stands.venue_id', '=', 'venues.id')
                ->where('venues.id', '=', $venueId);
        }

        $query->whereBetween('access_logs.accessed_at', [$startTime, $endTime]);

        try {
            $query = AccessLog::query()
                ->join('markers', 'access_logs.marker_id', '=', 'markers.id')
                ->join('blocks', function ($join) {
                    $join->on('markers.markerable_id', '=', 'blocks.id')
                        ->where('markers.markerable_type', '=', 'block');
                })
                ->join('stands', 'blocks.stand_id', '=', 'stands.id')
                ->join('venues', 'stands.venue_id', '=', 'venues.id')
                ->where('venues.id', '=', $venueId)
                ->whereBetween('access_logs.accessed_at', [$startTime, $endTime])
                ->select(DB::raw("
                COUNT(*) as access_count,
                DATE_FORMAT(access_logs.accessed_at, '$groupByFormat') as time_group
            "))
                ->groupBy('time_group')
                ->orderBy('time_group');

            Log::info('Raw SQL', [
                'sql' => $query->toSql(),
                'bindings' => $query->getBindings()
            ]);

            $results = $query->get();



            return response()->json($results);
        } catch (\Exception $e) {
            Log::error('Error executing query', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'An error occurred while fetching data.'], 500);
        }
    }

    /**
     * Determine the appropriate time grouping format based on the time range.
     *
     * @param  \Carbon\Carbon  $startTime
     * @param  \Carbon\Carbon  $endTime
     * @return string
     */
    private function getTimeGroupFormat($startTime, $endTime)
    {
        $diffInMinutes = $startTime->diffInMinutes($endTime);
        $diffInDays    = $startTime->diffInDays($endTime);
        $diffInMonths  = $startTime->diffInMonths($endTime);

        Log::info('Calculating time group format', [
            'diff_in_minutes' => $diffInMinutes,
            'diff_in_days' => $diffInDays,
            'diff_in_months' => $diffInMonths
        ]);

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
