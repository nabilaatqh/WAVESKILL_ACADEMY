@extends('layouts.instruktur')

@section('title', 'Daftar Grup Kelas')

@section('content')
<link rel="stylesheet" href="{{ asset('css/backsite/grup_kelas.css') }}">

<div class="container-center">
    <h3 class="title-group">Daftar Grup Kelas</h3>

    <div class="dashboard-wrapper container-center wrapper-grup">

        @forelse($course as $course)
        <div class="course-card mb-5">
            {{-- Banner Course --}}
            @if($course->banner_image)
                <img src="{{ asset('storage/' . $course->banner_image) }}" alt="Course Banner" class="course-banner">
            @else
                <img src="https://via.placeholder.com/1000x250?text=Course+Banner" alt="Default Banner" class="course-banner">
            @endif

            {{-- Isi Card --}}
            <div class="group-body">
                <h1 class="course-title">{{ $course->nama_course }}</h1>
                <p class="course-description" >{{ $course->deskripsi }}</p>
            </div>

            <a href="{{ $course->whatsapp_link }}" target="_blank" class="group-btn">Lihat Grup Whatsapp</a>
        </div>
        @empty
            <p class="text-center text-muted">Belum ada course dengan grup WhatsApp.</p>
        @endforelse

    </div>
</div>
@endsection
