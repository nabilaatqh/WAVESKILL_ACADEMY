<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Materi;

class DashboardController extends Controller
{
    /**
     * Tampilan dashboard instruktur dengan daftar course, materi, dan project.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

      
        $courses = Course::where('instruktur_id', $user->id)->get();

        
        $selectedCourseId = $request->input('course_id') ?? ($courses->first()->id ?? null);

        $selectedCourse = $selectedCourseId
            ? Course::with(['materis', 'projects'])->find($selectedCourseId)
            : null;

        
        $materi = $selectedCourse ? $selectedCourse->materis : collect();
        $projects = $selectedCourse ? $selectedCourse->projects : collect();

        return view('instruktur.dashboard', compact('courses', 'selectedCourse', 'materi', 'projects'));
    }
}
