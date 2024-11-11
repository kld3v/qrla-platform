<?php

namespace Database\Seeders\CanaryAccount;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use DB;

class CanaryMarkersSeeder extends Seeder
{
    public function run()
    {
        // Retrieve venue IDs for Canary test venues
        $venueIds = DB::table('venues')
            ->whereIn('name', ['Canary Test Venue 1', 'Canary Test Venue 2'])
            ->pluck('id');

        // Retrieve blocks associated with the Canary test venues
        $blocks = DB::table('blocks')
            ->join('stands', 'blocks.stand_id', '=', 'stands.id')
            ->whereIn('stands.venue_id', $venueIds)
            ->select('blocks.id')
            ->get();

        // Insert a marker for each block in the Canary test venues
        foreach ($blocks as $block) {
            DB::table('markers')->insert([
                'short_code' => Str::random(8),   // Generate a random short code
                'markerable_type' => 'block',     // Polymorphic type for Block
                'markerable_id' => $block->id,    // The block's ID
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Retrieve seats associated with the blocks in the Canary test venues
        $seats = DB::table('seats')
            ->whereIn('block_id', $blocks->pluck('id'))
            ->get();

        // Insert a marker for each seat in the Canary test venues
        foreach ($seats as $seat) {
            DB::table('markers')->insert([
                'short_code' => Str::random(8),   // Generate a random short code
                'markerable_type' => 'seat',      // Polymorphic type for Seat
                'markerable_id' => $seat->id,     // The seat's ID
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
