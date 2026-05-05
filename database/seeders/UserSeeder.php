<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(['email' => 'admin@sttsiloam.ac.id'], [
            'name'              => 'Administrator',
            'email'             => 'admin@sttsiloam.ac.id',
            'password'          => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
    }
}
