<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SeedCanaryData extends Command
{
    protected $signature = 'seed:canary';
    protected $description = 'Run specific seeders for the Canary account setup';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Starting Canary account seeding process...');

        $seeders = [
            \Database\Seeders\CanaryAccount\CanaryOrganisationSeeder::class,
            \Database\Seeders\CanaryAccount\CanaryUserSeeder::class,
            \Database\Seeders\CanaryAccount\CanaryVenuesSeeder::class,
            \Database\Seeders\CanaryAccount\CanaryVenueUserSeeder::class,
            \Database\Seeders\CanaryAccount\CanaryStandsSeeder::class,
            \Database\Seeders\CanaryAccount\CanaryLogoSeeder::class,
            \Database\Seeders\CanaryAccount\CanaryRedirectSeeder::class,
            \Database\Seeders\CanaryAccount\CanaryBlocksSeeder::class,
            \Database\Seeders\CanaryAccount\CanarySeatsSeeder::class,
            \Database\Seeders\CanaryAccount\CanaryMarkersSeeder::class,
            \Database\Seeders\CanaryAccount\CanaryAccessLogSeeder::class,
        ];

        foreach ($seeders as $seeder) {
            $this->info("Running seeder: {$seeder}");
            Artisan::call('db:seed', ['--class' => $seeder]);
        }

        $this->info('Canary account seeding completed successfully.');
    }
}
