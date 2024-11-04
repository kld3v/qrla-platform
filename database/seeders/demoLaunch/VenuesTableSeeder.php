<?php

namespace Database\Seeders\demoLaunch;

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
                'banner_url' => 'https://www.stadiumtour.co.uk/wp-content/uploads/2024/06/Chelsea-Emirates-Stadium-Tour-D16x9--1500x630.jpeg',
                'map_svg_url' => 'https://qrla-b2b-bucket.s3.eu-west-2.amazonaws.com/platform/public/venue_svgs/1.svg',
                'capacity' => 40341,
                'status' => 'Active',
                'short_description' => 'The home of Chelsea FC.',
                'long_description' => 'Stamford Bridge is the home of Chelsea Football Club, one of the most successful clubs in English football history.',
                'contact_email' => 'info@chelseafc.com',
                'contact_phone' => '0371 811 1955',
                'plaque_image_url' => 'https://qrla-b2b-bucket.s3.eu-west-2.amazonaws.com/platform/public/venue_plaques/1.png',
                'organisation_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Swansea.com Stadium',
                'address_line1' => 'Landore',
                'city' => 'Swansea',
                'country' => 'Wales',
                'postcode' => 'SA1 2FA',
                'type' => 'Sport',
                'logo_url' => 'https://banner2.cleanpng.com/20190203/jao/kisspng-swansea-city-a-f-c-england-football-logo-swansea-city-afc-logos-download-1713906921319.webp',
                'banner_url' => 'https://cdn.swanseacity.com/sites/default/files/styles/cc_2000x1125/public/2019-11/Seating%20Plan%2016x9.jpg?itok=84Gubwe5',
                'capacity' => 21088,
                'status' => 'Active',
                'short_description' => 'The home of Swansea City FC - The Pride of Wales.',
                'long_description' => 'Swansea.com Stadium is the home of Swansea City Football Club, the most successful club in Welsh football history.',
                'contact_email' => 'contact@swanseacity.com',
                'contact_phone' => '020 7589 8212',
                'organisation_id' => 1,
                'map_svg_url' => 'https://qrla-b2b-bucket.s3.eu-west-2.amazonaws.com/platform/public/venue_svgs/2.2.svg',
                'plaque_image_url' => 'https://qrla-b2b-bucket.s3.eu-west-2.amazonaws.com/platform/public/venue_plaques/2.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // [
            //     'name' => 'Royal Albert Hall',
            //     'address_line1' => 'Kensington Gore',
            //     'city' => 'London',
            //     'country' => 'UK',
            //     'postcode' => 'SW7 2AP',
            //     'type' => 'Concert Hall',
            //     'logo_url' => null,
            //     'banner_url' => null,
            //     'capacity' => 5272,
            //     'status' => 'Active',
            //     'short_description' => null,
            //     'long_description' => null,
            //     'contact_email' => 'contact@royalalberthall.com',
            //     'contact_phone' => '020 7589 8212',
            //     'organisation_id' => 1,
            //     'map_svg_url' => 'https://qrla-b2b-bucket.s3.eu-west-2.amazonaws.com/platform/public/venue_svgs/2.svg',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
        ]);
    }
}