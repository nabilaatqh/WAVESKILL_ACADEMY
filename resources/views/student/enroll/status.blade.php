@extends('layouts.student')

@section('content')
<h3>Status Pendaftaran Kursus</h3>

<p>Kursus: {{ $enrollment->course->nama_course }}</p>
<p>Status: 
    @if($enrollment->status == 'pending')
        <span style="color:orange">Menunggu Verifikasi</span>
    @elseif($enrollment->status == 'approved')
        <span style="color:green">Pendaftaran Disetujui</span>
        <a href="{{ route('student.courses.show', $enrollment->course->id) }}">Lihat Kelas</a>
    @else
        <span style="color:red">Pendaftaran Ditolak</span>
    @endif
</p>

@if($enrollment->bukti_transfer)
    <p>Bukti Transfer:</p>
    <img src="{{ asset('storage/' . $enrollment->bukti_transfer) }}" alt="Bukti Transfer" style="max-width:300px;">
@endif

<p><small>Mohon tunggu verifikasi admin maksimal 1x24 jam.</small></p>
@endsection
