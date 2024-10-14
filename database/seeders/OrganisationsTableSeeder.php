<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class OrganisationsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('organisations')->insert([
            [
                'name' => 'Levy Group',
                'address_line1' => 'Levy Road',
                'city' => 'London',
                'country' => 'UK',
                'postcode' => 'SW6 1HS',
                'contact_email' => 'info@levy.com',
                'contact_phone' => '0371 811 1955',
                'logo_path' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSDpVlECGVVc9EKRrl-AdjUNWH8KWHSEvO1ew&s',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
