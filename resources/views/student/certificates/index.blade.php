@extends('layouts.student')

@section('title', 'Daftar Sertifikat')

@section('content')
<div class="container">
    <h2 class="mb-4 text-white">Daftar Sertifikat</h2>

    @if ($coursesWithCertificates->isEmpty())
        <p class="text-white">Belum ada sertifikat tersedia.</p>
    @else
        <div class="row g-4">
            @foreach ($coursesWithCertificates as $course)
                <div class="col-md-6">
                    <div class="card bg-warning text-dark p-3 rounded" style="border-radius: 12px;">
                        @if ($course->image)
                            <img src="{{ asset('images/' . $course->image) }}" alt="{{ $course->title }}" class="img-fluid rounded mb-3" style="max-height: 150px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/default-course.png') }}" alt="Default Image" class="img-fluid rounded mb-3" style="max-height: 150px; object-fit: cover;">
                        @endif

                        <h5 class="mb-2">{{ $course->title }}</h5>

                        <p style="font-size: 0.9rem; color: #4a4a4a;">
                            {{ Str::limit($course->description, 150) }}
                        </p>

                        <a href="{{ route('student.certificates.show', $course->id) }}" class="btn btn-danger w-100 mt-3">
                            Lihat Sertifikat
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
    .container {
        max-width: 900px;
    }
</style>
@endsection
