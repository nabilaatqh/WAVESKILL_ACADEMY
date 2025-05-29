<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use Illuminate\Http\Request;


class courseController extends Controller
{
    // Daftar semua kursus
    public function index()
    {
        
        $student = Auth::guard('student')->user();
         // Ambil semua course dengan hitung jumlah student (seperti di admin)
        $courses = Course::withCount('students')->latest()->get();

        return view('student.courses.index', compact('courses'));
    }

    // Detail kursus
    public function show($id)
    {
        // Detail course dengan relasi grup
        $course = Course::with('groups')
            ->select('id', 'nama_course as title', 'deskripsi', 'harga')
            ->findOrFail($id);

        return view('student.courses.show', compact('course'));
    }
}
