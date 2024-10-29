<?php

namespace Database\Seeders\demoLaunch;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AccessLogSeeder extends Seeder
{
    public function run(): void
    {
        $batchSize = 1000; // Adjust the batch size based on available memory

        // First, find all markers with markerable_type == 'block'
        $blockMarkers = DB::table('markers')
            ->where('markerable_type', 'block')
            ->pluck('id')
            ->toArray();

        // Define some blocks that are busier (e.g., blocks 1, 2, 3 are busier)
        $busierBlocks = array_fill(0, 1.8 * count($blockMarkers), $blockMarkers[array_rand($blockMarkers)]); // Increase chance for busy blocks

        $totalRecordsForBlocks = 200000;
        $totalRecordsForAll = 300000;
        $batches = [];

        // Generate 200,000 records for block markers
        for ($i = 0; $i < $totalRecordsForBlocks; $i++) {
            $batches[] = $this->generateLogRecord($this->selectMarker($blockMarkers, $busierBlocks));

            if (count($batches) == $batchSize) {
                DB::table('access_logs')->insert($batches);
                $batches = [];
            }
        }

        // Insert any remaining block marker records
        if (!empty($batches)) {
            DB::table('access_logs')->insert($batches);
        }

        // Now generate 300,000 records across all marker ids (from 1 to 50,000)
        for ($i = 0; $i < $totalRecordsForAll; $i++) {
            $batches[] = $this->generateLogRecord(rand(1, max: 43500));

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

    // Select a marker with a higher chance for busy blocks
    private function selectMarker(array $blockMarkers, array $busierBlocks)
    {
        return rand(0, 2) === 0 ? $busierBlocks[array_rand($busierBlocks)] : $blockMarkers[array_rand($blockMarkers)];
    }

    // Generate a single log record with a given marker_id
    private function generateLogRecord($markerId): array
    {
        return [
            'marker_id' => $markerId,
            'ip_address' => long2ip(rand(0, 4294967295)), // Generates a random IP address
            'user_agent' => $this->randomUserAgent(),
            'os' => $this->randomOS(),
            'device' => $this->randomDevice(),
            'country' => $this->randomCountry(),
            'browser' => $this->randomBrowser(),
            'language' => $this->randomLanguage(),
            'referrer' => $this->randomReferrer(),
            'accessed_at' => $this->generateAccessTime(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    private function generateAccessTime(): string
    {
        $now = Carbon::now();
        $dayOfWeek = rand(0, 6); // Monday = 0, Sunday = 6
        $hourOfDay = rand(0, 23);
        $month = rand(1, 12);
        
        // Make Saturdays busier, especially between 3 PM and 5 PM
        if ($dayOfWeek == 6) {
            if (rand(0, 10) > 2) {
                $hourOfDay = rand(15, 17); // Busier between 3 PM and 5 PM on Saturdays
            }
        }

        // Reduce activity in off-season (June to September)
        if ($month >= 6 && $month <= 9) {
            if (rand(0, 10) > 2) {
                return $now->subDays(rand(90, 365))->toDateTimeString(); // Less frequent activity
            }
        }

        return Carbon::createFromDate(null, $month, rand(1, 28))
            ->setTime($hourOfDay, rand(0, 59))
            ->toDateTimeString();
    }

    // Random data generators (same as your original ones)
    private function randomUserAgent(): string
    {
        $userAgents = [
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36 Edge/16.16299',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.97 Safari/537.36',
            'Mozilla/5.0 (Linux; Android 9; SM-J730G Build/PPR1.180610.011) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.101 Mobile Safari/537.36',
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
