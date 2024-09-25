<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,       // Seeds users
            VenuesTableSeeder::class,      // Seeds venues
            VenueUserTableSeeder::class,   // Seeds the relationship between users and venues
            BaseUrlsTableSeeder::class,    // Seeds base URLs
            StandsTableSeeder::class,      // Seeds stands related to venues
            BlocksTableSeeder::class,      // Seeds blocks related to stands
            SeatsTableSeeder::class,       // Seeds seats related to blocks
            MarkersTableSeeder::class,     // Seeds markers for both blocks and seats
            RedirectPresetSeeder::class,  
            LogoSeeder::class,  
            RedirectSeeder::class,  
        ]);
    }
}
