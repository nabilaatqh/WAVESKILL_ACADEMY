<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::create([
            'name' => 'Admin Kiwil',
            'email' => 'admin@waveskill.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
        ]);
    }
}