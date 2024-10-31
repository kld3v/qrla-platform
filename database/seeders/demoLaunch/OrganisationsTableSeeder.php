<?php

namespace Database\Seeders\demoLaunch;

use Illuminate\Database\Seeder;
use DB;

class OrganisationsTableSeeder extends Seeder
{
    public function run()
    {
        // Seed for Levy Group
        DB::table('organisations')->updateOrInsert(
            ['name' => 'Levy Group'],
            [
                'address_line1' => 'Levy Road',
                'city' => 'London',
                'country' => 'UK',
                'postcode' => 'SW6 1HS',
                'contact_email' => 'info@levy.com',
                'contact_phone' => '0371 811 1955',
                'logo_path' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSDpVlECGVVc9EKRrl-AdjUNWH8KWHSEvO1ew&s',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('organisations')->updateOrInsert(
            ['name' => 'SumUp'],
            [
                'address_line1' => '32-34 Great Marlborough Street',
                'city' => 'London',
                'country' => 'UK',
                'postcode' => 'W1F 7JB',
                'contact_email' => 'support@sumup.com',
                'contact_phone' => '+44 20 3510 0160',
                'logo_path' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS20cB3o4LERzIiVXlJB7ByOqMGOLBcM_KSrw&s',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
