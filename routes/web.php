<?php

use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilePictureController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\MarkerController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\RegisterLinkController;
use Spatie\CookieConsent\CookieConsent;

Route::domain('https://qrla.io')->group(function () {
    Route::get('/', function () {
        return redirect('https://qrla.co.uk');
    });
});

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('venues.index');
    } else {
        return redirect()->route('login');
    }
});

Route::middleware('auth')->group(function (): void {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Onboard the venues
    Route::post('/venues/onboard', [VenueController::class, 'onboardVenue']);

    // Route to see all of the venue data associated with the authenticated user
    Route::get('/venues', [VenueController::class, 'index'])->name('venues.index');

    // Route to see an overview of a specific venue
    Route::get('/venues/{venue}', [VenueController::class, 'show'])->name('venues.show');

    // Route to manage plaques ssociated with a specific venue
    Route::get('/venues/{venue}/plaque-management', [BlockController::class, 'index'])->name('blocks.index');

    Route::post('/venues/{venue}/blocks/assign-url', [BlockController::class, 'assignBaseUrl'])->name('blocks.assignBaseUrl');

    // Route to get stats associated with a specific venue
    Route::get('/venues/{venue}/stats', [VenueController::class, 'showStats'])->name('venues.showStats');

    Route::get('/venues/{venue}/block-stats', [BlockController::class, 'showStats'])->name('blocks.showStats');

    Route::post('/profile-picture/upload', [ProfilePictureController::class, 'upload'])->name('user.uploadProfilePhoto');

    Route::post('/organisation/logo/upload', [OrganisationController::class, 'uploadLogo'])->name('organisation.uploadLogo');


});

Route::get('/stats/accesses-over-time', [StatsController::class, 'getAccessesOverTime']);

Route::get('/stats/accesses-by-os-browser', [StatsController::class, 'getAccessesByOsAndBrowser']);

Route::get('/stats/accesses-by-block', [StatsController::class, 'getAccessesByBlock']);

Route::get('/stats/accesses-by-marker-type', [StatsController::class, 'getAccessesByMarkerType']);


Route::get('/test-svg', [VenueController::class, 'testSvg']);


require __DIR__.'/auth.php';

Route::get('/{short_code}', [MarkerController::class, 'handleMarkerRedirect'])->name('markers.redirect');

Route::get('/test-short-url/{short_code}', [MarkerController::class, 'testShortUrlShow']);
