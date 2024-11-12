<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class CanaryAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        Log::info('CanaryAuthMiddleware: Processing request.');

        // Authenticate the user if they're not already authenticated
        if (!Auth::check()) {
            Log::info('CanaryAuthMiddleware: User is not authenticated.');
            $canaryKey = config('auth.canary.key');
            
            if ($request->header('X-Canary-Key') === $canaryKey) {
                $canaryUser = User::where('email', 'canary@auth.com')->first();
                
                if ($canaryUser) {
                    // Set the intended URL only if not set to prevent overwriting
                    if (!session()->has('url.intended')) {
                        session(['url.intended' => $request->fullUrl()]);
                    }
                    Auth::login($canaryUser);
                    Log::info('CanaryAuthMiddleware: User authenticated successfully.');
                } else {
                    Log::error('CanaryAuthMiddleware: Canary user not found.');
                }
            } else {
                Log::warning('CanaryAuthMiddleware: Invalid Canary Key.');
            }
        } else {
            Log::info('CanaryAuthMiddleware: User already authenticated.');
        }

        // Only redirect if the intended URL differs from the current URL
        $intendedUrl = session('url.intended');
        if ($intendedUrl && $intendedUrl !== $request->fullUrl()) {
            Log::info("CanaryAuthMiddleware: Redirecting to intended URL: $intendedUrl");
            return redirect()->to($intendedUrl);
        }

        return $next($request);
    }    
}
