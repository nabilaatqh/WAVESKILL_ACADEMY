<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Notifications\ProjectUploaded;

class ProjectController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $course = Course::where('instruktur_id', $user->id)->get();
        $projects = Project::whereIn('course_id', $course->pluck('id'))->get();
        return view('instruktur.project.index', compact('course', 'projects'));
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
            'tipe' => 'required|in:pdf,video,link',
            'file' => 'nullable|file|mimes:pdf,mp4|max:20480',
            'course_id' => 'required|exists:courses,id',
        ]);

        $course = Course::findOrFail($request->course_id);
        if ($course->instruktur_id !== Auth::id()) {
            abort(403);
        }

        $project = new Project();
        $project->judul = $request->judul;
        $project->deskripsi = $request->deskripsi;
        $project->tipe = $request->tipe;
        $project->course_id = $request->course_id;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('project_files', 'public');
            $project->file = $filePath;
        }

        $project->save();

        // ✅ Kirim notifikasi ke semua student yang enrolled & disetujui
        $students = Student::whereHas('approvedCourses', function ($q) use ($project) {
            $q->where('courses.id', $project->course_id);
        })->get();

        foreach ($students as $student) {
            $student->notify(new ProjectUploaded($course->nama_course, $project->judul));
        }

        return redirect()->route('instruktur.dashboard', [
            'course_id' => $project->course_id,
            'active_tab' => 'project'
        ])->with('success', 'Project berhasil ditambahkan dan notifikasi telah dikirim.');
    }

    public function show(Project $project)
    {
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
            abort(403);
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tipe' => 'required|in:pdf,video,link',
            'file' => 'nullable|file|mimes:pdf,mp4|max:20480',
            'course_id' => 'required|exists:courses,id',
        ]);

        $project->judul = $request->judul;
        $project->deskripsi = $request->deskripsi;
        $project->tipe = $request->tipe;
        $project->course_id = $request->course_id;

        if ($request->hasFile('file')) {
            if ($project->file && Storage::disk('public')->exists($project->file)) {
                Storage::disk('public')->delete($project->file);
            }

            $filePath = $request->file('file')->store('project_files', 'public');
            $project->file = $filePath;
        }

        $project->save();

        return redirect()->route('instruktur.dashboard', [
            'course_id' => $project->course_id,
            'active_tab' => 'project'
        ])->with('success', 'Project berhasil diperbarui.');
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
