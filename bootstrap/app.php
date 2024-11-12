<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(replace: [
            ValidateCsrfToken::class => \App\Http\Middleware\CustomCsrfMiddleware::class,
        ]);

        $middleware->web(prepend: [
            \App\Http\Middleware\CanaryAuthMiddleware::class,
        ]);

        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();


    //NOTE THIS IS THE OLD CODE. ONLY KEEPING IT, AS I THINK THE EXCEPT FUNCTION ON THE
    //VALIDATE CSRFTOKEN MAY NEED TO BE REINTRODUCED SOMEWHERE, AND I DO NOT WANT TO 
    //FORGET TO DO IT
    
    // ->withMiddleware(function (Middleware $middleware) {
    //     $middleware->web(append: [
    //         \App\Http\Middleware\CanaryAuthMiddleware::class,
    //         \App\Http\Middleware\CustomCsrfMiddleware::class,
    
    //         \App\Http\Middleware\HandleInertiaRequests::class,
    //         \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
    //     ]);

    //     // $middleware->validateCsrfTokens(except: [
    //     //     'venues/onboard',
    //     // ]);

    //     $middleware->alias([
    //         // 'canary.auth' =>  \App\Http\Middleware\CanaryAuthMiddleware::class,
    //     ]);

    //     //
    // })