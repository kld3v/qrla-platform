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

class RegisteredUserController extends Controller
{
    /**
     * Display the standard registration view.
     */
    public function create(): Response
    {
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
        // Retrieve the UniqueRegisterLink record
        $uniqueRegisterLink = UniqueRegisterLink::where('token', $token)
            ->where('expires_at', '>', now())
            ->first();

        if (!$uniqueRegisterLink) {
            return redirect()->route('register')->withErrors(['token' => 'Invalid or expired registration link.']);
        }

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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'token' => 'nullable|string|exists:unique_links,token',
        ]);

        // Begin a database transaction
        DB::beginTransaction();

        try {
            // Create the user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // If a token is present, associate data
            if ($request->filled('token')) {
                $UniqueRegisterLink = UniqueRegisterLink::where('token', $request->input('token'))
                    ->where('expires_at', '>', now())
                    ->first();

                if ($UniqueRegisterLink) {
                    // Assign role and organisation
                    $user->role = $UniqueRegisterLink->role;
                    $user->organisation_id = $UniqueRegisterLink->organisation_id;
                    $user->save();

                    // Attach venues if any
                    if (!empty($UniqueRegisterLink->venue_ids)) {
                        $user->venues()->attach($UniqueRegisterLink->venue_ids);
                    }

                    // Delete the unique link to prevent reuse
                    $UniqueRegisterLink->delete();
                }
            }

            // Fire the Registered event
            event(new Registered($user));

            // Log the user in
            Auth::login($user);

            // Commit the transaction
            DB::commit();

            // Redirect to the intended location
            return redirect()->route('venues.index');
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();
            throw $e;
        }
    }
}
