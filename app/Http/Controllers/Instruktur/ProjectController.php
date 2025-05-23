<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::whereHas('course', function ($q) {
            $q->where('instruktur_id', Auth::id());
        })->latest()->get();

        return view('instruktur.project.index', compact('projects'));
    }

    public function create()
    {
        $courseList = Course::where('instruktur_id', Auth::id())->get();

        return view('instruktur.project.create', compact('courseList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'course_id' => 'required|exists:course,id',
        ]);

        // Cek akses instruktur ke course
        $course = Course::findOrFail($request->course_id);
        if ($course->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        Project::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'course_id' => $course->id,
        ]);

        return redirect()->route('instruktur.project.index')->with('success', 'Project berhasil dibuat.');
    }

    public function show(Project $project)
    {
        if ($project->course->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('instruktur.project.show', compact('project'));
    }

    public function edit(Project $project)
    {
        if ($project->course->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $courseList = Course::where('instruktur_id', Auth::id())->get();

        return view('instruktur.project.edit', compact('project', 'courseList'));
    }

    public function update(Request $request, Project $project)
    {
        if ($project->course->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'course_id' => 'required|exists:course,id',
        ]);

        // Cek akses instruktur ke course baru
        $course = Course::findOrFail($request->course_id);
        if ($course->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $project->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'course_id' => $course->id,
        ]);

        return redirect()->route('instruktur.project.index')->with('success', 'Project berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        if ($project->course->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $project->delete();

        return redirect()->route('instruktur.project.index')->with('success', 'Project berhasil dihapus.');
    }
}
