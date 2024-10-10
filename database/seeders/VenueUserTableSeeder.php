<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class VenueUserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('venue_user')->insert([
            [
                'user_id' => 1,
                'venue_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'venue_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'venue_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
