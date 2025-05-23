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
            <img src="{{ asset('storage/' . $course->banner) }}" alt="Course Banner">
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

    {{-- Form Tambah Materi --}}
    <form action="{{ route('instruktur.materi.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <input type="hidden" name="course_id" value="{{ $selectedCourse->id }}">

        <input type="text" name="judul" class="form-control mb-2" placeholder="Judul Materi" required>
        <textarea name="deskripsi" class="form-control mb-2" placeholder="Deskripsi Materi" rows="2"></textarea>
        <input type="file" name="file" class="form-control mb-2" accept="application/pdf" required>

        <input type="hidden" name="tipe" value="pdf">

        <button type="submit" class="btn btn-success">Tambah Materi</button>
    </form>

    {{-- Search Box --}}
    <div class="search-box mb-3">
        <input type="search" placeholder="Cari Materi" id="search-materi" class="form-control" />
    </div>

    {{-- List Materi --}}
    <div class="materi-list">
        @forelse($materi as $item)
        <div class="materi-item d-flex justify-content-between align-items-start mb-3 p-3 border rounded">
            <div class="materi-content">
                <strong>{{ $item->judul }}</strong>
                <p>{{ $item->deskripsi }}</p>

                @if($item->file)
                    <a href="{{ asset('storage/' . $item->file) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                        📄 Lihat PDF
                    </a>
                @endif
            </div>
            <div class="materi-action d-flex flex-column gap-2">
                <a href="{{ route('instruktur.materi.show', $item->id) }}" class="btn btn-warning btn-sm">Detail</a>
                <form action="{{ route('instruktur.materi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus materi ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
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