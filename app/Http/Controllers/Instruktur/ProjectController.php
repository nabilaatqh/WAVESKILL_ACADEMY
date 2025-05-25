<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $course = Course::where('instruktur_id', $user->id)->get();
        return view('instruktur.project.index', compact('course'));
    }

    public function create()
    {
        $course = Course::where('instruktur_id', Auth::id())->get();
        return view('instruktur.project.create', compact('course'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
            'file' => 'nullable|file|mimes:pdf|max:20480',
        ]);

        $course = Course::findOrFail($request->course_id);
        if ($course->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $project = new Project();
        $project->judul = $request->judul;
        $project->deskripsi = $request->deskripsi;
        $project->course_id = $course->id;
        $project->tipe = 'pdf'; // langsung set pdf

        if ($request->hasFile('file')) {
            $project->file = $request->file('file')->store('project_files', 'public');
        }

        $project->save();

        return redirect()->route('instruktur.dashboard', ['course_id' => $project->course_id])
            ->with('success', 'Project berhasil ditambahkan.');
    }

    public function show(Project $project)
    {
        if ($project->course->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
        return view('instruktur.project.show', compact('project'));
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        if ($project->course->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $course = Course::where('instruktur_id', Auth::id())->get();
        return view('instruktur.project.edit', compact('project', 'course'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        if ($project->course->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
            'file' => 'nullable|file|mimes:pdf|max:20480',
        ]);

        $course = Course::findOrFail($request->course_id);
        if ($course->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $project->judul = $request->judul;
        $project->deskripsi = $request->deskripsi;
        $project->course_id = $course->id;
        $project->tipe = 'pdf';

        if ($request->hasFile('file')) {
            if ($project->file) {
                Storage::disk('public')->delete($project->file);
            }
            $project->file = $request->file('file')->store('project_files', 'public');
        }

        $project->save();

        return redirect()->route('instruktur.dashboard', ['course_id' => $project->course_id])
            ->with('success', 'Project berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        if ($project->course->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        if ($project->file) {
            Storage::disk('public')->delete($project->file);
        }

        $project->delete();

        return redirect()->route('instruktur.dashboard', ['course_id' => $project->course_id])
            ->with('success', 'Project berhasil dihapus.');
    }
}
