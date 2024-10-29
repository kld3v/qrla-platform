<?php

namespace Database\Seeders\demoLaunch;

use Illuminate\Database\Seeder;
use DB;

class SeatsTableSeeder extends Seeder
{
    public function run()
    {
        // Generate rows A to Z and AA to AC
        $rows = array_merge(range('A', 'Z'), ['AA', 'AB', 'AC']);

        // Define seats per row for each venue
        $seatsPerRowByVenue = [
            1 => 20, // Venue 1 needs 20 seats per row
            2 => 10, // Venue 2 needs 10 seats per row
        ];

        // Get all blocks and their associated venue IDs
        $blocks = DB::table('blocks')
            ->join('stands', 'blocks.stand_id', '=', 'stands.id')
            ->select('blocks.id as block_id', 'stands.venue_id')
            ->get();

        foreach ($blocks as $block) {
            $seatsPerRow = $seatsPerRowByVenue[$block->venue_id] ?? 20; // Default to 20 if not specified

            foreach ($rows as $row) {
                for ($seatNumber = 1; $seatNumber <= $seatsPerRow; $seatNumber++) {
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
