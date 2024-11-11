<?php

namespace Database\Seeders\CanaryAccount;

use Illuminate\Database\Seeder;
use DB;

class CanaryLogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Retrieve the IDs of the Canary test venues
        $venueIds = DB::table('venues')
            ->whereIn('name', ['Canary Test Venue 1', 'Canary Test Venue 2'])
            ->pluck('id');

        // Logo image URL
        $logoPath = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWfwftCJar78X8Nc3XF7a1oumB_BIsoS41yQ&s';

        // Insert the logo for each venue
        foreach ($venueIds as $venueId) {
            DB::table('logos')->insert([
                'venue_id' => $venueId,
                'path' => $logoPath,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
