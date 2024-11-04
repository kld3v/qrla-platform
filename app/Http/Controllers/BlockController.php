<?php

namespace App\Http\Controllers;
use App\Models\Venue;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Block;
use App\Models\BaseUrl;

class BlockController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request, Venue $venue)
    {
        $this->authorize('viewBlocks', $venue);

        $stands = $venue->stands()
                        ->with('blocks.redirect.baseUrl')
                        ->select('id', 'name', 'venue_id')
                        ->get();

        return Inertia::render('PlaqueManagement/index', [
            'venue' => $venue,
            'stands' => $stands,
            'nav'=>'plaque_management'
        ]);
    }

    public function showStats(Request $request, Venue $venue)
    {
        $this->authorize('viewBlocks', $venue);
    
        $stands = $venue->stands()
            ->with(['blocks.redirect.baseUrl'])
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
            'nav'=>'block_performance'
        ]);
    }

    public function assignBaseUrl(Request $request, Venue $venue)
    {
        $data = $request->validate([
            'url' => 'required|url',
            'blocks' => 'required|array',
            'blocks.*' => 'integer|exists:blocks,id'
        ]);

        $blocks = Block::whereIn('id', $data['blocks'])->get();

        if ($blocks->isEmpty()) {
            return response()->json(['message' => 'No valid blocks found'], 404);
        }

        $blocksVenueIds = $blocks->pluck('stand.venue_id')->unique();
        if ($blocksVenueIds->count() > 1 || $blocksVenueIds->first() != $venue->id) {
            return response()->json(['message' => 'Blocks do not belong to the same venue'], 403);
        }

        $this->authorize('editVenue', $venue);

        $baseUrl = BaseUrl::create(['url' => $data['url']]);

        $baseUrl = BaseUrl::create(['url' => $data['url']]);

        $updatedBlocks = [];
    
        foreach ($blocks as $block) {
            $existingRedirect = $block->redirect;
    
            if ($existingRedirect) {
                $newRedirect = $existingRedirect->replicate();
                $newRedirect->base_url_id = $baseUrl->id;
                $newRedirect->save();

                $block->update(['redirect_id' => $newRedirect->id]);
                $updatedBlocks[] = $block;
            }
        }
        
        return response()->json([
            'message' => 'BaseUrl and associated Redirects successfully assigned to blocks',
            'base_url' => $baseUrl,
            'updated_blocks' => $updatedBlocks
        ]);    
    }
    
}