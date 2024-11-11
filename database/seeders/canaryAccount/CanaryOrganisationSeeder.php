<?php

namespace Database\Seeders\CanaryAccount;

use Illuminate\Database\Seeder;
use DB;

class CanaryOrganisationSeeder extends Seeder
{
    public function run()
    {
        DB::table('organisations')->updateOrInsert(
            ['name' => 'Canary Organisation'],
            [
                'address_line1' => '123 Canary Wharf',
                'city' => 'London',
                'country' => 'UK',
                'postcode' => 'E14 5AB',
                'contact_email' => 'contact@canaryauth.com',
                'contact_phone' => '+44 20 7000 0000',
                'logo_path' => 'https://www.strunkmedia.com/wp-content/uploads/2018/05/bigstock-221516158.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
