<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index()
    {
        $courses = Course::select('id', 'nama_course', 'harga', 'banner_image','deskripsi')->latest()->get();

        $enrolledCourseIds = [];
        if (Auth::guard('student')->check()) {
            $enrolledCourseIds = Auth::guard('student')->user()
                ->enrollments()
                ->where('status', 'approved')
                ->pluck('course_id')
                ->toArray();
        }

        return view('welcome', compact('courses', 'enrolledCourseIds'));
    }
}