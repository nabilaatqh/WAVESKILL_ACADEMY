@extends('layouts.student')

@section('title', 'Sertifikat Saya')

@section('content')
<div class="container py-4">
    <h3 class="text-white mb-4">🎓 Sertifikat Kursus</h3>

    @if ($courses->isEmpty())
        <div class="alert alert-warning bg-light text-dark">Belum ada kursus yang kamu selesaikan.</div>
    @else
        <div class="row">
            @foreach ($courses as $course)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->nama_course }}</h5>
                            <p class="card-text text-muted">Instruktur: {{ $course->instruktur->name ?? '-' }}</p>

                            @php
                                $totalProjects = $course->projects->count();
                                $completedProjects = $course->projects->whereIn('id', $student->submissions->pluck('project_id'))->count();
                                $isComplete = $totalProjects > 0 && $completedProjects === $totalProjects;
                            @endphp

                            @if ($isComplete && $course->certificate_file)
                                <a href="{{ route('student.certificate.download', $course->id) }}" class="btn btn-success">
                                    📥 Download Sertifikat
                                </a>
                            @else
                                <button class="btn btn-secondary" disabled>
                                    🔒 Sertifikat terkunci
                                </button>
                                <p class="text-muted mt-2 mb-0" style="font-size: 0.9rem">
                                    Proyek selesai: {{ $completedProjects }} / {{ $totalProjects }}
                                </p>
                            @endif

                            <a href="{{ route('student.certificates.show', $course->id) }}" class="btn btn-outline-info btn-sm mt-2">
                                🔍 Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection