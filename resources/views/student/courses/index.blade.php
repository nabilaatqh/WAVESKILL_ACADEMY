@extends('layouts.landing')
@section('title', 'Daftar Kursus')

@section('content')
<div class="container py-4">
    <!-- Tombol Kembali -->
    <div class="mb-3">
        <a href="{{ route('student.landingpage') }}" class="btn btn-secondary">
            ← Kembali ke Landingpage
        </a>
    </div>

    <h2 class="mb-3">Daftar Kursus</h2>

    @if($courses->isEmpty())
        <div class="alert alert-warning">Belum ada course tersedia.</div>
    @else
        <div class="row g-4">
            @foreach($courses as $course)
                <div class="col-md-4">
                    <div class="card h-100">
                        @if($course->image)
                            <img src="{{ asset('images/' . $course->image) }}" class="card-img-top" alt="{{ $course->title }}" style="height:160px; object-fit:cover;">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $course->title }}</h5>
                            <p class="text-muted">{{ Str::limit($course->description, 100) }}</p>
                            <div class="mt-auto">
                                <span class="badge bg-primary">Rp {{ number_format($course->price, 0, ',', '.') }}</span>
                                <a href="{{ route('student.courses.show', $course->id) }}" class="btn btn-sm btn-primary float-end">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
