<?php

namespace Database\Seeders\CanaryAccount;

use Illuminate\Database\Seeder;
use DB;

class CanaryRedirectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Retrieve logo IDs associated with the Canary test venues
        $logoIds = DB::table('logos')
            ->join('venues', 'logos.venue_id', '=', 'venues.id')
            ->whereIn('venues.name', ['Canary Test Venue 1', 'Canary Test Venue 2'])
            ->pluck('logos.id');

        // Insert a redirect entry for each logo
        foreach ($logoIds as $logoId) {
            DB::table('redirects')->insert([
                'base_url_id' => 1,
                'logo_id' => $logoId,
                'redirect_preset_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
