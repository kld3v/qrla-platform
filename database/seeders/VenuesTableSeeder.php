<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class VenuesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('venues')->insert([
            [
                'name' => 'Stamford Bridge',
                'address_line1' => 'Fulham Road',
                'city' => 'London',
                'country' => 'UK',
                'postcode' => 'SW6 1HS',
                'type' => 'Sport',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/c/cc/Chelsea_FC.svg/800px-Chelsea_FC.svg.png',
                'banner_url' => 'https://groundhopperguides.com/wp-content/uploads/2016/08/touring-stamford-bridge-chelsea_1041.jpg',
                'capacity' => 41837,
                'status' => 'Active',
                'short_description' => 'The home of Chelsea FC.',
                'long_description' => 'Stamford Bridge is the home of Chelsea Football Club, one of the most successful clubs in English football history.',
                'contact_email' => 'info@chelseafc.com',
                'contact_phone' => '0371 811 1955',
                'management' => 'Chelsea Football Club',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Royal Albert Hall',
                'address_line1' => 'Kensington Gore',
                'city' => 'London',
                'country' => 'UK',
                'postcode' => 'SW7 2AP',
                'type' => 'Concert Hall',
                'logo_url' => null,
                'banner_url' => null,
                'capacity' => 5272,
                'status' => 'Active',
                'short_description' => null,
                'long_description' => null,
                'contact_email' => 'contact@royalalberthall.com',
                'contact_phone' => '020 7589 8212',
                'management' => 'Royal Albert Hall Trust',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
