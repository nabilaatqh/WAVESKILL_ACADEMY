@extends('layouts.student')

@section('title', 'Detail Sertifikat')

@section('content')
<div class="container py-4">
    <h3 class="text-white mb-4">🎓 Sertifikat untuk: {{ $course->nama_course }}</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <p><strong>Instruktur:</strong> {{ $course->instruktur->name ?? '-' }}</p>
            <p><strong>Deskripsi:</strong> {{ $course->deskripsi ?? '-' }}</p>

            @php
                $totalProjects = $course->projects->count();
                $completedProjects = $course->projects->whereIn('id', $student->submissions->pluck('project_id'))->count();
                $isComplete = $totalProjects > 0 && $completedProjects === $totalProjects;
            @endphp

            @if ($isComplete && $course->certificate_file)
                <a href="{{ route('student.certificate.download', $course->id) }}" class="btn btn-success mt-3">
                    📥 Download Sertifikat
                </a>
            @else
                <div class="alert alert-warning mt-3">
                    🔒 Sertifikat terkunci. Kamu harus menyelesaikan semua project terlebih dahulu.
                    <p class="mb-0 mt-2">Progress: {{ $completedProjects }} / {{ $totalProjects }} project</p>
                </div>
            @endif

            <a href="{{ route('student.certificates.index') }}" class="btn btn-outline-secondary mt-4">← Kembali ke Sertifikat</a>
        </div>
    </div>
</div>
@endsection