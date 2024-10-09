<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Venue;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class VenueController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $user = auth()->user()->load('organisation', 'venues');
    
        $venues = $user->venues;

        $total_venues = $venues->count();
        $total_plaques = $venues->sum('plaques');
        $total_accesses = $venues->sum('accesses');
    
        $stats = [
            'total_venues'  => $total_venues,
            'total_plaques' => $total_plaques,
            'total_visits'  => $total_accesses,
        ];
    
        return Inertia::render('JoelTemplates/Venues/Index', [
            'user' => $user,
            'stats' => $stats,
            'venues' => $venues,
        ]);
    }
    

    public function show(Venue $venue)
    {
        $this->authorize('view', $venue);

        $venue->load('organisation');

        return inertia('Venues/Show', [
            'venue' => $venue
        ]);
    }
}
