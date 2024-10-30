<?php

namespace Database\Seeders\demoLaunch;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AccessLogSeeder extends Seeder
{
    /**
     * Total number of access log records to generate.
     */
    private int $totalRecords = 500000;

    /**
     * Batch size for inserting records.
     */
    private int $batchSize = 1000;

    /**
     * Tier weights for selection. Higher tiers have higher weights.
     * For 10 tiers: Tier 1:10, Tier 2:9, ..., Tier10:1
     */
    private array $tierWeights = [];

    /**
     * Predefined break periods to simulate dips in access logs.
     */
    private array $breakPeriods = [
        ['start' => '2023-12-25', 'end' => '2024-01-05'], // Christmas Break
        ['start' => '2024-03-08', 'end' => '2024-03-14'], // International Break 1
        ['start' => '2024-06-01', 'end' => '2024-06-07'], // Summer Break
        // Add more break periods as needed
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable query log for performance
        DB::disableQueryLog();

        $this->command->info('Starting AccessLogSeeder...');

        // Step 1: Fetch all blocks ordered by access_rate descending
        $blocks = DB::table('blocks')
            ->select('id', 'access_rate')
            ->orderByDesc('access_rate')
            ->get();

        if ($blocks->isEmpty()) {
            $this->command->error('No blocks found. Seeder cannot proceed.');
            return;
        }

        // Step 2: Assign blocks to 10 tiers
        $tiers = $this->assignTiers($blocks, 10);

        // Step 3: Assign tier weights
        $this->assignTierWeights(10);

        // Step 4: Fetch block markers
        $blockMarkers = DB::table('markers')
            ->where('markerable_type', 'block') // morph map key
            ->pluck('id', 'markerable_id') // pluck 'id' by 'markerable_id' (block id)
            ->toArray();

        // Step 5: Fetch seat markers
        $seatMarkers = DB::table('markers')
            ->where('markerable_type', 'seat') // morph map key
            ->pluck('id', 'markerable_id') // pluck 'id' by 'markerable_id' (seat id)
            ->toArray();

        // Step 6: Fetch seats grouped by block_id
        $seatsByBlock = DB::table('seats')
            ->select('id', 'block_id')
            ->get()
            ->groupBy('block_id');

        // Step 7: Organize markers by tier, separate for blocks and seats
        $tierBlockMarkers = [];
        $tierSeatMarkers = [];

        foreach ($tiers as $tier => $blockIds) {
            foreach ($blockIds as $blockId) {
                // Add block marker
                if (isset($blockMarkers[$blockId])) {
                    $tierBlockMarkers[$tier][] = $blockMarkers[$blockId];
                } else {
                    Log::warning("Block ID {$blockId} does not have a corresponding marker.");
                }

                // Add seat markers
                if (isset($seatsByBlock[$blockId])) {
                    foreach ($seatsByBlock[$blockId] as $seat) {
                        if (isset($seatMarkers[$seat->id])) {
                            $tierSeatMarkers[$tier][] = $seatMarkers[$seat->id];
                        } else {
                            Log::warning("Seat ID {$seat->id} in Block ID {$blockId} does not have a corresponding marker.");
                        }
                    }
                } else {
                    Log::warning("Block ID {$blockId} has no associated seats.");
                }
            }
        }

        // Remove tiers with no markers
        foreach ($tierBlockMarkers as $tier => $markers) {
            if (empty($markers)) {
                unset($tierBlockMarkers[$tier]);
                Log::warning("Tier {$tier} has no block markers.");
            }
        }

        foreach ($tierSeatMarkers as $tier => $markers) {
            if (empty($markers)) {
                unset($tierSeatMarkers[$tier]);
                Log::warning("Tier {$tier} has no seat markers.");
            }
        }

        // Step 8: Collect markers per tier is already done: tierBlockMarkers and tierSeatMarkers

        // Step 9: Flatten all block markers and seat markers
        $allBlockMarkers = [];
        foreach ($tierBlockMarkers as $tier => $markers) {
            $allBlockMarkers = array_merge($allBlockMarkers, $markers);
        }

        $allSeatMarkers = [];
        foreach ($tierSeatMarkers as $tier => $markers) {
            $allSeatMarkers = array_merge($allSeatMarkers, $markers);
        }

        if (empty($allBlockMarkers) && empty($allSeatMarkers)) {
            $this->command->error('No markers available for selection. Seeder cannot proceed.');
            return;
        }

        // Step 10: Initialize variables for batching
        $batches = [];
        $insertedRecords = 0;

        // Step 11: Seed access logs
        while ($insertedRecords < $this->totalRecords) {
            // Decide block or seat access
            // 400 block markers : 1 seat marker ratio
            // Total ratio parts: 400 +1 = 401
            // Probability to select block marker: 400/401 ≈99.75%
            // Probability to select seat marker: 1/401 ≈0.25%
            $rand = rand(0, 1.5);
            if ($rand >= 1) { // Select block marker
                $markerId = $this->selectBlockMarker($tiers, $tierBlockMarkers);
            } else { // Select seat marker
                $markerId = $this->selectSeatMarker($tiers, $tierSeatMarkers);
            }

            // If markerId is null, skip this iteration
            if ($markerId === null) {
                continue;
            }

            // Generate a single access log record
            $batches[] = $this->generateLogRecord($markerId);

            // Insert batch if reached batch size or if it's the last batch
            if (count($batches) >= $this->batchSize || ($insertedRecords + count($batches)) >= $this->totalRecords) {
                try {
                    DB::table('access_logs')->insert($batches);
                    $insertedRecords += count($batches);
                    $this->command->info("Inserted {$insertedRecords} / {$this->totalRecords} access logs.");
                } catch (\Exception $e) {
                    $this->command->error("Failed to insert batch: " . $e->getMessage());
                    Log::error("AccessLogSeeder: Failed to insert batch", ['error' => $e->getMessage()]);
                }
                $batches = [];
            }
        }

        $this->command->info('Access log seeding completed successfully.');
    }

    /**
     * Assign blocks to tiers based on access_rate.
     *
     * @param \Illuminate\Support\Collection $blocks
     * @param int $numTiers
     * @return array
     */
    private function assignTiers($blocks, int $numTiers): array
    {
        $tiers = [];
        $blocksPerTier = ceil($blocks->count() / $numTiers);

        for ($i = 1; $i <= $numTiers; $i++) {
            $start = ($i - 1) * $blocksPerTier;
            $tierBlocks = $blocks->slice($start, $blocksPerTier)->pluck('id')->toArray();
            if (!empty($tierBlocks)) {
                $tiers[$i] = $tierBlocks;
            }
        }

        return $tiers;
    }

    /**
     * Assign weights to tiers. Higher tiers have higher weights.
     *
     * @param int $numTiers
     * @return void
     */
    private function assignTierWeights(int $numTiers): void
    {
        for ($i = 1; $i <= $numTiers; $i++) {
            $this->tierWeights[$i] = $numTiers - $i + 1; // Tier 1:10, Tier 2:9,..., Tier10:1
        }
    }

    /**
     * Select a block marker based on tier weights.
     *
     * @param array $tiers
     * @param array $tierBlockMarkers
     * @return int|null
     */
    private function selectBlockMarker(array $tiers, array $tierBlockMarkers): ?int
    {
        // Calculate total tier weights
        $totalTierWeight = array_sum($this->tierWeights);

        // Generate a random number between 1 and totalTierWeight
        $randTier = rand(1, $totalTierWeight);

        // Determine which tier is selected
        $cumulative = 0;
        $selectedTier = null;
        foreach ($this->tierWeights as $tier => $weight) {
            $cumulative += $weight;
            if ($randTier <= $cumulative) {
                $selectedTier = $tier;
                break;
            }
        }

        if ($selectedTier === null || empty($tierBlockMarkers[$selectedTier])) {
            Log::warning("No blocks found in selected tier {$selectedTier} for block marker selection.");
            return null;
        }

        // Select a random block marker from the selected tier
        return $tierBlockMarkers[$selectedTier][array_rand($tierBlockMarkers[$selectedTier])];
    }

    /**
     * Select a seat marker based on tier weights.
     *
     * @param array $tiers
     * @param array $tierSeatMarkers
     * @return int|null
     */
    private function selectSeatMarker(array $tiers, array $tierSeatMarkers): ?int
    {
        // Calculate total tier weights
        $totalTierWeight = array_sum($this->tierWeights);

        // Generate a random number between 1 and totalTierWeight
        $randTier = rand(1, $totalTierWeight);

        // Determine which tier is selected
        $cumulative = 0;
        $selectedTier = null;
        foreach ($this->tierWeights as $tier => $weight) {
            $cumulative += $weight;
            if ($randTier <= $cumulative) {
                $selectedTier = $tier;
                break;
            }
        }

        if ($selectedTier === null || empty($tierSeatMarkers[$selectedTier])) {
            Log::warning("No seat markers found in selected tier {$selectedTier} for seat marker selection.");
            return null;
        }

        // Select a random seat marker from the selected tier
        return $tierSeatMarkers[$selectedTier][array_rand($tierSeatMarkers[$selectedTier])];
    }

    /**
     * Generate a single access log record.
     *
     * @param int $markerId
     * @return array
     */
    private function generateLogRecord(int $markerId): array
    {
        return [
            'marker_id'    => $markerId,
            'ip_address'   => $this->generateIpAddress(),
            'user_agent'   => $this->randomUserAgent(),
            'os'           => $this->randomOS(),
            'device'       => $this->randomDevice(),
            'country'      => $this->randomCountry(),
            'browser'      => $this->randomBrowser(),
            'language'     => $this->randomLanguage(),
            'referrer'     => $this->randomReferrer(),
            'accessed_at'  => $this->generateAccessTime(),
            'created_at'   => now(),
            'updated_at'   => now(),
        ];
    }

    /**
     * Generate a realistic IP address.
     *
     * @return string
     */
    private function generateIpAddress(): string
    {
        $popularIPs = [
            '192.168.' . rand(0, 255) . '.' . rand(0, 255),
            '10.' . rand(0, 255) . '.' . rand(0, 255) . '.' . rand(0, 255),
            '172.' . rand(16, 31) . '.' . rand(0, 255) . '.' . rand(0, 255),
        ];

        if (rand(1, 100) <= 70) { // 70% chance
            return $popularIPs[array_rand($popularIPs)];
        } else {
            return long2ip(rand(0, 4294967295));
        }
    }

    /**
     * Generate a realistic access time with football calendar simulation.
     *
     * @return string
     */
    private function generateAccessTime(): string
    {
        // Generate a date
        $randDayOffset = rand(0, 364); // Past year
        $date = Carbon::now('UTC')->subDays($randDayOffset);

        // Check if the date is within any break period
        foreach ($this->breakPeriods as $period) {
            $start = Carbon::parse($period['start'])->startOfDay();
            $end = Carbon::parse($period['end'])->endOfDay();
            if ($date->between($start, $end)) {
                // During break period, reduce access rate by 50%
                if (rand(1, 100) <= 50) {
                    // Skip generating access during break
                    return $this->generateAccessTime();
                }
            }
        }

        // Determine if it's a match day
        if ($this->isMatchDay($date->dayOfWeek)) {
            $hour = $this->getPeakHour();
        } else {
            $hour = $this->getOffPeakHour();
        }

        // Handle DST transition (example for specific date, adjust as needed)
        if ($date->month == 3 && $date->day == 31 && $hour == 1) {
            $hour = 2; // Adjust to skip the DST transition hour
        }

        $date->setTime($hour, rand(0, 59));

        // Reduce activity during off-season (June to August)
        if ($date->month >= 6 && $date->month <= 8) {
            if (rand(1, 100) <= 70) { // 70% chance
                $date->subDays(rand(30, 90)); // Less frequent activity
            }
        }

        return $date->toDateTimeString();
    }

    /**
     * Check if a given day is a match day.
     *
     * @param int $dayOfWeek
     * @return bool
     */
    private function isMatchDay(int $dayOfWeek): bool
    {
        // Assume matches are on Wednesdays (3) and Saturdays (6)
        return in_array($dayOfWeek, [3, 6]);
    }

    /**
     * Get a random peak hour.
     *
     * @return int
     */
    private function getPeakHour(): int
    {
        $peakHours = [15, 16, 17]; // 3 PM to 5 PM
        return $peakHours[array_rand($peakHours)];
    }

    /**
     * Get a random off-peak hour.
     *
     * @return int
     */
    private function getOffPeakHour(): int
    {
        $hours = [];

        // Early morning (0-5)
        for ($i = 0; $i <= 5; $i++) {
            $hours[] = $i;
        }

        // Daytime (6-14)
        for ($i = 6; $i <= 14; $i++) {
            $hours[] = $i;
        }

        // Evening (18-23)
        for ($i = 18; $i <= 23; $i++) {
            $hours[] = $i;
        }

        return $hours[array_rand($hours)];
    }

    /**
     * Generate a random user agent string.
     *
     * @return string
     */
    private function randomUserAgent(): string
    {
        $userAgents = [
            // Desktop browsers
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.1 Safari/605.1.15',
            // Mobile browsers
            'Mozilla/5.0 (Linux; Android 10; SM-G973F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Mobile Safari/537.36',
            'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1',
            // Add more user agents as needed
        ];

        return $userAgents[array_rand($userAgents)];
    }

    /**
     * Randomly select an operating system.
     *
     * @return string|null
     */
    private function randomOS(): ?string
    {
        $osList = ['Android', 'iOS', null];
        return $osList[array_rand($osList)];
    }

    /**
     * Randomly select a device type.
     *
     * @return string|null
     */
    private function randomDevice(): ?string
    {
        $devices = ['Desktop', 'Mobile', 'Tablet', null];
        return $devices[array_rand($devices)];
    }

    /**
     * Randomly select a country.
     *
     * @return string|null
     */
    private function randomCountry(): ?string
    {
        $countries = [
            'United States', 'United Kingdom', 'Germany', 'Canada', 'Australia',
            'India', 'Brazil', 'France', 'Spain', 'Italy', 'Netherlands', null
        ];
        return $countries[array_rand($countries)];
    }

    /**
     * Randomly select a browser.
     *
     * @return string|null
     */
    private function randomBrowser(): ?string
    {
        $browsers = ['Chrome', 'Firefox', 'Safari', 'Edge', 'Opera', null];
        return $browsers[array_rand($browsers)];
    }

    /**
     * Randomly select a language.
     *
     * @return string|null
     */
    private function randomLanguage(): ?string
    {
        $languages = ['en-US', 'en-GB', 'de-DE', 'fr-FR', 'es-ES', 'pt-BR', 'zh-CN', null];
        return $languages[array_rand($languages)];
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
            'https://www.linkedin.com',
            'https://www.instagram.com',
            null
        ];
        return $referrers[array_rand($referrers)];
    }
}
