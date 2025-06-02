<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Materi;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $student = Auth::guard('student')->user();

        // Ambil semua course yang diikuti student
        $enrolledCourses = $student->enrolledCourses()
            ->with(['projects', 'materis', 'instruktur'])
            ->get();

        // Ambil selected course ID dari query, atau pakai course pertama
        $selectedCourseId = $request->input('course_id') ?? ($enrolledCourses->first()->id ?? null);
        $activeTab = $request->input('active_tab', 'materi');

        $searchMateri = $request->input('search_materi');
        $searchProject = $request->input('search_project');

        $selectedCourse = null;
        $materi = collect();
        $projects = collect();

        if ($selectedCourseId) {
            $selectedCourse = $enrolledCourses->where('id', $selectedCourseId)->first();

            if ($selectedCourse) {
                // Filter materi
                if ($activeTab === 'materi') {
                    $materiQuery = $selectedCourse->materis();
                    if ($searchMateri) {
                        $materiQuery->where('judul', 'like', "%{$searchMateri}%");
                    }
                    $materi = $materiQuery->orderBy('created_at', 'desc')->get();
                }

                // Filter project
                if ($activeTab === 'project') {
                    $projectQuery = $selectedCourse->projects();
                    if ($searchProject) {
                        $projectQuery->where('judul', 'like', "%{$searchProject}%");
                    }
                    $projects = $projectQuery->orderBy('created_at', 'desc')->get();
                }
            }
        }

        return view('student.dashboard', compact(
            'student',
            'enrolledCourses',
            'selectedCourse',
            'materi',
            'projects',
            'searchMateri',
            'searchProject',
            'activeTab'
        ));
    }
}
