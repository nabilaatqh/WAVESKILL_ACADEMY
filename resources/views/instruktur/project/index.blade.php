@extends('layouts.instruktur')

@section('title', 'Project Instruktur')

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
        <a href="{{ route('instruktur.materi.index') }}" class="tab-button">Materi</a>
        <button class="tab-button active">Project</button>
        <a href="{{ route('instruktur.kelas.index') }}" class="tab-button">Kelas Kamu</a>
    </div>

    <h4 class="section-title mt-5">
        Daftar Project {{ $kelasAktif ? $kelasAktif->nama_kelas : '' }}
    </h4>

    <input type="text" class="search-input" placeholder="Cari Project...">

    <div class="accordion-list mt-3">
        @forelse($projects as $p)
            <div class="accordion">
                <div class="left">
                    <h4>📁 {{ $p->judul }}</h4>
                    <p>{{ $p->deskripsi }}</p>
                    <p><strong>{{ $p->jumlah_submission ?? 0 }}</strong> Project dikumpulkan</p>
                </div>
                <div class="right">
                    <a href="{{ route('instruktur.project.show', $p->id) }}">
                        <button>Lihat Detail</button>
                    </a>
                </div>
            </div>
        @empty
            <p>Belum ada project ditemukan.</p>
        @endforelse
    </div>
@endsection