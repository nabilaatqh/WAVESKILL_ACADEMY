@extends('layouts.student')

@section('title', 'Project')

@section('content')
<div class="container py-4">
    <h4 class="mb-4 text-white">Daftar Project</h4>

    @forelse ($courses as $course)
        <h5 class="text-white">{{ $course->nama_course }}</h5>

        @forelse ($course->projects as $project)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $project->judul }}</h5>
                    <p class="card-text">{{ $project->deskripsi }}</p>
                    <a href="{{ route('student.project.show', $project->id) }}" class="btn btn-success btn-sm">Lihat</a>
                </div>
            </div>
        @empty
            <p class="text-muted">Tidak ada project untuk kursus ini.</p>
        @endforelse

        <hr class="text-light">
    @empty
        <p class="text-white">Belum mengikuti kursus apapun.</p>
    @endforelse
</div>
@endsection