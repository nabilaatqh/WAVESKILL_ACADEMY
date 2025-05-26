<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 


class courseController extends Controller
{
    // Daftar semua kursus
    public function index()
    {
        $student = Auth::guard('student')->user();

        // Ambil semua ID course yang sudah dibayar student
        $takenCourseIds = $student->enrollments()
            ->where('status', 'approved')
            ->pluck('course_id');

        // Ambil hanya course yang belum dibeli student ini
        $courses = Course::withCount('students')
            ->whereNotIn('id', $takenCourseIds)
            ->latest()
            ->get();

        return view('student.courses.index', compact('courses'));
    }

    // Detail kursus
    public function show($id)
    {
        // Detail course dengan relasi grup
        $course = Course::with('groups')->findOrFail($id)
            ->select('id', 'nama_course as title', 'deskripsi', 'harga')
            ->findOrFail($id);

        return view('student.courses.show', compact('course'));
    }
}
