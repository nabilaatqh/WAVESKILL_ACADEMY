<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Kelas;

class ProjectController extends Controller
{
    public function index()
    {
        $project = Project::with('kelas')->get();
        return view('instruktur.project.index', compact('project'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('instruktur.project.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'deadline' => 'nullable|date',
        ]);

        Project::create($data);
        return redirect()->route('instruktur.project.index')->with('success', 'Project berhasil ditambahkan.');
    }

    public function edit(Project $project)
    {
        $this->authorize('update', $project);
        $kelas = Kelas::all();
        return view('instruktur.project.edit', compact('project', 'kelas'));
    }

    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $data = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'deadline' => 'nullable|date',
        ]);

        $project->update($data);
        return redirect()->route('instruktur.project.index')->with('success', 'Project diperbarui.');
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);
        $project->delete();
        return redirect()->route('instruktur.project.index')->with('success', 'Project dihapus.');
    }
}
