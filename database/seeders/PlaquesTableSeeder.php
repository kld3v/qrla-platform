<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use DB;

class PlaquesTableSeeder extends Seeder
{
    public function run()
    {
        // Seed plaques for each block
        $blocks = DB::table('blocks')->get(); // Get all blocks
        foreach ($blocks as $block) {
            DB::table('plaques')->insert([
                'short_code' => Str::random(8), // Generate a random short code
                'plaqueable_type' => 'block',   // Polymorphic type for Block
                'plaqueable_id' => $block->id,  // The block's ID
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed plaques for each seat
        $seats = DB::table('seats')->get(); // Get all seats
        foreach ($seats as $seat) {
            DB::table('plaques')->insert([
                'short_code' => Str::random(8), // Generate a random short code
                'plaqueable_type' => 'seat',    // Polymorphic type for Seat
                'plaqueable_id' => $seat->id,   // The seat's ID
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
