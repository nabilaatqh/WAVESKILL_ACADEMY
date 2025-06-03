@extends('layouts.student')

@section('title', 'Materi')

@section('content')
<div class="container py-4">
    <h4 class="mb-4 text-white">Daftar Materi</h4>

    @forelse ($courses as $course)
        <h5 class="text-white">{{ $course->nama_course }}</h5>

        @forelse ($course->materis as $materi)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $materi->judul }}</h5>
                    <p class="card-text">{{ $materi->deskripsi }}</p>
                    <a href="{{ route('student.materi.show', $materi->id) }}" class="btn btn-primary btn-sm">
                        Lihat
                    </a>
                </div>
            </div>
        @empty
            <p class="text-muted">Tidak ada materi tersedia untuk kursus ini.</p>
        @endforelse

        <hr class="text-light">
    @empty
        <p class="text-white">Belum mengikuti kursus apapun.</p>
    @endforelse
</div>
@endsection