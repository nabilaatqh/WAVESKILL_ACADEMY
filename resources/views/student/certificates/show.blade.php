@extends('layouts.student')

@section('title', 'Preview Sertifikat')

@section('content')
<div class="container mt-5 text-center">

    <h2 class="mb-4 text-white">Preview Sertifikat</h2>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Preview Sertifikat Template --}}
    <div class="certificate-preview border border-3 p-3 bg-white rounded shadow" style="max-width: 900px; margin:auto;">
        <img src="{{ $templatePath }}" alt="Sertifikat" class="img-fluid mb-4" style="max-height: 500px;">
        
        <h4 class="text-dark">Sertifikat untuk:</h4>
        <h2 class="fw-bold mb-3 text-primary">{{ $studentName }}</h2>

        <p class="text-muted mb-1">Kursus: <strong>{{ $courseName }}</strong></p>
        <p class="text-muted">Instruktur: {{ $instrukturName }}</p>

        <a href="{{ route('student.certificates.download', request()->route('course')) }}" class="btn btn-success mt-4">
            <i class="fas fa-download"></i> Unduh Sertifikat PDF
        </a>
    </div>

</div>
@endsection
