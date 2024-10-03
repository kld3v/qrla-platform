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
use App\Services\StatsOverTimeService;

class StatsController extends Controller
{
    public function getAccessesOverTime(Request $request, StatsOverTimeService $statsOverTimeService)
    {
        $this->validateRequest($request);

        $venueId   = $request->input('venue_id');
        $blockId   = $request->input('block_id');
        $startTime = Carbon::parse($request->input('start_time'));
        $endTime   = Carbon::parse($request->input('end_time'));
        $groupByFormat = $statsOverTimeService->getTimeGroupFormat($startTime, $endTime);

        try {
            $results = $statsOverTimeService->getAccessLogs($venueId, $blockId, $startTime, $endTime, $groupByFormat);
            return response()->json($results);
        } catch (\Exception $e) {
            Log::error('Error fetching access logs', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'An error occurred while fetching data.'], 500);
        }
    }

    public function getAccessesByDeviceAndBrowser(Request $request, StatsOverTimeService $statsOverTimeService)
    {
        $this->validateRequest($request);

        $venueId   = $request->input('venue_id');
        $blockId   = $request->input('block_id');
        $startTime = Carbon::parse($request->input('start_time'));
        $endTime   = Carbon::parse($request->input('end_time'));

        try {
            $results = $statsOverTimeService->getAccessLogsByDeviceAndBrowser($venueId, $blockId, $startTime, $endTime);
            return response()->json($results);
        } catch (\Exception $e) {
            Log::error('Error fetching access logs by device and browser', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'An error occurred while fetching data.'], 500);
        }
    }

    public function getAccessesByBlockForVenue(Request $request, StatsOverTimeService $statsOverTimeService)
    {
        // Validate the request inputs
        $request->validate([
            'venue_id'   => 'required|exists:venues,id',
            'start_time' => 'required|date_format:Y-m-d H:i:s',
            'end_time'   => 'required|date_format:Y-m-d H:i:s|after:start_time',
        ]);

        $venueId   = $request->input('venue_id');
        $startTime = Carbon::parse($request->input('start_time'));
        $endTime   = Carbon::parse($request->input('end_time'));

        try {
            $results = $statsOverTimeService->getAccessesByBlockForVenue($venueId, $startTime, $endTime);
            return response()->json($results);
        } catch (\Exception $e) {
            Log::error('Error fetching accesses by block for venue', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'An error occurred while fetching data.'], 500);
        }
    }

    private function validateRequest(Request $request)
    {
        return $request->validate([
            'venue_id' => 'required_without:block_id|exists:venues,id',
            'block_id' => 'required_without:venue_id|exists:blocks,id',
            'start_time' => 'required|date_format:Y-m-d H:i:s',
            'end_time' => 'required|date_format:Y-m-d H:i:s|after:start_time',
        ]);
    }
}
