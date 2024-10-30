<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\UniqueRegisterLink;
use Carbon\Carbon;

class RegisterLinkController extends Controller
{
    public function generateLink(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'role' => 'required|string',
            'organisation_id' => 'required|exists:organisations,id',
            'venue_ids' => 'array',
            'venue_ids.*' => 'exists:venues,id',
            'expires_at' => 'nullable|date|after:now',
        ]);

        // Generate a unique, random token
        do {
            $token = Str::random(32);
        } while (UniqueRegisterLink::where('token', $token)->exists());

        // Set expiration date, default to one week if not provided
        $expiresAt = $request->input('expires_at', Carbon::now()->addWeek());

        // Create the UniqueRegisterLink record
        $uniqueRegisterLink = UniqueRegisterLink::create([
            'token' => $token,
            'role' => $request->input('role'),
            'organisation_id' => $request->input('organisation_id'),
            'venue_ids' => $request->input('venue_ids'),
            'expires_at' => $expiresAt,
        ]);

        // Generate the full registration URL
        $url = route('register.token', ['token' => $token]);

        // Return the URL as JSON (you can modify this as needed)
        return response()->json(['url' => $url], 201);
    }
}
