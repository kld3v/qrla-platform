<?php

namespace Database\Seeders\demoLaunch;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'organisation_id' => 1,
                'role' => 'Admin',
                'phone'=> '+44 7000000000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'John Doe',
                'email' => 'johndoe@example.com',
                'email_verified_at' => null,
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'organisation_id' => 1,
                'role' => 'Venue Manager',
                'phone'=> '+44 7000000000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}