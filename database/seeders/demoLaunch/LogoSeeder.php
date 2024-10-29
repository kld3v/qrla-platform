<?php

namespace Database\Seeders\demoLaunch;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Logo;

class LogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Logo::create([
            'venue_id' => '1',
            'path' => 'https://upload.wikimedia.org/wikipedia/en/thumb/c/cc/Chelsea_FC.svg/800px-Chelsea_FC.svg.png'
        ]);
        Logo::create([
            'venue_id' => '2',
            'path' => 'https://seeklogo.com/images/S/Swansea_City_07_08-logo-02385A9518-seeklogo.com.png'
        ]);
    }
}
