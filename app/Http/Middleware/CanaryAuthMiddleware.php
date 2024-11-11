<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CanaryAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        $canaryKey = config('auth.canary.key');
        if ($request->header('X-Canary-Key') === $canaryKey) {
            $canaryUser = User::where('email', 'canary@auth.com')->first();
            if ($canaryUser) {
                Auth::login($canaryUser);
            }
        }
        return $next($request);
    }
}
