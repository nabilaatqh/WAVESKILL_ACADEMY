<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Student\LandingPageRequest;
use App\Models\Student;
use App\Http\Requests\Student\CourseRequest;   


class LandingPageController extends Controller
{
    public function index()
    {
        $student = auth()->guard('student')->user();
        if (!$student) {
            return redirect()->route('student.dashboard');
        }
        $courses = Course::select('id', 'nama_course', 'harga','banner_image','deskripsi')->latest()->take(9)->get();
        return view('student.landingpage', compact('student', 'courses'));
    }
}

