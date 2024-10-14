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

        $total_venues = $venues->count();
        $total_plaques = $venues->sum('plaques');
        $total_accesses = $venues->sum('accesses');
    
        $stats = [
            'total_venues'  => $total_venues,
            'total_plaques' => $total_plaques,
            'total_visits'  => $total_accesses,
        ];
    
        return Inertia::render('Venues/Index', [
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