@extends('layouts.student')

@section('title', 'Dashboard Student')

@section('content')
<div class="dashboard-container">
    <!-- ===================== HEADER ===================== -->
    <div class="px-4 py-3">
        <h2 class="fw-bold mb-1" style="color:#FFFA8D; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
            Halo Selamat Datang,
        </h2>
        <h3 style="color: rgb(255, 251, 251); text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
            {{ auth()->guard('student')->user()->name ?? 'Student' }}
        </h3>
    </div>

    <!-- ===================== CURRENT CLASS (KURSUS AKTIF) ===================== -->
    <div id="current-course" class="current-class-card px-4 mt-3 mb-4 p-0">
        <h4 class="class-title ps-0 pt-3">Kelas kamu saat ini</h4>

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
                    <p class="course-description">{{ $selectedCourse->deskripsi }}</p>
                </div>
            </div>
        @else
            <div class="no-course px-0 pb-3">
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
    <div id="materi" class="tab-content px-4" style="display: block; margin-bottom: 30px;">
        <h4 style="color: #FFA017;">Materi dari Kursus: {{ $selectedCourse->nama_course ?? '-' }}</h4>

        @if ($materi->isEmpty())
            <div class="alert alert-warning">Belum ada materi tersedia.</div>
        @else
            <div class="row g-3">
                @foreach ($materi as $item)
                    <div class="col-md-4">
                        <a href="{{ route('student.materi.index', $item->id) }}" style="text-decoration: none;">
                            <div 
                              class="materi-card p-3 rounded" 
                              style="background-color: #FCFBD3; cursor: pointer;"
                            >
                                <h5 class="mb-2" style="font-weight: 600; color: #333;">{{ $item->judul }}</h5>
                                <p class="text-truncate mb-0" style="color: #555;">{{ Str::limit($item->deskripsi, 60) }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <!-- ===================== END TAB Materi ===================== -->

    <!-- ===================== TAB Project ===================== -->
    <div id="project" class="tab-content px-4" style="display: none; margin-bottom: 30px;">
        <h4 style="color: #FFA017;">Project dari Kursus: {{ $selectedCourse->nama_course ?? '-' }}</h4>

        @if ($projects->isEmpty())
            <div class="alert alert-warning">Belum ada project tersedia.</div>
        @else
            <div class="row g-3">
                @foreach ($projects as $project)
                    @php
                        $submission = \App\Models\Submission::where('project_id', $project->id)
                                          ->where('student_id', auth()->guard('student')->id())
                                          ->first();
                    @endphp
                    <div class="col-md-6">
                        <div 
                          class="project-card-container p-3 rounded" 
                          style="background-color: #FCFBD3; cursor: pointer;"
                          data-id="{{ $project->id }}"
                          data-judul="{{ $project->judul }}"
                          data-deskripsi="{{ htmlspecialchars($project->deskripsi, ENT_QUOTES, 'UTF-8') }}"
                          data-deadline="{{ $project->deadline ? \Carbon\Carbon::parse($project->deadline)->format('d F Y') : '' }}"
                          data-waktu="{{ $project->waktu ?? '' }}"
                          data-submitted="{{ $submission ? '1' : '0' }}"
                          @if($submission)
                            data-sub-file="{{ $submission->file_path ? asset('storage/' . $submission->file_path) : '' }}"
                            data-sub-link="{{ $submission->submission_link ?? '' }}"
                            data-sub-date="{{ $submission->submitted_at->format('d F Y, H:i') }}"
                          @else
                            data-sub-file=""
                            data-sub-link=""
                            data-sub-date=""
                          @endif
                          data-course-id="{{ $selectedCourse->id }}"
                        >
                            <h5 class="mb-2" style="font-weight: 600; color: #333;">{{ $project->judul }}</h5>
                            <p class="text-truncate mb-1" style="color: #555;">
                                {{ Str::limit($project->deskripsi, 60) }}
                            </p>
                            @if ($project->deadline)
                                <small style="color: #666;">
                                    Deadline: {{ \Carbon\Carbon::parse($project->deadline)->format('d-m-Y') }}
                                    @if($project->waktu), {{ $project->waktu }} @endif
                                </small>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <!-- ===================== END TAB Project ===================== -->

    <!-- ===================== TAB “Kursus Kamu” ===================== -->
    <div id="kelas-kamu" class="tab-content px-4" style="display: none; margin-top: 15px; margin-bottom: 30px;">
        <h4 style="color: #FFA017;">Semua Kursus Kamu</h4>
        <div class="row g-3">
            @foreach ($enrolledCourses as $course)
                <div class="col-md-6">
                    <a 
                      href="{{ route('student.dashboard') }}?course_id={{ $course->id }}" 
                      style="text-decoration: none;"
                    >
                        <div 
                          class="class-card p-3 rounded" 
                          style="background-color: #FF8C00; cursor: pointer;"
                        >
                            <div class="row align-items-center g-0">
                                <div class="col-4">
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
                                <div class="col-8 ps-3">
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

<!-- ===================== STYLE MODAL & DASHBOARD ===================== -->
<style>
    /* ---------- Latar & Gap Dasar ---------- */
    .dashboard-container {
        background-color: #4CCFF9;
        min-height: 100vh;
        padding-bottom: 40px;
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
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .tab.active, .tab:hover {
        background-color: #FF8C00;
    }
    .tab-content {
        margin-bottom: 30px;
    }

    /* ---------- CURRENT COURSE CARD ---------- */
    .current-class-card {
        width: 100%;
        margin-bottom: 20px;
    }
    .current-card {
        background-color: #FFB347 !important;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .class-image-wrapper {
        width: 100%;
        height: 200px;
        overflow: hidden;
    }
    .class-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .class-details {
        padding: 15px 20px;
        color: white;
    }
    .course-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 5px;
    }
    .course-description {
        font-size: 1rem;
        line-height: 1.4;
    }

    /* ---------- KARTU MATERI ---------- */
    .materi-card {
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        border-radius: 8px;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .materi-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .materi-card h5 {
        font-size: 1.1rem;
        color: #333;
    }
    .materi-card p {
        font-size: 0.9rem;
        color: #555;
    }

    /* ---------- MODAL OVERLAY (Project) ---------- */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.6);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        padding: 15px;
    }
    .modal-content {
        background: white;
        max-width: 600px;
        width: 100%;
        padding: 20px 25px;
        position: relative;
    }
    .modal-content.project-modal {
        max-width: 700px;
    }
    .modal-close {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 1.5rem;
        color: #444;
        cursor: pointer;
    }

    /* ---------- PROJECT CARD ---------- */
    .project-card-container {
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        border-radius: 8px;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .project-card-container:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .project-card-container h5 {
        font-size: 1.15rem;
        color: #333;
        margin-bottom: 5px;
    }
    .project-card-container p {
        font-size: 0.9rem;
        color: #555;
    }

    /* ---------- TAB KELAS KAMU ---------- */
    .class-card {
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .class-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
    .class-thumb img {
        width: 100%;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
    }
    .class-info h5 {
        font-size: 1.1rem;
        color: white;
    }
    .class-info p {
        color: white;
        margin-bottom: 4px;
    }

    /* ---------- FORM & DETAIL DALAM MODAL PROJECT ---------- */
    .project-form, .project-detail {
        margin-top: 15px;
    }
    .project-form label {
        font-size: 0.9rem;
        font-weight: 600;
        color: #333;
    }
    .project-form input {
        font-size: 0.9rem;
    }
    .project-form .btn-primary {
        margin-top: 8px;
        font-size: 0.9rem;
        padding: 6px 12px;
    }
    .project-detail a {
        color: #FFA017;
        font-weight: 600;
        text-decoration: none;
    }
    .project-detail a:hover {
        text-decoration: underline;
    }
</style>

<!-- ===================== SCRIPT SWITCH TAB & MODAL PROJECT ===================== -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1) SWITCH TAB
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

        // 2) MODAL PROJECT: buka + isi konten
        const projectCards = document.querySelectorAll('.project-card-container');
        const projectModal = document.getElementById('project-modal');
        const closeProject = projectModal.querySelector('.modal-close');
        const pjJudul = document.getElementById('modal-project-judul');
        const pjDeskripsi = document.getElementById('modal-project-deskripsi');
        const pjDeadline = document.getElementById('modal-project-deadline');
        const pjBody = document.getElementById('modal-project-body');

        projectCards.forEach(card => {
            card.addEventListener('click', function() {
                const id        = this.getAttribute('data-id');
                const judul     = this.getAttribute('data-judul');
                const deskripsi = this.getAttribute('data-deskripsi');
                const deadline  = this.getAttribute('data-deadline');
                const waktu     = this.getAttribute('data-waktu');
                const submitted = this.getAttribute('data-submitted') === '1';
                const subFile   = this.getAttribute('data-sub-file');
                const subLink   = this.getAttribute('data-sub-link');
                const subDate   = this.getAttribute('data-sub-date');
                const courseId  = this.getAttribute('data-course-id');

                pjJudul.textContent = judul;
                pjDeskripsi.textContent = deskripsi;

                if (deadline) {
                    pjDeadline.textContent = `Deadline: ${deadline}${waktu ? ', ' + waktu : ''}`;   
                } else {
                    pjDeadline.textContent = '';
                }

                // Jika sudah submit:
                if (submitted) {
                    pjBody.innerHTML = `
                        <div class="project-detail">
                            <p><strong>Status:</strong> <span style="color: #28A745;">Dikirim (${subDate})</span></p>
                            ${ subFile ? `<p>File: <a href="${subFile}" target="_blank">Unduh File</a></p>` : '' }
                            ${ subLink ? `<p>Link: <a href="${subLink}" target="_blank">${subLink}</a></p>` : '' }
                        </div>
                    `;
                } else {
                    // Form submission jika belum submit
                    pjBody.innerHTML = `
                        <form action="${window.location.origin}/student/project/${id}/submit" method="POST" enctype="multipart/form-data" class="project-form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="course_id" value="${courseId}">
                            <div class="mb-2">
                                <label for="submission_file_${id}" class="form-label">Upload File (PDF/ZIP/PNG)</label>
                                <input type="file" name="submission_file" id="submission_file_${id}" class="form-control form-control-sm" accept=".pdf,.zip,.png,.jpg,.jpeg" required>
                            </div>
                            <div class="mb-2">
                                <label for="submission_link_${id}" class="form-label">Atau Link (GitHub/Google Drive)</label>
                                <input type="url" name="submission_link" id="submission_link_${id}" class="form-control form-control-sm" placeholder="https://github.com/username/repo">
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary">Kirim Submission</button>
                        </form>
                    `;
                }

                projectModal.style.display = 'flex';
            });
        });
        closeProject.addEventListener('click', () => {
            projectModal.style.display = 'none';
        });
        projectModal.addEventListener('click', e => {
            if (e.target === projectModal) {
                projectModal.style.display = 'none';
            }
        });
    });
</script>
@endsection
