<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Group;

class GroupAutoSeeder extends Seeder
{
    public function run()
    {
        $coursesWithoutGroup = Course::whereDoesntHave('groups')->get();

        foreach ($coursesWithoutGroup as $course) {
            Group::create([
                'title' => 'Grup ' . $course->nama_course,
                'description' => 'Grup otomatis untuk kursus ini.',
                'whatsapp_link' => $course->whatsapp_link, // bisa diedit nanti
                'course_id' => $course->id,
            ]);

            echo "✅ Grup dibuat untuk course: {$course->nama_course}\n";
        }

        echo "\nSelesai membuat semua grup yang belum ada.\n";
    }
}
