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

        // Fetch all block marker IDs
        $blockMarkers = DB::table('markers')
            ->where('markerable_type', 'block')
            ->pluck('id')
            ->toArray();

        // Define busier blocks (e.g., top 10% busiest blocks)
        $busierBlockIds = $this->selectBusierBlocks($blockMarkers);

        $totalRecords = 500000;
        $batches = [];

        // Generate records
        for ($i = 0; $i < $totalRecords; $i++) {
            // Select a marker ID with higher probability for busier blocks
            $markerId = $this->selectMarkerId($blockMarkers, $busierBlockIds);

            $batches[] = $this->generateLogRecord($markerId);

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

    private function selectBusierBlocks(array $blockMarkers): array
    {
        // Select top 10% of blocks as busier blocks
        $numberOfBusierBlocks = (int) (0.1 * count($blockMarkers));
        shuffle($blockMarkers); // Randomize before selecting
        return array_slice($blockMarkers, 0, $numberOfBusierBlocks);
    }

    // Select a marker with higher chance for busier blocks
    private function selectMarkerId(array $blockMarkers, array $busierBlockIds): int
    {
        // Assign higher probability to busier blocks
        if (rand(1, 100) <= 70) { // 70% chance
            return $busierBlockIds[array_rand($busierBlockIds)];
        } else {
            return $blockMarkers[array_rand($blockMarkers)];
        }
    }

    // Generate a single log record with a given marker_id
    private function generateLogRecord($markerId): array
    {
        return [
            'marker_id' => $markerId,
            'ip_address' => $this->generateIpAddress(),
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

    private function generateIpAddress(): string
    {
        // Generate a realistic IP address distribution
        $popularIPs = [
            '192.168.' . rand(0, 255) . '.' . rand(0, 255),
            '10.' . rand(0, 255) . '.' . rand(0, 255) . '.' . rand(0, 255),
            '172.' . rand(16, 31) . '.' . rand(0, 255) . '.' . rand(0, 255),
        ];

        if (rand(1, 100) <= 70) { // 70% chance to pick popular IP ranges
            return $popularIPs[array_rand($popularIPs)];
        } else {
            return long2ip(rand(0, 4294967295));
        }
    }

    private function generateAccessTime(): string
    {
        // Set timezone to UTC to avoid DST issues
        $date = Carbon::now('UTC')->subDays(rand(0, 365));
    
        // Increase activity on match days and during peak hours
        if ($this->isMatchDay($date->dayOfWeek)) {
            $hour = $this->getPeakHour();
        } else {
            $hour = $this->getOffPeakHour();
        }

        if ($date->month == 3 && $date->day == 31 && $hour == 1) {
            $hour = 2; // Adjust to skip the DST transition hour
        }
    
        $date->setTime($hour, rand(0, 59));
    
        // Ensure the generated datetime doesn't fall into a DST transition
        while (!$this->isValidDateTime($date)) {
            // If invalid, add one hour to skip the missing hour
            $date->addHour();
        }
    
        // Reduce activity during off-season (June to August)
        if ($date->month >= 6 && $date->month <= 8) {
            if (rand(1, 100) <= 70) { // 70% chance
                $date->subDays(rand(30, 90)); // Less frequent activity
            }
        }
    
        return $date->toDateTimeString();
    }
    
    private function isValidDateTime(Carbon $date): bool
    {
        // // Check if the datetime is valid in the database's time zone
        // try {
        //     // Try formatting the date; if it's invalid, an exception will be thrown
        //     $dateString = $date->format('Y-m-d H:i:s');
        //     new \DateTime($dateString);
        //     return true;
        // } catch (\Exception $e) {
        //     return false;
        // }

        //cut out all that shit for now
        return true;
    }
        

    private function isMatchDay(int $dayOfWeek): bool
    {
        // Assume matches are on Wednesdays (3) and Saturdays (6)
        return in_array($dayOfWeek, [3, 6]);
    }

    private function getPeakHour(): int
    {
        // Peak hours during matches
        $peakHours = [15, 16, 17]; // 3 PM to 5 PM
        return $peakHours[array_rand($peakHours)];
    }

    private function getOffPeakHour(): int
    {
        // Random hour with lower activity
        $hours = array_merge(
            array_fill(0, 5, rand(0, 5)),    // Early morning, low activity
            array_fill(0, 10, rand(6, 14)),  // Daytime, moderate activity
            array_fill(0, 5, rand(18, 23))   // Evening, moderate activity
        );
        return $hours[array_rand($hours)];
    }

    // Random data generators
    private function randomUserAgent(): string
    {
        $userAgents = [
            // Desktop browsers
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64)...',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7)...',
            // Mobile browsers
            'Mozilla/5.0 (Linux; Android 10; SM-G973F)...',
            'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X)...',
            // Add more user agents for diversity
        ];
        return $userAgents[array_rand($userAgents)];
    }

    private function randomOS(): ?string
    {
        $osList = ['Windows', 'macOS', 'Linux', 'Android', 'iOS', null];
        return $osList[array_rand($osList)];
    }

    private function randomDevice(): ?string
    {
        $devices = ['Desktop', 'Mobile', 'Tablet', null];
        return $devices[array_rand($devices)];
    }

    private function randomCountry(): ?string
    {
        $countries = [
            'United States', 'United Kingdom', 'Germany', 'Canada', 'Australia',
            'India', 'Brazil', 'France', 'Spain', 'Italy', 'Netherlands', null
        ];
        return $countries[array_rand($countries)];
    }

    private function randomBrowser(): ?string
    {
        $browsers = ['Chrome', 'Firefox', 'Safari', 'Edge', 'Opera', null];
        return $browsers[array_rand($browsers)];
    }

    private function randomLanguage(): ?string
    {
        $languages = ['en-US', 'en-GB', 'de-DE', 'fr-FR', 'es-ES', 'pt-BR', 'zh-CN', null];
        return $languages[array_rand($languages)];
    }

    private function randomReferrer(): ?string
    {
        $referrers = [
            'https://www.google.com',
            'https://www.facebook.com',
            'https://www.twitter.com',
            'https://www.reddit.com',
            'https://www.linkedin.com',
            'https://www.instagram.com',
            null
        ];
        return $referrers[array_rand($referrers)];
    }
}
