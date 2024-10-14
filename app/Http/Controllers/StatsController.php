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
        $venueId = $request->input('venue_id');
        $blockId = $request->input('block_id');
        $startTime = $request->input('start_time');
        $endTime = $request->input('end_time');
    
        if ((!$venueId && !$blockId) || !$startTime || !$endTime) {
            return response()->json(['error' => 'Missing required parameters.'], 400);
        }
    
        try {
            if ($venueId) {
                $data = $this->statsService->getAccessesOverTime('venue', $venueId, $startTime, $endTime);
            } elseif ($blockId) {
                $data = $this->statsService->getAccessesOverTime('block', $blockId, $startTime, $endTime);
            } else {
                throw new \Exception('Either venue_id or block_id must be provided.');
            }
    
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

    public function getAccessesByOsAndBrowser(Request $request)
    {
        $venueId = $request->input('venue_id');
        $blockId = $request->input('block_id');
        $startTime = $request->input('start_time');
        $endTime = $request->input('end_time');
    
        if (!$venueId && !$blockId) {
            return response()->json(['error' => 'Either venue_id or block_id must be provided.'], 400);
        }
    
        try {
            $data = $this->statsService->getAccessesByOsAndBrowser($venueId, $blockId, $startTime, $endTime);
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }    
    
    public function getAccessesByMarkerType(Request $request)
    {
        $venueId = $request->input('venue_id');
        $blockId = $request->input('block_id');
        $startTime = $request->input('start_time');
        $endTime = $request->input('end_time');

        if (!$venueId && !$blockId) {
            return response()->json(['error' => 'Either venue_id or block_id must be provided.'], 400);
        }

        try {
            $data = $this->statsService->getAccessesByMarkerType($venueId, $blockId, $startTime, $endTime);
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

}
