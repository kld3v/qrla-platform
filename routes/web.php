<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\MarkerController;

Route::get('/', function () {

     return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
        
    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    // ]);
});

Route::middleware('auth')->group(function (): void {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route to see all of the venue data associated with the authenticated user
Route::get('/venues', [VenueController::class, 'index'])->name('venues.index');

// Route to see an overview of a specific venue
Route::get('/venues/{venue}', [VenueController::class, 'show'])->name('venues.show');

// Route to see all blocks associated with a specific venue
Route::get('/venues/{venue}/blocks', [BlockController::class, 'index'])->name('blocks.index');

// Route to see a specific block within a venue by block name
Route::get('/venues/{venue}/blocks/{name}', [BlockController::class, 'show'])->name('blocks.show');

// // Route to see all of the stats for a specific venue
// Route::get('/venues/{venue}/stats', [VenueStatsController::class, 'show'])->name('venues.stats');

// To be corrected accordingly 
Route::get('/VenueStats', function(){
    return Inertia('VenueStats/index', [
        'venue' => "data"
    ]);
});


// // Route to see all of the stats for a specific block by block name within a venue
// Route::get('/venues/{venue}/blocks/{block_name}/stats', [BlockStatsController::class, 'show'])->name('blocks.stats');

// To be corrected accordingly 
Route::get('/PlaqueManagement', function(){
    return Inertia('PlaqueManagement/index', [
        'venue' => "data"
    ]);
});


// To be corrected accordingly 
Route::get('/BlockStats', function(){
    return Inertia('BlockStats/index', [
        'venue' => "data"
    ]);
});


require __DIR__.'/auth.php';

Route::get('/{short_code}', [MarkerController::class, 'handleMarkerRedirect'])->name('markers.redirect');