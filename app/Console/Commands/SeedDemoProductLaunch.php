<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SeedDemoProductLaunch extends Command
{
    protected $signature = 'seed:demo-product-launch';

    protected $description = 'Run specific seeders for the demo product launch';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Starting demo product launch seeding process...');

        // Add all seeders here
        $seeders = [
            \Database\Seeders\demoLaunch\OrganisationsTableSeeder::class,
            \Database\Seeders\demoLaunch\UsersTableSeeder::class,
            \Database\Seeders\demoLaunch\VenuesTableSeeder::class,
            \Database\Seeders\demoLaunch\VenueUserTableSeeder::class,
            \Database\Seeders\demoLaunch\BaseUrlsTableSeeder::class,
            \Database\Seeders\demoLaunch\StandsTableSeeder::class,
            \Database\Seeders\demoLaunch\RedirectPresetSeeder::class,
            \Database\Seeders\demoLaunch\LogoSeeder::class,
            \Database\Seeders\demoLaunch\RedirectSeeder::class,
            \Database\Seeders\demoLaunch\BlocksTableSeederStanfordBridge::class,
            \Database\Seeders\demoLaunch\BlocksTableSeederSwanseacom::class,
            \Database\Seeders\demoLaunch\SeatsTableSeeder::class,
            \Database\Seeders\demoLaunch\MarkersTableSeeder::class,
            \Database\Seeders\demoLaunch\AccessLogSeeder::class,
        ];

        foreach ($seeders as $seeder) {
            $this->info("Running seeder: {$seeder}");
            Artisan::call('db:seed', ['--class' => $seeder]);
        }

        $this->info('Demo product launch seeding completed successfully.');
    }
}
