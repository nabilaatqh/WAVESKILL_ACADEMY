@extends('layouts.landing')

@section('content')
<a href="{{ route('student.landingpage') }}" class="btn btn-secondary mb-3">← Kembali</a>

<h2>Daftar Kursus</h2>

<div class="row">
    @forelse ($courses as $course)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset('image/bobo.png') }}" class="card-img-top" alt="Course Image" style="height:160px; object-fit:cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $course->title }}</h5>
                    <p class="text-danger fw-bold">Rp {{ number_format($course->harga, 0, ',', '.') }}</p>
                    <p class="card-text">Jumlah peserta: {{ $course->students_count }}</p>
                    <a href="{{ route('student.courses.show', $course->id) }}" class="btn btn-primary mt-auto">Detail Kursus</a>
                </div>
            </div>
        </div>
    @empty
        <p>Tidak ada kursus tersedia.</p>
    @endforelse
</div>
@endsection
