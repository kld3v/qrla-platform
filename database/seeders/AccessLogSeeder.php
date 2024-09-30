<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AccessLogSeeder extends Seeder
{
    public function run(): void
    {
        $batchSize = 1000; // Adjust the batch size based on available memory
        $totalRecords = 500000;
        $batches = [];

        for ($i = 0; $i < $totalRecords; $i++) {
            $batches[] = [
                'marker_id' => rand(1, 50000),
                'ip_address' => long2ip(rand(0, 4294967295)), // Generates a random IP address
                'user_agent' => $this->randomUserAgent(),
                'os' => $this->randomOS(),
                'device' => $this->randomDevice(),
                'country' => $this->randomCountry(),
                'browser' => $this->randomBrowser(),
                'language' => $this->randomLanguage(),
                'referrer' => $this->randomReferrer(),
                'accessed_at' => now()->subDays(rand(0, 365))->toDateTimeString(),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insert the batch in chunks of $batchSize to reduce memory usage
            if (count($batches) == $batchSize) {
                DB::table('access_logs')->insert($batches);
                $batches = [];
            }
        }

        // Insert any remaining records
        if (!empty($batches)) {
            DB::table('access_logs')->insert($batches);
        }
    }

    private function randomUserAgent(): string
    {
        $userAgents = [
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36 Edge/16.16299',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.97 Safari/537.36',
            'Mozilla/5.0 (Linux; Android 9; SM-J730G Build/PPR1.180610.011) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.101 Mobile Safari/537.36',
            // Add more as needed
        ];
        return $userAgents[array_rand($userAgents)];
    }

    private function randomOS(): ?string
    {
        $osList = ['Android', 'iOS', null];
        return $osList[array_rand($osList)];
    }

    private function randomDevice(): ?string
    {
        $devices = ['Mobile', 'Tablet', null];
        return $devices[array_rand($devices)];
    }

    private function randomCountry(): ?string
    {
        $countries = ['USA', 'UK', 'Germany', 'Canada', 'Australia', 'India', null];
        return $countries[array_rand($countries)];
    }

    private function randomBrowser(): ?string
    {
        $browsers = ['Chrome', 'Firefox', 'Safari', 'Edge', 'Opera', null];
        return $browsers[array_rand($browsers)];
    }

    private function randomLanguage(): ?string
    {
        $languages = ['en-US', 'en-GB', 'de-DE', 'fr-FR', 'es-ES', null];
        return $languages[array_rand($languages)];
    }

    private function randomReferrer(): ?string
    {
        $referrers = ['https://google.com', 'https://facebook.com', 'https://twitter.com', null];
        return $referrers[array_rand($referrers)];
    }
}
