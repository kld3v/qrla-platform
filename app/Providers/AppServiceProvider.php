<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use Spatie\CookieConsent\CookieConsent;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);

        Inertia::share([
            'cookieConsent' => fn () => app(CookieConsent::class)->isConsented(),
        ]);


        //This is quite cool and I probably will forget it so making a note
        // Relation::enforceMorphMap: This function defines custom
        // mappings for polymorphic relationships.
        // Instead of storing the fully qualified class
        // names (App\Models\Seat or App\Models\Block),
        // it will store the simpler strings 'seat' and 'block'
        // in the markerable_type column of your markers table.
        Relation::enforceMorphMap([
            'seat' => 'App\Models\Seat',
            'block' => 'App\Models\Block',
            'venue' => 'App\Models\Venue',
        ]);
    }
}
