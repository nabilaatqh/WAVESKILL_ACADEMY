@extends('layouts.student')

@section('title', 'Pembayaran Kursus')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">💳 Pembayaran Kursus: {{ $course->nama_course ?? $course->title }}</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="text-center mb-4">
        <p>Silakan scan QRIS berikut untuk melakukan pembayaran:</p>
        <img src="{{ $qrisImageUrl }}" alt="QR QRIS" class="img-fluid" style="max-width: 300px;">
    </div>

    <form method="POST" action="{{ route('student.enroll.process', $course->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="bukti_transfer" class="form-label">Upload Bukti Pembayaran</label>
            <input type="file" name="bukti_transfer" id="bukti_transfer" class="form-control" required>
            @error('bukti_transfer')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Kirim Bukti Pembayaran</button>
    </form>

    <p class="mt-3 text-muted"><small>Catatan: Tunggu verifikasi admin maksimal 1x24 jam.</small></p>
</div>
@endsection
