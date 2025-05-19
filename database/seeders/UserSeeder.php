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

        // Instructor
        User::create([
            'name' => 'Instruktur Kiwil',
            'email' => 'instructor@waveskill.test',
            'password' => Hash::make('password'),
            'role' => 'instructor',
            'is_active' => true,
        ]);

        // Student
        User::create([
            'name' => 'Mahasiswa Kiwil',
            'email' => 'student@waveskill.test',
            'password' => Hash::make('password'),
            'role' => 'student',
            'is_active' => true,
        ]);
    }
}