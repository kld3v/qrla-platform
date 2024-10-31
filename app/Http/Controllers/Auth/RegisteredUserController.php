<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UniqueRegisterLink;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegisteredUserController extends Controller
{
    /**
     * Display the standard registration view.
     */
    public function create(): Response
    {
        Log::info('Displaying standard registration view.');
        return Inertia::render('Auth/Register');
    }

    /**
     * Display the registration view with a unique token.
     *
     * @param  string  $token
     * @return \Inertia\Response|\Illuminate\Http\Response
     */
    public function showRegistrationFormWithToken($token): Response|RedirectResponse
    {
        Log::info("Attempting to display registration view with token: {$token}");

        // Retrieve the UniqueRegisterLink record
        $uniqueRegisterLink = UniqueRegisterLink::where('token', $token)
            ->where('expires_at', '>', now())
            ->first();

        if (!$uniqueRegisterLink) {
            Log::warning("Invalid or expired registration link for token: {$token}");
            return redirect()->route('register')->withErrors(['token' => 'Invalid or expired registration link.']);
        }

        Log::info("Token validated successfully: {$token}");

        // Pass the token to the registration view
        return Inertia::render('Auth/Register', [
            'token' => $token,
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        Log::info('Starting registration process.');

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'token' => 'nullable|string|exists:unique_register_links,token',
        ]);

        Log::info('Validation passed for registration request.', $request->only('name', 'email'));

        // Begin a database transaction
        DB::beginTransaction();

        try {
            // Create the user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Log::info("User created with ID: {$user->id}");
            Log::info("Request {$request}");
            
            // If a token is present, associate data
            if ($request->filled('token')) {
                $uniqueRegisterLink = UniqueRegisterLink::where('token', $request->input('token'))
                    ->where('expires_at', '>', now())
                    ->first();
            
                if ($uniqueRegisterLink) {
                    Log::info("Unique register link found with token: {$request->input('token')}");
                    Log::info("UniqueRegisterLink data", [
                        'role' => $uniqueRegisterLink->role,
                        'organisation_id' => $uniqueRegisterLink->organisation_id,
                        'venue_ids' => $uniqueRegisterLink->venue_ids,
                    ]);
            
                    // Assign role and organisation
                    $user->role = $uniqueRegisterLink->role;
                    $user->organisation_id = $uniqueRegisterLink->organisation_id;
                    $user->save();
            
                    Log::info("User role and organisation assigned for user ID: {$user->id}", [
                        'assigned_role' => $user->role,
                        'assigned_organisation_id' => $user->organisation_id,
                    ]);
            
                    // Attach venues if any
                    if (!empty($uniqueRegisterLink->venue_ids)) {
                        $user->venues()->attach($uniqueRegisterLink->venue_ids);
                        Log::info("Venues attached to user ID: {$user->id}", ['venue_ids' => $uniqueRegisterLink->venue_ids]);
                    } else {
                        Log::warning("No venue IDs found to attach for user ID: {$user->id}");
                    }
            
                    // Delete the unique link to prevent reuse
                    $uniqueRegisterLink->delete();
                    Log::info("Unique register link deleted for token: {$request->input('token')}");
                } else {
                    Log::warning("No valid UniqueRegisterLink found for token: {$request->input('token')}");
                }
            }            

            // Fire the Registered event
            event(new Registered($user));
            Log::info("Registered event fired for user ID: {$user->id}");

            // Log the user in
            Auth::login($user);
            Log::info("User logged in with ID: {$user->id}");

            // Commit the transaction
            DB::commit();
            Log::info("Transaction committed for user ID: {$user->id}");

            // Redirect to the intended location
            return redirect()->route('venues.index');
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();
            Log::error("Registration failed: {$e->getMessage()}", ['trace' => $e->getTraceAsString()]);
            throw $e;
        }
    }
}
