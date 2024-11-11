<?php

namespace Database\Seeders\CanaryAccount;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CanaryAccessLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Retrieve venue IDs for Canary test venues
        $venueIds = DB::table('venues')
            ->whereIn('name', ['Canary Test Venue 1', 'Canary Test Venue 2'])
            ->pluck('id');

        // Loop through each venue to seed access logs
        foreach ($venueIds as $venueId) {
            // Retrieve all block and seat markers for the current venue
            $markers = DB::table('markers')
                ->join('blocks', function ($join) {
                    $join->on('markers.markerable_id', '=', 'blocks.id')
                         ->where('markers.markerable_type', 'block');
                })
                ->join('stands', 'blocks.stand_id', '=', 'stands.id')
                ->where('stands.venue_id', $venueId)
                ->orWhere(function ($query) use ($venueId) {
                    $query->join('seats', function ($join) {
                        $join->on('markers.markerable_id', '=', 'seats.id')
                             ->where('markers.markerable_type', 'seat');
                    })
                    ->join('stands', 'seats.block_id', '=', 'stands.id')
                    ->where('stands.venue_id', $venueId);
                })
                ->select('markers.id')
                ->pluck('id');

            // Generate 10,000 access logs for the current venue
            $accessLogs = [];
            for ($i = 0; $i < 10000; $i++) {
                $markerId = $markers->random();
                $accessLogs[] = [
                    'marker_id'    => $markerId,
                    'ip_address'   => $this->generateIpAddress(),
                    'os'           => $this->randomOS(),
                    'browser'      => $this->randomBrowser(),
                    'user_agent'   => $this->generateUserAgent(),
                    'device'       => $this->randomDevice(),
                    'country'      => $this->randomCountry(),
                    'language'     => $this->randomLanguage(),
                    'referrer'     => $this->randomReferrer(),
                    'accessed_at'  => Carbon::now()->subDays(rand(0, 365))->toDateTimeString(),
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ];

                // Insert in batches of 1000 for efficiency
                if (count($accessLogs) >= 1000) {
                    DB::table('access_logs')->insert($accessLogs);
                    $accessLogs = [];
                }
            }

            // Insert any remaining access logs for the current venue
            if (!empty($accessLogs)) {
                DB::table('access_logs')->insert($accessLogs);
            }
        }
    }

    /**
     * Generate a realistic IP address.
     *
     * @return string
     */
    private function generateIpAddress(): string
    {
        return long2ip(rand(0, 4294967295));
    }

    /**
     * Randomly select an operating system.
     *
     * @return string
     */
    private function randomOS(): string
    {
        return ['iOS', 'Android', 'Windows', 'macOS'][array_rand(['iOS', 'Android', 'Windows', 'macOS'])];
    }

    /**
     * Randomly select a browser.
     *
     * @return string
     */
    private function randomBrowser(): string
    {
        return ['Safari', 'Chrome', 'Firefox', 'Edge'][array_rand(['Safari', 'Chrome', 'Firefox', 'Edge'])];
    }

    /**
     * Generate a user agent string.
     *
     * @return string
     */
    private function generateUserAgent(): string
    {
        return 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36';
    }

    /**
     * Randomly select a device type.
     *
     * @return string
     */
    private function randomDevice(): string
    {
        return ['Desktop', 'Mobile', 'Tablet'][array_rand(['Desktop', 'Mobile', 'Tablet'])];
    }

    /**
     * Randomly select a country.
     *
     * @return string
     */
    private function randomCountry(): string
    {
        return ['United States', 'United Kingdom', 'Germany', 'Canada', 'Australia'][array_rand(['United States', 'United Kingdom', 'Germany', 'Canada', 'Australia'])];
    }

    /**
     * Randomly select a language.
     *
     * @return string
     */
    private function randomLanguage(): string
    {
        return ['en-US', 'en-GB', 'de-DE', 'fr-FR', 'es-ES'][array_rand(['en-US', 'en-GB', 'de-DE', 'fr-FR', 'es-ES'])];
    }

    /**
     * Randomly select a referrer URL.
     *
     * @return string|null
     */
    private function randomReferrer(): ?string
    {
        $referrers = [
            'https://www.google.com',
            'https://www.facebook.com',
            'https://www.twitter.com',
            'https://www.reddit.com',
            null
        ];
        return $referrers[array_rand($referrers)];
    }
}
