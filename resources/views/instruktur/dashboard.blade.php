@extends('layouts.instruktur')

@section('title', 'Dashboard Instruktur')

@section('content')
<div class="dashboard-wrapper container-center">
    {{-- Welcome Section --}}
    <div class="welcome-section">
        <h3>
            Halo Selamat Datang,<br>
            instruktur, <span class="highlight">{{ Auth::user()->name }}</span>
        </h3>

        @if($selectedCourse)
        <div class="course-card">
            @if($selectedCourse->banner)
            <img src="{{ asset('storage/' . $selectedCourse->banner) }}" alt="Banner Course" class="course-banner" />
            @endif
            <h4>{{ $selectedCourse->nama_course }}</h4>
            <p>{{ $selectedCourse->deskripsi }}</p>
        </div>
        @else
        <p class="no-course">Belum ada course yang ditambahkan.</p>
        @endif
    </div>

    {{-- Tab Navigation --}}
    <nav class="tab-menu">
        <button class="tab-button active" id="tab-materi">Materi</button>
        <button class="tab-button" id="tab-project">Project</button>
        <button class="tab-button" id="tab-course">Course Kamu</button>
    </nav>

    {{-- Materi Section --}}
    <section id="section-materi">
        @if($selectedCourse)
        <div class="materi-subtitle">Daftar Materi {{ $selectedCourse->nama_course }}</div>
        <div class="search-box">
            <input type="search" placeholder="Cari Materi" id="search-materi" />
        </div>
        <div class="materi-list">
            @forelse($materi as $item)
            <div class="materi-item">
                <div class="materi-icon">📘</div>
                <div class="materi-content">
                    <strong>{{ $item->judul }}</strong>
                    <p>{{ $item->deskripsi }}</p>
                </div>
                <div class="materi-action">
                    <a href="{{ route('instruktur.materi.show', $item->id) }}" class="btn btn-warning">Lihat Materi</a>
                </div>
            </div>
            @empty
            <p class="no-materi">Belum ada materi untuk course ini.</p>
            @endforelse
        </div>
        @else
        <p class="no-materi">Belum ada course yang aktif.</p>
        @endif
    </section>

    {{-- Project Section --}}
    <section id="section-project" class="d-none">
        @if($selectedCourse)
        <div class="materi-subtitle">Daftar Project {{ $selectedCourse->nama_course }}</div>
        <div class="materi-list">
            @forelse($projects as $item)
            <div class="materi-item">
                <div class="materi-icon">📁</div>
                <div class="materi-content">
                    <strong>{{ $item->judul }}</strong>
                    <p>{{ $item->deskripsi }}</p>
                </div>
                <div class="materi-action">
                    <a href="#" class="btn btn-danger">Lihat Submission</a>
                </div>
            </div>
            @empty
            <p class="no-materi">Belum ada project untuk course ini.</p>
            @endforelse
        </div>
        @else
        <p class="no-materi">Belum ada course yang aktif.</p>
        @endif
    </section>

    {{-- Course Section --}}
<section id="section-course" class="d-none">
    <div class="materi-subtitle">Daftar Course yang Diajarkan</div>
    <div class="course-list">
        @forelse($courses as $course)
        <div class="kelas-horizontal-card">
            <div class="card-image">
                @if($course->banner)
                <img src="{{ asset('storage/' . $course->banner) }}" alt="Course Banner">
                @else
                <img src="https://via.placeholder.com/150x100?text=Course" alt="Default Banner">
                @endif
            </div>
            <div class="card-content">
                <h5>{{ $course->nama_course }}</h5>
                <p>{{ $course->deskripsi }}</p>
                <a href="{{ route('instruktur.dashboard', ['course_id' => $course->id]) }}" class="btn-lihat">Lihat materi →</a>
            </div>
        </div>
        @empty
        <p class="no-course">Belum ada course untuk ditampilkan.</p>
        @endforelse
    </div>
</section>

</div>

{{-- JavaScript for Tab Switching --}}
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
                // aktifkan tab
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                // tampilkan hanya 1 section
                Object.values(sections).forEach(s => s.classList.remove('active'));
                sections[tab.id].classList.add('active');
            });
        });

        // Set default aktif ke "materi"
        document.getElementById('section-materi').classList.add('active');
    });
</script>

@endsection