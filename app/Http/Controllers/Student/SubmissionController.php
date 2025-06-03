<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Project;
use App\Models\Submission;

class SubmissionController extends Controller
{
    public function create($projectId)
    {
        $project = Project::findOrFail($projectId);

        return view('student.project.submit', compact('project'));
    }

    public function store(Request $request, $projectId)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,mp4|max:20480', // Maks 20MB
        ]);

        $project = Project::findOrFail($projectId);
        $student = Auth::guard('student')->user();

        // Simpan file
        $path = $request->file('file')->store('submissions', 'public');

        // Simpan ke database
        Submission::create([
            'student_id' => $student->id,
            'project_id' => $project->id,
            'course_id' => $project->course_id,
            'file' => $path,
        ]);

        return redirect()->route('student.project.index')->with('success', 'Project berhasil dikumpulkan.');
    }
}
