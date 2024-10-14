<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\MarkerController;
use App\Http\Controllers\StatsController;

Route::get('/', function () {       
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::middleware('auth')->group(function (): void {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Onboard the venues
Route::post('/venues/onboard', [VenueController::class, 'onboardVenue']);

// Route to see all of the venue data associated with the authenticated user
Route::get('/venues', [VenueController::class, 'index'])->name('venues.index');

// Route to see an overview of a specific venue
Route::get('/venues/{venue}', [VenueController::class, 'show'])->name('venues.show');

// Route to manage plaques ssociated with a specific venue
Route::get('/venues/{venue}/plaque-management', [BlockController::class, 'index'])->name('blocks.index');

// // Route to get stats associated with a specific venue
// Route::get('/venues/{venue}/stats', [::class, ''])->name('');

// Route::get('/venues/{venue}/block-stats', [::class, ''])->name('');

// // Route to get stats associated with a specific block
// Route::get('/venues/{venue}/blocks/{block}/stats', [::class, ''])->name('');

Route::get('/stats/accesses-over-time', [StatsController::class, 'getAccessesOverTime']);

Route::get('/stats/accesses-by-os-browser', [StatsController::class, 'getAccessesByOsAndBrowser']);

Route::get('/stats/accesses-by-block', [StatsController::class, 'getAccessesByBlock']);

Route::get('/stats/accesses-by-marker-type', [StatsController::class, 'getAccessesByMarkerType']);


require __DIR__.'/auth.php';

Route::get('/{short_code}', [MarkerController::class, 'handleMarkerRedirect'])->name('markers.redirect');

