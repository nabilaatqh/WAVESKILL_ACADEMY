<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class courseController extends Controller
{
    // Daftar semua kursus
    public function index()
    {
        $courses = Course::withCount('students')->get(); // jika belum ada data, akan kosong
        return view('student.courses.index', compact('courses'));
    }

    // Detail kursus
    public function show($id)
    {
        // Ambil kursus berdasarkan ID dengan relasi grup kelas
        $course = Course::with('groups')->findOrFail($id);

        // Bisa tambahkan data lain jika perlu, misalnya materi, instruktur, dsb

        return view('student.courses.show', compact('course'));
    }
}
