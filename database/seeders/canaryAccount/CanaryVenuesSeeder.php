<?php

namespace Database\Seeders\CanaryAccount;

use Illuminate\Database\Seeder;
use DB;

class CanaryVenuesSeeder extends Seeder
{
    public function run()
    {
        // Find Canary organisation ID
        $organisationId = DB::table('organisations')
            ->where('name', 'Canary Organisation')
            ->value('id');

        // Insert two test venues
        DB::table('venues')->insert([
            [
                'name' => 'Canary Test Venue 1',
                'address_line1' => '1 Test Road',
                'city' => 'Test City',
                'country' => 'UK',
                'postcode' => 'T1 1TS',
                'type' => 'Sport',
                'logo_url' => 'https://example.com/test-venue-1-logo.png',
                'banner_url' => 'https://example.com/test-venue-1-banner.jpg',
                'map_svg_url' => 'https://example.com/test-venue-1-map.svg',
                'capacity' => 5000,
                'status' => 'Active',
                'short_description' => 'A test venue for automated testing purposes.',
                'long_description' => 'Canary Test Venue 1 is designed specifically for server testing and automated scripts.',
                'contact_email' => 'test1@canary.com',
                'contact_phone' => '+44 7000000001',
                'plaque_image_url' => 'https://example.com/test-venue-1-plaque.png',
                'organisation_id' => $organisationId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Canary Test Venue 2',
                'address_line1' => '2 Test Road',
                'city' => 'Test City',
                'country' => 'UK',
                'postcode' => 'T2 2TS',
                'type' => 'Sport',
                'logo_url' => 'https://example.com/test-venue-2-logo.png',
                'banner_url' => 'https://example.com/test-venue-2-banner.jpg',
                'map_svg_url' => 'https://example.com/test-venue-2-map.svg',
                'capacity' => 3000,
                'status' => 'Active',
                'short_description' => 'Another test venue for automated testing purposes.',
                'long_description' => 'Canary Test Venue 2 is designed specifically for server testing and automated scripts.',
                'contact_email' => 'test2@canary.com',
                'contact_phone' => '+44 7000000002',
                'plaque_image_url' => 'https://example.com/test-venue-2-plaque.png',
                'organisation_id' => $organisationId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
