<?php

namespace App\Http\Controllers;
use App\Models\Venue;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Block;

class BlockController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request, Venue $venue)
    {
        $this->authorize('viewBlocks', $venue);

        $stands = $venue->stands()
                        ->with(['blocks' => function ($query) {
                            $query->select('id', 'name', 'stand_id');
                        }])
                        ->select('id', 'name', 'venue_id')
                        ->get();

        return Inertia::render('Blocks/Index', [
            'venue' => $venue,
            'stands' => $stands,
        ]);
    }

    public function showStats(Request $request, Venue $venue)
    {
        $this->authorize('viewBlocks', $venue);
    
        $stands = $venue->stands()
                        ->with(['blocks' => function ($query) {
                            $query->select('id', 'name', 'stand_id');
                        }])
                        ->select('id', 'name', 'venue_id')
                        ->get();
    
        foreach ($stands as $stand) {
            foreach ($stand->blocks as $block) {
                $totalSeatVisits = $block->seatAccessCounts()->sum('total_count');
                $totalBlockVisits = $block->blockAccessCounts()->sum('total_count');
                $totalVisits = $totalSeatVisits + $totalBlockVisits;
    
                $block->stats = [
                    'total_seat_visits' => $totalSeatVisits,
                    'total_block_visits' => $totalBlockVisits,
                    'total_visits' => $totalVisits,
                ];
            }
        }

        return Inertia::render('BlockStats/index', [
            'venue' => $venue,
            'stands' => $stands,
        ]);
    }
    
}

