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
        $user = auth()->user();

        $venues = $user->venues()->get();

        $total_venues = $user->venues()->count();

        $total_plaques = $venues->sum('plaques');
        $total_accesses = $venues->sum('accesses');

        $row_2_data = [
            'total_venues'  => $total_venues,
            'total_plaques' => $total_plaques,
            'total_visits'  => $total_accesses,
        ];

        return Inertia::render('JoelTemplates/Venues/Index', [
            'venues'     => $venues,
            'row_2_data' => $row_2_data,
        ]);
    }

    public function show(Venue $venue)
    {
        $this->authorize('view', $venue);

        return inertia('Venues/Show', [
            'venue' => $venue
        ]);
    }
}
