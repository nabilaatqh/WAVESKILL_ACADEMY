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

        @if($courseAktif)
        <div class="course-card">
            @if($courseAktif->banner)
            <img src="{{ asset('storage/' . $courseAktif->banner) }}" alt="Banner Course" class="course-banner" />
            @endif
            <h4>{{ $courseAktif->nama_course }}</h4>
            <p>{{ $courseAktif->deskripsi }}</p>
        </div>
        @else
        <p class="no-course">Belum ada course yang diassign.</p>
        @endif
    </div>

    {{-- Tab Navigation --}}
    <nav class="tab-menu">
        <button class="tab-button active" id="tab-materi">Materi</button>
        <button class="tab-button" id="tab-project">Project</button>
        <button class="tab-button" id="tab-course">Course Kamu</button>
    </nav>

    {{-- Materi Section --}}
    <section id="section-materi" class="materi-section">
        <div class="materi-subtitle">Daftar Materi {{ $courseAktif ? $courseAktif->nama_course : '' }}</div>

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
            <p class="no-materi">Belum ada materi untuk course ini.</p>
            @endforelse
        </div>
    </section>

    {{-- Placeholder for Project and course Sections (optional) --}}
    <section id="section-project" class="d-none">
        <p>Fitur Project belum tersedia.</p>
    </section>

    <section id="section-course" class="d-none">
        <p>Fitur Course Kamu belum tersedia.</p>
    </section>

</div>

{{-- Optional JavaScript for Tab Switching --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabs = document.querySelectorAll('.tab-button');
        const sections = {
            'tab-materi': document.getElementById('section-materi'),
            'tab-project': document.getElementById('section-project'),
            'tab-course': document.getElementById('section-course')
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
