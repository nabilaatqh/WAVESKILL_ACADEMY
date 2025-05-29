<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\Project;

class SubmissionController extends Controller
{
    public function index(Project $project)
    {
        $submissions = Submission::with('student')
            ->where('project_id', $project->id)
            ->latest()
            ->get();

        return view('instruktur.submission.index', compact('project', 'submissions'));
    }

    public function show(Submission $submission)
{
    return view('instruktur.submission.show', compact('submission'));
}

public function update(Request $request, Submission $submission)
{
    $request->validate([
        'nilai' => 'required|integer|min:0|max:100',
        'catatan' => 'nullable|string',
    ]);

    $submission->update([
        'nilai' => $request->nilai,
        'catatan' => $request->catatan,
    ]);

    return redirect()->route('instruktur.submission.index', $submission->project_id)
                     ->with('success', 'Penilaian berhasil disimpan.');
}

}
