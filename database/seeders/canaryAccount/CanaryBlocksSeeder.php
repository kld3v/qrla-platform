<?php

namespace Database\Seeders\CanaryAccount;

use Illuminate\Database\Seeder;
use DB;

class CanaryBlocksSeeder extends Seeder
{
    public function run()
    {
        // Retrieve venue IDs based on venue names
        $venueIds = DB::table('venues')
            ->whereIn('name', ['Canary Test Venue 1', 'Canary Test Venue 2'])
            ->pluck('id', 'name');

        // Define stand names for each venue
        $standsByVenue = [
            'Canary Test Venue 1' => ['Main Stand', 'North Stand', 'South Stand', 'East Stand'],
            'Canary Test Venue 2' => ['East Stand', 'West Stand', 'VIP Stand', 'South Stand'],
        ];

        // Loop through each venue and its stands to find their IDs
        foreach ($standsByVenue as $venueName => $standNames) {
            $venueId = $venueIds[$venueName];

            // Retrieve the latest redirect for the current venue
            $latestRedirectId = DB::table('redirects')
                ->join('logos', 'redirects.logo_id', '=', 'logos.id')
                ->join('venues', 'logos.venue_id', '=', 'venues.id')
                ->where('venues.id', $venueId)
                ->latest('redirects.created_at')
                ->value('redirects.id');

            // Retrieve stands for the current venue
            $stands = DB::table('stands')
                ->where('venue_id', $venueId)
                ->whereIn('name', $standNames)
                ->get();

            // Insert three blocks for each stand in the current venue, assigning the latest redirect ID
            foreach ($stands as $stand) {
                for ($i = 1; $i <= 3; $i++) {
                    DB::table('blocks')->insert([
                        'stand_id' => $stand->id,
                        'redirect_id' => $latestRedirectId,
                        'name' => "{$stand->name} Block {$i}",
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
