<?php

namespace Database\Seeders\CanaryAccount;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;

class CanaryUserSeeder extends Seeder
{
    public function run()
    {
        // Retrieve the Canary organisation ID
        $organisationId = DB::table('organisations')
            ->where('name', 'Canary Organisation')
            ->value('id');

        // Insert the Canary user with the retrieved organisation ID
        DB::table('users')->updateOrInsert(
            ['email' => 'canary@auth.com'],
            [
                'name' => 'Canary Bot',
                'email_verified_at' => now(),
                'password' => Hash::make('canary_password'), // Use a strong password
                'remember_token' => Str::random(10),
                'organisation_id' => $organisationId,
                'role' => 'Bot',
                'phone' => '+44 7000000000',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
