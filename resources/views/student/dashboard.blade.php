@extends('layouts.student')

@section('title', 'Dashboard Student')

@section('content')
<div class="dashboard-container">
    <!-- ===================== HEADER ===================== -->
        <h2 class="fw-bold mb-3" style="color:#FFFA8D; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">Halo Selamat Datang,</h2>
        <h3 style="color: rgb(255, 251, 251); text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">{{ auth()->guard('student')->user()->name ?? 'Student' }}</h3>

    <!-- ===================== CURRENT CLASS (KURSUS AKTIF) ===================== -->
    <div id="current-course" class="current-class-card container mt-3 mb-4 p-0">
    <h4 class="class-title ps-4 pt-3">Kelas kamu saat ini</h4>

    @if ($selectedCourse)
        <div class="class-content current-card">
            <div class="class-image-wrapper">
                <img 
                  src="{{ 
                      $selectedCourse->banner_image 
                          ? asset('storage/' . $selectedCourse->banner_image) 
                          : asset('image/default-course.png') 
                  }}"
                  alt="{{ $selectedCourse->nama_course }}" 
                  class="class-image"
                >
            </div>
            <div class="class-details">
                <h3 class="course-title">{{ $selectedCourse->nama_course }}</h3>
                <p class="course-instructor">
                    Instruktur: <strong>{{ $selectedCourse->instruktur->name ?? '-' }}</strong>
                </p>
                <p class="course-description">{{ $selectedCourse->deskripsi }}</p>
                <a 
                  href="{{ route('student.courses.detail', $selectedCourse->id) }}" 
                  class="btn btn-light btn-sm mt-2"
                >
                    Lihat Detail Kelas
                </a>
            </div>
        </div>
    @else
        <div class="no-course px-4 pb-3">
            <p>Belum ada kursus aktif.</p>
        </div>
    @endif
    </div>


    <!-- ===================== NAVIGATION TABS ===================== -->
    <div class="navigation-tabs px-4 mb-4">
        <button class="tab tab-button active" data-tab="materi">Materi</button>
        <button class="tab tab-button" data-tab="project">Project</button>
        <button class="tab tab-button" data-tab="kelas-kamu">Kursus Kamu</button>
    </div>

    <!-- ===================== TAB Materi ===================== -->
    <div id="materi" class="tab-content px-4" style="display: block; margin-top: 15px;">
        <h4 style="color: #FFA017;">
            Materi dari Kursus: {{ $selectedCourse->nama_course ?? '-' }}
        </h4>

        @if ($materi->isEmpty())
            <div class="alert alert-warning">Belum ada materi tersedia.</div>
        @else
            @foreach ($materi as $item)
                <div class="d-flex justify-content-between align-items-center mb-3" style="background-color: #fffdeb; padding: 12px 18px; border-radius: 12px; border-left: 5px solid orange; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                    <div>
                        <div style="font-weight: 600;">{{ $item->judul }}</div>
                        <small>{{ $item->deskripsi }}</small>
                    </div>
                    <a href="{{ route('student.materi.show', $item->id) }}" class="btn btn-sm" style="background-color: orange; color: white; border-radius: 50%;">
                        <i class="fas fa-eye"></i>
                    </a>
                </div>

            @endforeach
        @endif
    </div>

    <!-- ===================== TAB Project ===================== -->
    <div id="project" class="tab-content px-4" style="display: none; margin-top: 15px;">
        <h5 class="mt-4 text-white">Project dari Kursus: {{ $selectedCourse->nama_course }}</h5>

        @if ($projects->isEmpty())
            <div class="alert alert-warning">Belum ada project tersedia.</div>
        @else
            @foreach ($projects as $project)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $project->judul }}</h5>
                        <p class="card-text">{{ $project->deskripsi }}</p>
                        <a href="{{ route('student.project.show', $project->id) }}" class="btn btn-sm btn-primary mt-2">Lihat</a>
                    </div>
                </div>
            @endforeach
        @endif

    </div>

    <!-- ===================== TAB “Kursus Kamu” ===================== -->
    <div id="kelas-kamu" class="tab-content px-4" style="display: none; margin-top: 15px;">
        <h4>Semua Kursus Kamu</h4>
        <div class="row">
            @foreach ($enrolledCourses as $course)
                <div class="col-md-6 mb-3">
                    {{-- 
                      Bungkus seluruh kartu dengan <a> yang mengarah ke route student.dashboard 
                      dengan query parameter ?course_id=…
                    --}}
                    <a 
                      href="{{ route('student.dashboard') }}?course_id={{ $course->id }}" 
                      style="text-decoration: none;"
                    >
                        <div 
                          class="class-card p-3" 
                          style="background-color: #FF8C00; border-radius: 10px; cursor: pointer;"
                        >
                            <div class="row align-items-center no-gutters">
                                <div class="col-4 class-thumb">
                                    <img 
                                      src="{{ 
                                          $course->banner_image 
                                            ? asset('storage/' . $course->banner_image) 
                                            : asset('image/default-course.png') 
                                      }}" 
                                      alt="{{ $course->nama_course }}" 
                                      style="width:100%; height:100px; object-fit:cover; border-radius: 8px;"
                                    >
                                </div>
                                <div class="col-8 class-info ps-3">
                                    <h5 class="mb-1" style="color:white; font-size:1.1rem;">
                                        {{ $course->nama_course }}
                                    </h5>
                                    <p class="mb-1 small" style="color:white;">
                                        Instruktur: <strong>{{ $course->instruktur->name ?? '-' }}</strong>
                                    </p>
                                    <p class="mb-1 small" style="color:white;">
                                        {{ Str::limit($course->deskripsi, 60) }}
                                    </p>
                                    <span class="btn btn-light btn-sm" style="pointer-events: none;">
                                        Lihat Detail
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- ===================== STYLE (agar tampilan sama seperti sebelumnya) ===================== -->
<style>
    /* ========== GAYA UMUM ========== */
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
        border: none;
    }
    .tab.active,
    .tab:hover {
        background-color: #FF8C00;
    }

    /* ========== CURRENT COURSE CARD ========== */
    .current-card {
        background-color: #FFB347 !important;
        border-radius: 10px;
        padding: 15px !important;
    }
    .current-card .class-image img {
        width: 100%;
        border-radius: 10px;
    }
    .current-card .class-image {
        width: 35%;
    }
    .current-card .class-details {
        width: 65%;
        color: white;
    }
    .current-card .course-title {
        font-weight: 600;
        margin-bottom: 5px;
    }
    .current-card .course-description {
        font-size: 0.9rem;
    }

    /* ========== KURSUS KAMU CARD ========== */
    .class-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .class-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    .class-thumb img {
        width: 100%;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
    }
    .class-info h5,
    .class-info p {
        color: white;
        margin-bottom: 4px;
    }

    /* ========== PROJECT CARD ========== */
    .project-card {
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    /* ========== GAP DI BAWAH KONTAINER TAB ========== */
    .tab-content {
        margin-bottom: 30px;
    }
</style>

<!-- ===================== SCRIPT SWITCH TAB SEDERHANA ===================== -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.tab-button').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.tab-button').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                const tabId = this.getAttribute('data-tab');
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.style.display = (content.id === tabId) ? 'block' : 'none';
                });
            });
        });
    });
</script>
@endsection
