@extends('layouts.instruktur')

@section('title', 'Dashboard Instruktur')

@section('content')
<div class="dashboard-wrapper">

    {{-- Welcome Section --}}
    <div class="welcome-section">
        <h3>
            Halo Selamat Datang,<br>
            instruktur, <span class="highlight">{{ Auth::user()->name }}</span>
        </h3>

        @if($kelasAktif)
        <div class="kelas-card">
            @if($kelasAktif->banner)
            <img src="{{ asset('storage/' . $kelasAktif->banner) }}" alt="Banner Kelas" class="kelas-banner" />
            @endif
            <h4>{{ $kelasAktif->nama_kelas }}</h4>
            <p>{{ $kelasAktif->deskripsi }}</p>
        </div>
        @else
        <p class="no-kelas">Belum ada kelas yang diassign.</p>
        @endif
    </div>

    {{-- Tab Navigation --}}
    <nav class="tab-menu">
        <button class="tab-button active" id="tab-materi">Materi</button>
        <button class="tab-button" id="tab-project">Project</button>
        <button class="tab-button" id="tab-kelas">Kelas Kamu</button>
    </nav>

    {{-- Materi Section --}}
    <section id="section-materi" class="materi-section">
        <div class="materi-subtitle">Daftar Materi {{ $kelasAktif ? $kelasAktif->nama_kelas : '' }}</div>

        <div class="search-box">
            <input type="search" placeholder="Cari Materi" id="search-materi" />
        </div>

        <div class="materi-list" id="materi-list">
            @forelse($materi as $item)
            <div class="materi-item">
                <a href="{{ route('instruktur.materi.show', $item->id) }}" class="materi-link">
                    <span>{{ $item->judul }}</span>
                    <i class="fas fa-chevron-down"></i>
                </a>
            </div>
            @empty
            <p class="no-materi">Belum ada materi untuk kelas ini.</p>
            @endforelse
        </div>
    </section>

    {{-- Placeholder for Project and Kelas Sections (optional) --}}
    <section id="section-project" class="d-none">
        <p>Fitur Project belum tersedia.</p>
    </section>

    <section id="section-kelas" class="d-none">
        <p>Fitur Kelas Kamu belum tersedia.</p>
    </section>

</div>

{{-- Optional JavaScript for Tab Switching --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabs = document.querySelectorAll('.tab-button');
        const sections = {
            'tab-materi': document.getElementById('section-materi'),
            'tab-project': document.getElementById('section-project'),
            'tab-kelas': document.getElementById('section-kelas')
        };

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                Object.values(sections).forEach(s => s.classList.add('d-none'));
                sections[tab.id].classList.remove('d-none');
            });
        });
    });
</script>
@endsection
