@extends('layouts.landing')

@section('title', 'Status Pendaftaran Kursus')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">📋 Status Pendaftaran Kursus</h3>

    <div class="card">
        <div class="card-body">
            <p><strong>Kursus:</strong> {{ $enrollment->course->nama_course ?? $enrollment->course->title }}</p>

            <p><strong>Status:</strong>
                @if($enrollment->status == 'pending')
                    <span class="badge bg-warning text-dark">Menunggu Verifikasi</span>
                @elseif($enrollment->status == 'approved')
                    <span class="badge bg-success">Pendaftaran Disetujui</span>
                    <br>
                    <a href="{{ route('student.dashboard', $enrollment->course->id) }}" class="btn btn-sm btn-primary mt-2">Lihat Kelas</a>
                @else
                    <span class="badge bg-danger">Pendaftaran Ditolak</span>
                @endif
            </p>

            @if($enrollment->bukti_transfer)
                <p class="mt-3"><strong>Bukti Transfer:</strong></p>
                <img src="{{ asset('storage/' . $enrollment->bukti_transfer) }}" alt="Bukti Transfer" class="img-fluid rounded" style="max-width: 300px;">
            @endif
        </div>
    </div>

    <p class="mt-3 text-muted"><small>Mohon tunggu verifikasi admin maksimal 1x24 jam.</small></p>
    <a href="{{ route('student.landingpage') }}" class="btn btn-secondary mt-3">← Kembali ke Beranda</a>
</div>
@endsection
