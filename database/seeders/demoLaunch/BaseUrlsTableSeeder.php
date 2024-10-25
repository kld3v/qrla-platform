<?php
namespace Database\Seeders\demoLaunch;

use Illuminate\Database\Seeder;
use DB;

class BaseUrlsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('base_urls')->insert([
            [
                'url' => 'https://www.levy.co.uk',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
