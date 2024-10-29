<?php

namespace Database\Seeders\demoLaunch;

use Illuminate\Database\Seeder;
use DB;

class BlocksTableSeederSwanseacom extends Seeder
{
    public function run()
    {
        DB::table('blocks')->insert([
            //.com
            // East Stand
            ['stand_id' => 5, 'redirect_id' => 2, 'name' => 'EU1', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 5, 'redirect_id' => 2, 'name' => 'EU2', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 5, 'redirect_id' => 2, 'name' => 'EU3', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 5, 'redirect_id' => 2, 'name' => 'EU4', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 5, 'redirect_id' => 2, 'name' => 'EU5', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 5, 'redirect_id' => 2, 'name' => 'EU6', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 5, 'redirect_id' => 2, 'name' => 'EU7', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 5, 'redirect_id' => 2, 'name' => 'EU8', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 5, 'redirect_id' => 2, 'name' => 'EU9', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 5, 'redirect_id' => 2, 'name' => 'EU10', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 5, 'redirect_id' => 2, 'name' => 'EU11', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 5, 'redirect_id' => 2, 'name' => 'EU12', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 5, 'redirect_id' => 2, 'name' => 'EU13', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 5, 'redirect_id' => 2, 'name' => 'EL1', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 5, 'redirect_id' => 2, 'name' => 'EL2', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 5, 'redirect_id' => 2, 'name' => 'EL3', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 5, 'redirect_id' => 2, 'name' => 'EL4', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 5, 'redirect_id' => 2, 'name' => 'EL5', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 5, 'redirect_id' => 2, 'name' => 'EL6', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 5, 'redirect_id' => 2, 'name' => 'EL7', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 5, 'redirect_id' => 2, 'name' => 'EL8', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 5, 'redirect_id' => 2, 'name' => 'EL9', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 5, 'redirect_id' => 2, 'name' => 'EL10', 'created_at' => now(), 'updated_at' => now()],

            // South Stand
            ['stand_id' => 6, 'redirect_id' => 2, 'name' => 'SU1', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 6, 'redirect_id' => 2, 'name' => 'SU2', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 6, 'redirect_id' => 2, 'name' => 'SU3', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 6, 'redirect_id' => 2, 'name' => 'SU4', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 6, 'redirect_id' => 2, 'name' => 'SU5', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 6, 'redirect_id' => 2, 'name' => 'SU6', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 6, 'redirect_id' => 2, 'name' => 'SU7', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 6, 'redirect_id' => 2, 'name' => 'SU8', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 6, 'redirect_id' => 2, 'name' => 'SU9', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 6, 'redirect_id' => 2, 'name' => 'SL1', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 6, 'redirect_id' => 2, 'name' => 'SL2', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 6, 'redirect_id' => 2, 'name' => 'SL3', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 6, 'redirect_id' => 2, 'name' => 'SL4', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 6, 'redirect_id' => 2, 'name' => 'SL5', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 6, 'redirect_id' => 2, 'name' => 'SL6', 'created_at' => now(), 'updated_at' => now()],


            // West Stand
            ['stand_id' => 7, 'redirect_id' => 2, 'name' => 'WU1', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 7, 'redirect_id' => 2, 'name' => 'WU2', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 7, 'redirect_id' => 2, 'name' => 'WU3', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 7, 'redirect_id' => 2, 'name' => 'WU4', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 7, 'redirect_id' => 2, 'name' => 'WU5', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 7, 'redirect_id' => 2, 'name' => 'WU6', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 7, 'redirect_id' => 2, 'name' => 'WU7', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 7, 'redirect_id' => 2, 'name' => 'WU8', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 7, 'redirect_id' => 2, 'name' => 'WU9', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 7, 'redirect_id' => 2, 'name' => 'WU10', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 7, 'redirect_id' => 2, 'name' => 'WU11', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 7, 'redirect_id' => 2, 'name' => 'WU12', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 7, 'redirect_id' => 2, 'name' => 'WU13', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 7, 'redirect_id' => 2, 'name' => 'WL1', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 7, 'redirect_id' => 2, 'name' => 'WL2', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 7, 'redirect_id' => 2, 'name' => 'WL3', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 7, 'redirect_id' => 2, 'name' => 'WL4', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 7, 'redirect_id' => 2, 'name' => 'WL5', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 7, 'redirect_id' => 2, 'name' => 'WL6', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 7, 'redirect_id' => 2, 'name' => 'WL7', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 7, 'redirect_id' => 2, 'name' => 'WL8', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 7, 'redirect_id' => 2, 'name' => 'WL9', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 7, 'redirect_id' => 2, 'name' => 'WL10', 'created_at' => now(), 'updated_at' => now()],

            // North Stand
            ['stand_id' => 8, 'redirect_id' => 2, 'name' => 'NU1', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 8, 'redirect_id' => 2, 'name' => 'NU2', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 8, 'redirect_id' => 2, 'name' => 'NU3', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 8, 'redirect_id' => 2, 'name' => 'NU4', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 8, 'redirect_id' => 2, 'name' => 'NU5', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 8, 'redirect_id' => 2, 'name' => 'NU6', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 8, 'redirect_id' => 2, 'name' => 'NU7', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 8, 'redirect_id' => 2, 'name' => 'NU8', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 8, 'redirect_id' => 2, 'name' => 'NU9', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 8, 'redirect_id' => 2, 'name' => 'NL1', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 8, 'redirect_id' => 2, 'name' => 'NL2', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 8, 'redirect_id' => 2, 'name' => 'NL3', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 8, 'redirect_id' => 2, 'name' => 'NL4', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 8, 'redirect_id' => 2, 'name' => 'NL5', 'created_at' => now(), 'updated_at' => now()],
            ['stand_id' => 8, 'redirect_id' => 2, 'name' => 'NL6', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
