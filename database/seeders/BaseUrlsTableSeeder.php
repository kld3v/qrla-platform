<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class BaseUrlsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('base_urls')->insert([
            [
                'url' => 'https://www.google.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
