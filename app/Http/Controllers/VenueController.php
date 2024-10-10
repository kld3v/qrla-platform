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


        //TODO: REMOVE ALL HARDCODED DATA
        $row_2_data = [
            'total_venues'  => $total_venues,
            'total_plaques' => 100, // Hardcoded for now
            'total_visits'  => 200, // Hardcoded for now
        ];

        return Inertia::render('Venues/index', [
            'venues'     => $venues,
            'row_2_data' => $row_2_data,
        ]);
    }

    public function show(Venue $venue)
    {
        // $this->authorize('view', $venue);

        return Inertia('Venue/index', [
            'venue' => $venue
        ]);
    }
}