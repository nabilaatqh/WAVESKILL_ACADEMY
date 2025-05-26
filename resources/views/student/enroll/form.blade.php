@extends('layouts.student')

@section('content')
<h3>Daftar Kursus: {{ $course->nama_course }}</h3>

<p>Scan QRIS di bawah untuk pembayaran:</p>
<img src="{{ $qrisImageUrl }}" alt="QR QRIS" style="max-width:200px;">

<form method="POST" action="{{ route('student.enroll.process', $course->id) }}" enctype="multipart/form-data">
    @csrf
    <div>
        <label>Upload Bukti Pembayaran</label><br>
        <input type="file" name="bukti_transfer" required>
        @error('bukti_transfer') <div style="color:red">{{ $message }}</div> @enderror
    </div>
    <button type="submit">Kirim Bukti Pembayaran</button>
</form>

<p><small>Catatan: Tunggu verifikasi admin maksimal 1x24 jam.</small></p>
@endsection
