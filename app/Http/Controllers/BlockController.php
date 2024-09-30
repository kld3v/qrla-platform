<?php

namespace App\Http\Controllers;
use App\Models\Venue;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Inertia\Inertia;

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
}