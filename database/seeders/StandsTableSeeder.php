<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class StandsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('stands')->insert([
            [
                'venue_id' => 1, // Stamford Bridge
                'name' => 'West Stand',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venue_id' => 1,
                'name' => 'Matthew Harding Stand (North)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venue_id' => 1,
                'name' => 'East Stand',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venue_id' => 1,
                'name' => 'Shed End (South)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
