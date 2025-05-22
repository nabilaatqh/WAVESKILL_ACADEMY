@extends('layouts.instruktur')

@section('title', 'Materi Instruktur')

@section('content')
    <h2 class="welcome">Halo Selamat Datang, <br>
        <span class="highlight">Instruktur {{ Auth::user()->name }}</span>
    </h2>

    @if($kelasAktif)
        <div class="current-class-card">
            <h4>Kelas yang diajar saat ini</h4>
            <div class="class-box">
                <img src="{{ asset('storage/' . $kelasAktif->banner) }}" alt="Banner" class="dashboard-banner">
                <div class="class-desc">
                    <h3>{{ $kelasAktif->nama_kelas }}</h3>
                </div>
            </div>
        </div>
    @endif

    <div class="tab-menu mt-4">
        <button class="tab-button active">Materi</button>
        <a href="{{ route('instruktur.project.index') }}" class="tab-button">Project</a>
        <a href="{{ route('instruktur.kelas.index') }}" class="tab-button">Kelas Kamu</a>
    </div>

    <h4 class="section-title mt-5">Daftar Materi {{ $kelasAktif->nama_kelas ?? '' }}</h4>
    <input type="text" class="search-input" placeholder="Cari Materi">

    <div class="accordion-list mt-3">
        @forelse($materi as $m)
            <a href="{{ route('instruktur.materi.show', $m->id) }}" class="accordion">
                {{ $m->judul }}
            </a>
        @empty
            <p>Belum ada materi ditemukan.</p>
        @endforelse
    </div>
@endsection
