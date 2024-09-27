<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RedirectPreset;

class RedirectPresetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RedirectPreset::create([
            'name' => 'Preset 1',
            'thumbnail' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSL-7Q06lI-nhdp3tyUMVQ-8caiBPpvBb49Tg&s',
            'file_name' => 'preset_1'
        ]);
    }
}
