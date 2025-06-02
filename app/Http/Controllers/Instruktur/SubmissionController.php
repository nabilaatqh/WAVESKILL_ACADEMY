<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    // Tampilkan semua submission dari Student untuk 1 project
    public function index($projectId)
    {
        $project = Project::with('course')->findOrFail($projectId);

        // Pastikan project milik instruktur yang sedang login
        if ($project->course->instruktur_id !== Auth::id()) {
            abort(403, 'Akses ditolak');
        }

        $submissions = Submission::with('student')
            ->where('project_id', $projectId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('instruktur.submission.index', compact('project', 'submissions'));
    }

    // Tampilkan detail submission + form penilaian
    public function show($id)
    {
        $submission = Submission::with(['student', 'project.course'])->findOrFail($id);

        if ($submission->project->course->instruktur_id !== Auth::id()) {
            abort(403, 'Akses ditolak');
        }

        return view('instruktur.submission.show', compact('submission'));
    }

    // Update penilaian
    public function update(Request $request, $id)
    {
        $submission = Submission::with('project.course')->findOrFail($id);

        if ($submission->project->course->instruktur_id !== Auth::id()) {
            abort(403, 'Akses ditolak');
        }

        $request->validate([
            'nilai' => 'required|numeric|min:0|max:100',
            'catatan' => 'nullable|string',
        ]);

        $submission->nilai = $request->nilai;
        $submission->catatan = $request->catatan;
        $submission->save();

        return redirect()
            ->route('instruktur.submission.index', $submission->project_id)
            ->with('success', 'Penilaian berhasil disimpan.');
    }
}
