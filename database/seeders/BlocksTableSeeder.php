<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class BlocksTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('blocks')->insert([
            // West Stand
            ['stand_id' => 1, 'base_url_id' => 1, 'name' => 'WU1', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 1, 'base_url_id' => 1, 'name' => 'WU2', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 1, 'base_url_id' => 1, 'name' => 'WU3', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 1, 'base_url_id' => 1, 'name' => 'WU4', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 1, 'base_url_id' => 1, 'name' => 'WU5', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 1, 'base_url_id' => 1, 'name' => 'WU6', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 1, 'base_url_id' => 1, 'name' => 'WU7', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 1, 'base_url_id' => 1, 'name' => 'WU8', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 1, 'base_url_id' => 1, 'name' => 'WL1', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 1, 'base_url_id' => 1, 'name' => 'WL2', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 1, 'base_url_id' => 1, 'name' => 'WL3', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 1, 'base_url_id' => 1, 'name' => 'WL4', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 1, 'base_url_id' => 1, 'name' => 'WL5', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 1, 'base_url_id' => 1, 'name' => 'WL6', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 1, 'base_url_id' => 1, 'name' => 'WL7', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 1, 'base_url_id' => 1, 'name' => 'WL8', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 1, 'base_url_id' => 1, 'name' => 'MILLENNIUM SUITES', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 1, 'base_url_id' => 1, 'name' => 'TAMBLING', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 1, 'base_url_id' => 1, 'name' => 'CLARKE', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 1, 'base_url_id' => 1, 'name' => 'HARRIS', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 1, 'base_url_id' => 1, 'name' => 'DIRECTORS', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 1, 'base_url_id' => 1, 'name' => 'DRAKES', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 1, 'base_url_id' => 1, 'name' => 'SONETTI', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 1, 'base_url_id' => 1, 'name' => 'HOLLINS', 'created_at' => now(), 'updated_at' => now()],

            // Matthew Harding Stand (North)
            ['stand_id' => 2, 'base_url_id' => 1, 'name' => 'U08', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 2, 'base_url_id' => 1, 'name' => 'U09', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 2, 'base_url_id' => 1, 'name' => 'U10', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 2, 'base_url_id' => 1, 'name' => 'U11', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 2, 'base_url_id' => 1, 'name' => 'U12', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 2, 'base_url_id' => 1, 'name' => 'U13', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 2, 'base_url_id' => 1, 'name' => 'U14', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 2, 'base_url_id' => 1, 'name' => 'U15', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 2, 'base_url_id' => 1, 'name' => 'U16', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 2, 'base_url_id' => 1, 'name' => 'U17', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 2, 'base_url_id' => 1, 'name' => 'U18', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 2, 'base_url_id' => 1, 'name' => 'L08', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 2, 'base_url_id' => 1, 'name' => 'L09', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 2, 'base_url_id' => 1, 'name' => 'L10', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 2, 'base_url_id' => 1, 'name' => 'L11', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 2, 'base_url_id' => 1, 'name' => 'L12', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 2, 'base_url_id' => 1, 'name' => 'L13', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 2, 'base_url_id' => 1, 'name' => 'L14', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 2, 'base_url_id' => 1, 'name' => 'L15', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 2, 'base_url_id' => 1, 'name' => 'L16', 'created_at' => now(), 'updated_at' => now()],

            // East Stand
            ['stand_id' => 3, 'base_url_id' => 1, 'name' => 'EU1', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 3, 'base_url_id' => 1, 'name' => 'EU2', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 3, 'base_url_id' => 1, 'name' => 'EU3', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 3, 'base_url_id' => 1, 'name' => 'EU4', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 3, 'base_url_id' => 1, 'name' => 'ELS1', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 3, 'base_url_id' => 1, 'name' => 'ELS2', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 3, 'base_url_id' => 1, 'name' => 'ELS3', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 3, 'base_url_id' => 1, 'name' => 'ELS4', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 3, 'base_url_id' => 1, 'name' => 'ELN1', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 3, 'base_url_id' => 1, 'name' => 'ELN2', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 3, 'base_url_id' => 1, 'name' => 'CAPTAINS', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 3, 'base_url_id' => 1, 'name' => 'CENTENARY', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 3, 'base_url_id' => 1, 'name' => 'CANALETTO', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 3, 'base_url_id' => 1, 'name' => 'EXEC CLUB', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 3, 'base_url_id' => 1, 'name' => 'OSSIES', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 3, 'base_url_id' => 1, 'name' => 'CHAMPIONS', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 3, 'base_url_id' => 1, 'name' => 'MANAGERS', 'created_at' => now(), 'updated_at' => now()],

            // Shed End (South)
            ['stand_id' => 4, 'base_url_id' => 1, 'name' => 'SU1', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 4, 'base_url_id' => 1, 'name' => 'SU2', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 4, 'base_url_id' => 1, 'name' => 'SU3', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 4, 'base_url_id' => 1, 'name' => 'SU4', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 4, 'base_url_id' => 1, 'name' => 'SU5', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 4, 'base_url_id' => 1, 'name' => 'SU6', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 4, 'base_url_id' => 1, 'name' => 'SU7', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 4, 'base_url_id' => 1, 'name' => 'SL1', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 4, 'base_url_id' => 1, 'name' => 'SL2', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 4, 'base_url_id' => 1, 'name' => 'SL3', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 4, 'base_url_id' => 1, 'name' => 'SL4', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 4, 'base_url_id' => 1, 'name' => 'SL5', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 4, 'base_url_id' => 1, 'name' => 'SL6', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 4, 'base_url_id' => 1, 'name' => 'SL7', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
