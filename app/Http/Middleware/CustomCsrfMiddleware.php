<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Support\Facades\Log;

class CustomCsrfMiddleware extends ValidateCsrfToken
{
    /**
     * Determine if the session and input CSRF tokens match.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function tokensMatch($request)
    {
        $canaryKey = config('auth.canary.key');

        if ($request->header('X-Canary-Key') === $canaryKey) {
            Log::info('CustomCsrfMiddleware: Skipping CSRF check for Canary request.');
            return true;
        }

        return parent::tokensMatch($request);
    }
}
