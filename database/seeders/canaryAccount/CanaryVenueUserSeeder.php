<?php

namespace Database\Seeders\CanaryAccount;

use Illuminate\Database\Seeder;
use DB;

class CanaryVenueUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find the Canary user by email
        $userId = DB::table('users')
            ->where('email', 'canary@auth.com')
            ->value('id');

        // Retrieve venue IDs for Canary test venues
        $venueIds = DB::table('venues')
            ->whereIn('name', ['Canary Test Venue 1', 'Canary Test Venue 2'])
            ->pluck('id');

        // Link the Canary user to each test venue in the pivot table
        foreach ($venueIds as $venueId) {
            DB::table('venue_user')->insert([
                'user_id' => $userId,
                'venue_id' => $venueId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
