@extends('layouts.instruktur')

@section('title', 'Daftar Grup Kelas')

@section('content')
<div class="container">
    <h3 class="title-group">Daftar Grup Kelas</h3>

    @forelse($course as $course)
    <div class="group-card">
    @if($course->banner)
        <img src="{{ asset('storage/' . $course->banner) }}" class="group-banner" alt="Banner {{ $course->nama_course }}">
    @endif
    <div class="group-body">
        <h4>{{ $course->nama_course }}</h4>
        <p>{{ $course->deskripsi }}</p>
        <a href="{{ $course->whatsapp_link }}" target="_blank" class="group-btn">Lihat Grup Whatsapp</a>
    </div>
</div>

    @empty
        <p class="no-course">Belum ada course dengan grup WhatsApp.</p>
    @endforelse
</div>
@endsection
