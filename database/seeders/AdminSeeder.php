<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'name' => 'Admin WaveSkill',
            'email' => 'admin@waveskill.test',
            'password' => bcrypt('password'), // jangan lupa sesuaikan passwordnya
        ]);
    }
}
