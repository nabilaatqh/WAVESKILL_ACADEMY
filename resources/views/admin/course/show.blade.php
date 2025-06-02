@extends('layouts.admin')

@section('title', 'Detail Course')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm rounded mb-4">
        <div class="card-body">
            <h3 class="mb-3">{{ $course->nama_course }}</h3>

            <div class="mb-2">
                <strong>Instruktur:</strong>
                <p class="mb-0">{{ $course->instruktur->name ?? '-' }}</p>
            </div>

            <div class="mb-3">
                <strong>Deskripsi:</strong>
                <p class="mb-0 text-muted">{{ $course->deskripsi ?? '-' }}</p>
            </div>

            @if($course->whatsapp_link)
                <div class="mb-3">
                    <strong>Link WhatsApp Grup:</strong>
                    <p>
                        <a href="{{ $course->whatsapp_link }}" target="_blank" class="btn btn-sm btn-success">
                            Gabung WA Grup
                        </a>
                    </p>
                </div>
            @endif

            @if($course->certificate_file)
                <div class="mb-3">
                    <strong>Sertifikat Template:</strong><br>
                    <embed src="{{ asset('storage/' . $course->certificate_file) }}" type="application/pdf" width="100%" height="400px" class="rounded border mt-2">
                    <p class="mt-2">
                        <a href="{{ asset('storage/' . $course->certificate_file) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                            🔍 Lihat Sertifikat di Tab Baru
                        </a>
                    </p>
                </div>
            @endif

            @if($course->banner_image)
                <div class="mb-3">
                    <strong>Banner Course:</strong><br>
                    <img src="{{ asset('storage/' . $course->banner_image) }}"
                         alt="Banner Course" class="img-fluid rounded mt-2 border"
                         style="max-height: 350px; object-fit: cover;">
                </div>
            @endif
        </div>
    </div>

    <div class="card shadow-sm rounded">
        <div class="card-body">
            <h4 class="mb-3">📚 Daftar Student Terdaftar</h4>

            @if($course->students->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
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
                <p class="text-muted">Belum ada student yang terdaftar dalam course ini.</p>
            @endif

            <a href="{{ route('admin.course.index') }}" class="btn btn-secondary mt-3">
                ← Kembali ke Daftar Course
            </a>
        </div>
    </div>
</div>
@endsection
