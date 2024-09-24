<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class SeatsTableSeeder extends Seeder
{
    public function run()
    {
        // Generate rows A to Z and AA to AC
        $rows = array_merge(range('A', 'Z'), ['AA', 'AB', 'AC']);

        // Get the min and max block_id for venue_id 1
        $minBlockId = DB::table('blocks')
            ->join('stands', 'blocks.stand_id', '=', 'stands.id')
            ->where('stands.venue_id', 1)
            ->min('blocks.id');

        $maxBlockId = DB::table('blocks')
            ->join('stands', 'blocks.stand_id', '=', 'stands.id')
            ->where('stands.venue_id', 1)
            ->max('blocks.id');

        // Loop through each block between minBlockId and maxBlockId
        for ($blockId = $minBlockId; $blockId <= $maxBlockId; $blockId++) {
            foreach ($rows as $row) {
                for ($seatNumber = 1; $seatNumber <= 50; $seatNumber++) { // 50 seats per row
                    DB::table('seats')->insert([
                        'block_id' => $blockId,
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
