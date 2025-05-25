@extends('layouts.student')

@section('title', 'Dashboard Student')

@section('content')
<div class="dashboard-container">
    <!-- Header Section -->
    <div class="welcome-header">
        <h2 class="welcome-text">Halo Selamat Datang,</h2>
        <h3 class="user-name">{{ auth()->guard('student')->user()->name ?? 'Student' }}</h3>
    </div>

    <!-- Current Class Section -->
    <div class="current-class-card">
        <h4 class="class-title">Kelas kamu saat ini</h4>

        @if($enrolledCourses->isEmpty())
            <div class="class-content mb-3" style="background-color: #FFEB99; border-radius: 10px; padding: 20px; color: #555;">
                <p>Belum ada kelas tersedia.</p>
            </div>
        @else
            @foreach($enrolledCourses as $course)
                <div class="class-content mb-3" style="background-color: #FFB347; border-radius: 10px; padding: 15px; display: flex; gap: 15px; align-items: center;">
                    <div class="class-image" style="width: 35%;">
                        @if($course->image)
                            <img src="{{ asset('images/' . $course->image) }}" alt="{{ $course->title }}" style="width: 100%; border-radius: 10px;">
                        @else
                            <img src="{{ asset('images/default-course.png') }}" alt="Default Course Image" style="width: 100%; border-radius: 10px;">
                        @endif
                    </div>

                    <div class="class-details" style="width: 65%; color: white;">
                        <h3 class="course-title" style="font-weight: 600;">{{ $course->title }}</h3>
                        <p class="course-description" style="font-size: 0.9rem;">
                            {{ Str::limit($course->description, 150) }}
                        </p>
                        <a href="{{ route('student.courses.show', $course->id) }}" class="btn btn-light btn-sm mt-2">Lihat Detail Kelas</a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Navigation Tabs -->
    <div class="navigation-tabs" style="margin-top: 20px;">
        <button class="tab tab-button active" data-tab="materi">Materi</button>
        <button class="tab tab-button" data-tab="project">Project</button>
        <button class="tab tab-button" data-tab="kelas-kamu">Kelas Kamu</button>
    </div>

    <!-- Tab Contents -->
    <div id="materi" class="tab-content" style="display: block; margin-top: 15px;">
        <h4 style="color: #FFA017;">Daftar Materi Figma UI/UX Design</h4>
        <input type="text" id="search-materi" placeholder="Cari Materi" style="padding: 10px; width: 100%; border-radius: 8px; border: 1px solid #ddd; margin-bottom: 15px;">

        <div class="materi-list" style="background: #FFF9C4; border-radius: 10px; padding: 10px;">
            <div style="padding: 10px; margin-bottom: 10px; background: #FFF59D; border-radius: 8px; cursor: pointer;">
                <span>Class Preparation</span>
                <span style="float: right;">&#x25BC;</span>
            </div>
            <div style="padding: 10px; margin-bottom: 10px; background: #FFF59D; border-radius: 8px; cursor: pointer;">
                <span>Fundamental UI/UX Design</span>
                <span style="float: right;">&#x25BC;</span>
            </div>
            <div style="padding: 10px; margin-bottom: 10px; background: #FFF59D; border-radius: 8px; cursor: pointer;">
                <span>Advanced UI/UX Design</span>
                <span style="float: right;">&#x25BC;</span>
            </div>
            <div style="padding: 10px; background: #FFF59D; border-radius: 8px; cursor: pointer;">
                <span>Extra Class for UI/UX Design</span>
                <span style="float: right;">&#x25BC;</span>
            </div>
        </div>
    </div>

    <div id="project" class="tab-content" style="display: none; margin-top: 15px; color: white;">
        <h4>Portfolio Project</h4>
        <div class="project-portfolio" style="display: flex; gap: 10px; margin-bottom: 20px;">
            <img src="{{ asset('images/project1.png') }}" alt="Project 1" style="height: 100px; border-radius: 8px;">
            <img src="{{ asset('images/project2.png') }}" alt="Project 2" style="height: 100px; border-radius: 8px;">
            <img src="{{ asset('images/project3.png') }}" alt="Project 3" style="height: 100px; border-radius: 8px;">
            <img src="{{ asset('images/project4.png') }}" alt="Project 4" style="height: 100px; border-radius: 8px;">
        </div>
        <div class="project-list">
            @for ($i = 1; $i <= 5; $i++)
            <div style="background: white; border-radius: 10px; padding: 15px; margin-bottom: 15px; color: black; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h5>Project {{ $i }} : Dasar UI/UX</h5>
                    <p>Deadline: 2 Mei 2025</p>
                </div>
                <div>
                    <button class="btn btn-success btn-sm" style="margin-right: 10px;">Selesai</button>
                    <button class="btn btn-danger btn-sm">Unsubmit</button>
                </div>
            </div>
            @endfor
        </div>
    </div>

    <div id="kelas-kamu" class="tab-content" style="display: none; margin-top: 15px; color: white;">
        <h4>Daftar Kelas Yang Ada</h4>
        <div class="class-card" style="background-color: #FF8C00; border-radius: 10px; padding: 15px;">
            <img src="{{ asset('images/figma-ui-ux-illustration.png') }}" alt="Figma UI/UX Design" style="width: 100%; border-radius: 8px; margin-bottom: 10px;">
            <h5 style="color: white;">Figma UI/UX Design</h5>
            <p style="color: white;">Kursus ini dirancang khusus untuk pemula yang ingin mempelajari dasar-dasar desain UI/UX menggunakan Figma. Kamu akan belajar bagaimana merancang tampilan aplikasi/web dari nol, memahami prinsip desain, hingga membuat prototipe interaktif.</p>
        </div>
    </div>
</div>

<style>
    .welcome-header {
        margin-bottom: 25px;
    }
    .welcome-text {
        font-size: 1.6rem;
        font-weight: 600;
        color: white;
    }
    .user-name {
        font-size: 1.3rem;
        font-weight: 700;
        color: white;
        margin-top: 5px;
    }
    .navigation-tabs {
        display: flex;
        gap: 20px;
    }
    .tab {
        background-color: #FFB347;
        padding: 8px 16px;
        border-radius: 25px;
        color: white;
        text-decoration: none;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }
    .tab.active,
    .tab:hover {
        background-color: #FF8C00;
    }
</style>

<script>
    document.querySelectorAll('.tab-button').forEach(button => {
        button.addEventListener('click', () => {
            const tab = button.dataset.tab;

            // Sembunyikan semua konten tab
            document.querySelectorAll('.tab-content').forEach(tc => tc.style.display = 'none');

            // Nonaktifkan semua tombol tab
            document.querySelectorAll('.tab-button').forEach(tb => tb.classList.remove('active'));

            // Tampilkan konten yang sesuai dengan tab yang dipilih
            document.getElementById(tab).style.display = 'block';

            // Tandai tombol yang aktif
            button.classList.add('active');
        });
    });

    // Script filter pencarian materi bisa ditambahkan nanti
    document.getElementById('search-materi').addEventListener('input', function() {
        console.log('Mencari:', this.value);
    });
</script>
@endsection
