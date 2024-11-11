<?php

namespace Database\Seeders\CanaryAccount;

use Illuminate\Database\Seeder;
use DB;

class CanaryStandsSeeder extends Seeder
{
    public function run()
    {
        // Find test venue IDs
        $venues = DB::table('venues')
            ->whereIn('name', ['Canary Test Venue 1', 'Canary Test Venue 2'])
            ->pluck('id', 'name');

        // Insert three stands per venue
        $stands = [
            'Canary Test Venue 1' => ['Main Stand', 'North Stand', 'South Stand', 'East Stand'],
            'Canary Test Venue 2' => ['East Stand', 'West Stand', 'VIP Stand', 'South Stand'],
        ];

        foreach ($stands as $venueName => $standNames) {
            $venueId = $venues[$venueName];

            foreach ($standNames as $standName) {
                DB::table('stands')->insert([
                    'venue_id' => $venueId,
                    'name' => $standName,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
