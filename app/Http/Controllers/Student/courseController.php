<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Http\Requests\Student\CourseRequest;

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
            ->select('id', 'nama_course', 'deskripsi', 'harga','banner_image')
            ->findOrFail($id);
        $student = Auth::guard('student')->user();
        // Cek apakah student sudah pernah enroll di course ini
        $enrollment = Enrollment::where('student_id', $student->id)
            ->where('course_id', $id)
            ->where('status', 'approved')
            ->first();

        return view('student.courses.detail', compact('course', 'enrollment'));
    }
}
