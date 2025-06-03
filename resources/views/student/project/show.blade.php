@extends('layouts.student')

@section('title', 'Detail Project')

@section('content')
<div class="container py-4">
    <h3>{{ $project->judul }}</h3>
    <p>{{ $project->deskripsi }}</p>

    @php $ext = pathinfo($project->file, PATHINFO_EXTENSION); @endphp

    @if ($ext === 'pdf')
        <iframe src="{{ asset('storage/' . $project->file) }}" width="100%" height="600px"></iframe>
    @elseif ($ext === 'mp4')
        <video width="100%" controls>
            <source src="{{ asset('storage/' . $project->file) }}" type="video/mp4">
        </video>
    @else
        <a href="{{ asset('storage/' . $project->file) }}" class="btn btn-primary" target="_blank">Lihat File</a>
    @endif

    @if (!$existingSubmission)
        <form action="{{ route('student.project.submit.store', $project->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
            @csrf
            <div class="mb-3">
                <label for="submission_file">Upload Tugas (PDF/ZIP/RAR/DOCX)</label>
                <input type="file" name="submission_file" class="form-control" required accept=".pdf,.zip,.rar,.docx">
            </div>
            <button type="submit" class="btn btn-success">Kumpulkan</button>
        </form>
    @else
        <div class="alert alert-success mt-3">
            Kamu sudah mengumpulkan tugas ini.
            <a href="{{ asset('storage/' . $existingSubmission->file) }}" target="_blank" class="btn btn-sm btn-info mt-2">Lihat File yang Dikumpulkan</a>
        </div>
    @endif
</div>
@endsection