<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StatsOverTimeService;

class StatsController extends Controller
{
    protected $statsService;

    public function __construct(StatsOverTimeService $statsService)
    {
        $this->statsService = $statsService;
    }

    public function getAccessesOverTime(Request $request)
    {
        $type = $request->input('type'); // 'venue' or 'block'
        $id = $request->input('id');
        $startTime = $request->input('start_time');
        $endTime = $request->input('end_time');

        if (!$type || !$id || !$startTime || !$endTime) {
            return response()->json(['error' => 'Missing required parameters.'], 400);
        }

        try {
            $data = $this->statsService->getAccessesOverTime($type, $id, $startTime, $endTime);
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function getAccessesByBlock(Request $request)
    {
        $venueId = $request->input('venue_id');
        $startTime = $request->input('start_time');
        $endTime = $request->input('end_time');

        if (!$venueId || !$startTime || !$endTime) {
            return response()->json(['error' => 'Missing required parameters.'], 400);
        }

        try {
            $data = $this->statsService->getAccessesByBlock($venueId, $startTime, $endTime);
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function getAccessesByDeviceAndBrowser(Request $request)
    {
        $venueId = $request->input('venue_id');
        $blockId = $request->input('block_id');
        $startTime = $request->input('start_time');
        $endTime = $request->input('end_time');
    
        if (!$venueId && !$blockId) {
            return response()->json(['error' => 'Either venue_id or block_id must be provided.'], 400);
        }
    
        try {
            $data = $this->statsService->getAccessesByDeviceAndBrowser($venueId, $blockId, $startTime, $endTime);
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
    
}
