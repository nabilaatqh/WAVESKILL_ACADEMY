<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $courses = [
            [
                'nama_course' => 'Pemrograman Laravel',
                'deskripsi' => 'Belajar framework Laravel dari dasar hingga mahir.',
                'harga' => 500000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_course' => 'Desain UI/UX dengan Figma',
                'deskripsi' => 'Pelajari cara membuat desain aplikasi dan website dengan Figma.',
                'harga' => 350000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_course' => 'Dasar JavaScript',
                'deskripsi' => 'Mengenal dasar-dasar bahasa pemrograman JavaScript.',
                'harga' => 300000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data course lain sesuai kebutuhan
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}