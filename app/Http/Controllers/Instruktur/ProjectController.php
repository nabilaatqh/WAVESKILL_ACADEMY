<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::whereHas('kelas', function ($q) {
            $q->where('instruktur_id', Auth::id());
        })->latest()->get();

        return view('instruktur.project.index', compact('projects'));
    }

    public function create()
    {
        $kelasList = Kelas::where('instruktur_id', Auth::id())->get();

        return view('instruktur.project.create', compact('kelasList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        // Cek akses instruktur ke kelas
        $kelas = Kelas::findOrFail($request->kelas_id);
        if ($kelas->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        Project::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kelas_id' => $kelas->id,
        ]);

        return redirect()->route('instruktur.project.index')->with('success', 'Project berhasil dibuat.');
    }

    public function show(Project $project)
    {
        if ($project->kelas->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('instruktur.project.show', compact('project'));
    }

    public function edit(Project $project)
    {
        if ($project->kelas->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $kelasList = Kelas::where('instruktur_id', Auth::id())->get();

        return view('instruktur.project.edit', compact('project', 'kelasList'));
    }

    public function update(Request $request, Project $project)
    {
        if ($project->kelas->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        // Cek akses instruktur ke kelas baru
        $kelas = Kelas::findOrFail($request->kelas_id);
        if ($kelas->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $project->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kelas_id' => $kelas->id,
        ]);

        return redirect()->route('instruktur.project.index')->with('success', 'Project berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        if ($project->kelas->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $project->delete();

        return redirect()->route('instruktur.project.index')->with('success', 'Project berhasil dihapus.');
    }
}
