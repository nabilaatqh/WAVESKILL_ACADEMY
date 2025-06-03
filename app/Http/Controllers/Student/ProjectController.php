<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Project;
use App\Models\Submission;

class ProjectController extends Controller
{
    public function index()
    {
        $student = Auth::guard('student')->user();

        // Load semua course beserta project-nya
        $courses = $student->enrollcourses()->with('projects')->get();

        // Gabungkan semua project jadi satu collection
        $projects = collect();
        foreach ($courses as $course) {
            $projects = $projects->merge($course->projects);
        }

        return view('student.dashboard', compact('courses', 'projects'));
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        $student = Auth::guard('student')->user();

        // ✅ Gunakan relasi query dan pluck
        $enrolledCourseIds = $student->enrollcourses()->pluck('courses.id');

        if (!$enrolledCourseIds->contains($project->course_id)) {
            abort(403, 'Kamu tidak memiliki akses ke project ini.');
        }

        // Cek apakah sudah submit
        $existingSubmission = Submission::where('student_id', $student->id)
                                ->where('project_id', $project->id)
                                ->latest()
                                ->first();

        return view('student.project.show', compact('project', 'existingSubmission'));
    }

    public function submit(Request $request, $id)
    {
        $request->validate([
            'submission_file' => 'required|file|mimes:pdf,zip,rar,docx|max:10000',
        ]);

        $project = Project::findOrFail($id);
        $student = Auth::guard('student')->user();

        $enrolledCourseIds = $student->enrollcourses()->pluck('courses.id');
        if (!$enrolledCourseIds->contains($project->course_id)) {
            abort(403, 'Tidak punya akses ke project ini.');
        }

        $path = $request->file('submission_file')->store('submissions', 'public');

        Submission::create([
            'student_id' => $student->id,
            'project_id' => $project->id,
            'course_id' => $project->course_id,
            'file' => $path,
            'catatan' => null,
            'nilai' => null,
        ]);

        return redirect()->back()->with('success', 'Project berhasil dikumpulkan!');
    }

}