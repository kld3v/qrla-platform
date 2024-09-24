<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\VenueController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
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
Route::get('/venues/{venue}/blocks/{block_name}', [BlockController::class, 'show'])->name('blocks.show');

// // Route to see all of the stats for a specific venue
// Route::get('/venues/{venue}/stats', [VenueStatsController::class, 'show'])->name('venues.stats');

// // Route to see all of the stats for a specific block by block name within a venue
// Route::get('/venues/{venue}/blocks/{block_name}/stats', [BlockStatsController::class, 'show'])->name('blocks.stats');

require __DIR__.'/auth.php';
