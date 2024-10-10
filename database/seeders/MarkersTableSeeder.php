<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use DB;

class MarkersTableSeeder extends Seeder
{
    public function run()
    {
        // Seed markers for each block
        $blocks = DB::table('blocks')->get(); // Get all blocks
        foreach ($blocks as $block) {
            DB::table('markers')->insert([
                'short_code' => Str::random(8), // Generate a random short code
                'markerable_type' => 'block',   // Polymorphic type for Block
                'markerable_id' => $block->id,  // The block's ID
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed markers for each seat
        $seats = DB::table('seats')->get(); // Get all seats
        foreach ($seats as $seat) {
            DB::table('markers')->insert([
                'short_code' => Str::random(8), // Generate a random short code
                'markerable_type' => 'seat',    // Polymorphic type for Seat
                'markerable_id' => $seat->id,   // The seat's ID
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
