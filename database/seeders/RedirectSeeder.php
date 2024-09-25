<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Redirect;

class RedirectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Redirect::create([
            'base_url_id' => '1',
            'logo_id' => '1',
            'redirect_preset_id' => '1'
        ]);
    }
}