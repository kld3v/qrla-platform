<?php

namespace Database\Seeders\CanaryAccount;

use Illuminate\Database\Seeder;
use DB;

class CanarySeatsSeeder extends Seeder
{
    public function run()
    {
        // Get all blocks for test venues
        $blocks = DB::table('blocks')
            ->join('stands', 'blocks.stand_id', '=', 'stands.id')
            ->join('venues', 'stands.venue_id', '=', 'venues.id')
            ->whereIn('venues.name', ['Canary Test Venue 1', 'Canary Test Venue 2'])
            ->select('blocks.id as block_id')
            ->get();

        foreach ($blocks as $block) {
            // Insert a small number of seats in each block
            foreach (['A', 'B', 'C'] as $row) {
                for ($seatNumber = 1; $seatNumber <= 5; $seatNumber++) {
                    DB::table('seats')->insert([
                        'block_id' => $block->block_id,
                        'row' => $row,
                        'seat_number' => $seatNumber,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
