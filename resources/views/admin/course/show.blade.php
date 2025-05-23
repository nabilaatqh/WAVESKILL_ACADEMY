@extends('layouts.admin')

@section('title', 'Detail Course')

@section('content')
<div class="container my-5">

    <div class="card shadow rounded-lg">
        <div class="card-body">
            <h2 class="card-title mb-4">{{ $course->nama_course }}</h2>

            <div class="mb-3">
                <strong>Instruktur:</strong>
                <p>{{ $course->instruktur ? $course->instruktur->name : '-' }}</p>
            </div>

            <div class="mb-3">
                <strong>Deskripsi:</strong>
                <p>{{ $course->deskripsi ?? '-' }}</p>
            </div>

            @if($course->banner_image)
            <div class="mb-4">
                <strong>Banner Course:</strong>
                <img src="{{ asset('storage/' . $course->banner_image) }}" alt="Banner Course"
                    class="img-fluid rounded mt-2 border" style="max-height: 350px; object-fit: cover;">
            </div>
            @endif
        </div>
    </div>

    <div class="card mt-4 shadow rounded-lg">
        <div class="card-body">
            <h4 class="card-title mb-3">Daftar Student</h4>

            @if($course->students->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Student</th>
                            <th>Email</th>
                            <th>Tanggal Bergabung</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($course->students as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->pivot->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p class="text-muted">Belum ada student yang terdaftar di course ini.</p>
            @endif

            <a href="{{ route('admin.course.index') }}" class="btn btn-secondary mt-3">
                <i class="fa fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

</div>
@endsection
