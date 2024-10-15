<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Venue;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Jobs\ProcessVenueOnboardingJob;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;



class VenueController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $user = auth()->user()->load('organisation', 'venues');
    
        $venues = $user->venues;
    
        if ($venues->count() === 1) {
            $venue = $venues->first();
            return redirect()->route('venues.show', ['venue' => $venue->id]);
        }
    
        $total_venues = $venues->count();
        $total_plaques = $venues->sum('plaques');
    
        $total_accesses = $venues->sum(function ($venue) {
            return $venue->totalAccessCounts();
        });
    
        $total_access_rate = $venues->sum(function ($venue) {
            return $venue->access_rate;
        });
    
        $average_access_rate = $total_venues > 0 ? $total_access_rate / $total_venues : 0;
    
        $stats = [
            'total_venues'        => $total_venues,
            'total_plaques'       => $total_plaques,
            'total_visits'        => $total_accesses,
            'average_access_rate' => $average_access_rate,
        ];
    
        return Inertia::render('Venues/index', [
            'stats' => $stats,
            'venues' => $venues,
            'nav'=> 'home'
        ]);
    }
    
    

    public function show(Venue $venue)
    {
        $this->authorize('view', $venue);

        $venue->load('organisation');

        $accesses = $venue->totalAccessCounts();

        $stats = [
            'accesses' => $accesses,
        ];

        return inertia('Venue/index', [
            'venue' => $venue,
            'stats' => $stats,
            'nav'=>'venue_home'
        ]);
    }

    public function showStats(Venue $venue)
    {
        $this->authorize('view', $venue);
    
        $venue->load('blocks');
    
        $totalSeatVisits = $venue->seatAccessCounts()->sum('total_count');
        $totalBlockVisits = $venue->blockAccessCounts()->sum('total_count');
        $totalVisits = $totalSeatVisits + $totalBlockVisits;

        $stats = [
            'total_seat_visits' => $totalSeatVisits,
            'total_block_visits' => $totalBlockVisits,
            'total_visits' => $totalVisits,
        ];
    
        return Inertia::render('VenueStats/index', [
            'venue' => $venue,
            'stats' => $stats,
        ]);
    }
    

    public function onboardVenue(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'               => 'required|string',
            'address_line1'      => 'required|string',
            'city'               => 'required|string',
            'country'            => 'required|string',
            'postcode'           => 'required|string',
            'type'               => 'required|string',
            'logo_url'           => 'nullable|url',
            'banner_url'         => 'nullable|url',
            'capacity'           => 'required|integer',
            'status'             => 'required|string',
            'short_description'  => 'nullable|string',
            'long_description'   => 'nullable|string',
            'contact_email'      => 'required|email',
            'contact_phone'      => 'required|string',
            'organisation_id'    => 'required|integer|exists:organisations,id',
            'base_url'           => 'required|url',
            'venue_data_file'    => 'required|file|mimes:xlsx,xls,csv',
        ]);
    
        // Log the validation result
        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ], 422);
        }
    
        try {
            $filePath = $request->file('venue_data_file')->store('venue_data_files');
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'File upload failed',
            ], 500);
        }

        try {
            dispatch(new ProcessVenueOnboardingJob($request->except('venue_data_file'), $filePath));
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Failed to dispatch venue onboarding job',
            ], 500);
        }
    
        return response()->json([
            'status'  => 'success',
            'message' => 'Venue onboarding has started. You will be notified upon completion.',
        ], 202);
    }
}