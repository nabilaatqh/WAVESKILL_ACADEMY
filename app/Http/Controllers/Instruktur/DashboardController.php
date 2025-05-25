<?php

namespace App\Http\Controllers\Instruktur;

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
    $user = Auth::user();

    $courses = Course::where('instruktur_id', $user->id)->get();

    $selectedCourseId = $request->input('course_id') ?? ($courses->first()->id ?? null);

    $searchMateri = $request->input('search_materi');
    $searchProject = $request->input('search_project');

    $selectedCourse = null;
    $materi = collect();
    $projects = collect();

    if ($selectedCourseId) {
        $selectedCourse = Course::find($selectedCourseId);

        if ($selectedCourse) {
            $materiQuery = Materi::where('course_id', $selectedCourse->id);

            if ($searchMateri) {
                $materiQuery->where('judul', 'like', "%{$searchMateri}%");
            }

            $materi = $materiQuery->orderBy('created_at', 'desc')->get();

            $projectQuery = Project::where('course_id', $selectedCourse->id);

            if ($searchProject) {
                $projectQuery->where('judul', 'like', "%{$searchProject}%");
            }

            $projects = $projectQuery->orderBy('created_at', 'desc')->get();
        }
    }

    return view('instruktur.dashboard', compact(
        'courses',
        'selectedCourse',
        'materi',
        'projects',
        'searchMateri',
        'searchProject'
    ));
}

}
