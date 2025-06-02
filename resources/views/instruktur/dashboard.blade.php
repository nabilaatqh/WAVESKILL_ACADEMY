@extends('layouts.instruktur')

@section('title', 'Dashboard Instruktur')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

@section('content')
<div class="dashboard-wrapper container-center" style="max-width: 1100px; margin: 0 auto;">

    <div class="welcome-text text-center mb-4">
        <h1 style="font-size: 32px; font-weight: 700; line-height: 1.2; color: #008080;">Halo Selamat Datang,</h1>
        <h1 style="font-size: 32px; font-weight: 700; line-height: 1.2; color: white;">Instruktur, {{ Auth::user()->name }}</h1>
    </div>

    @if($selectedCourse)
    <div class="course-card mb-4" style="background: #ffa500; padding: 20px; border-radius: 16px; color: white; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
        <div style="font-size: 24px; font-weight: bold; margin-bottom: 12px;">Kelas yang diajar saat ini</div>
        @if($selectedCourse->banner_image)
            <img src="{{ asset('storage/' . $selectedCourse->banner_image) }}" alt="Course Banner" style="width: 100%; max-height: 320px; object-fit: cover; border-radius: 12px; margin-bottom: 12px;">
        @endif
        <h2 style="font-size: 24px; font-weight: bold;">{{ $selectedCourse->nama_course }}</h2>
        <p style="font-size: 20px;">{{ $selectedCourse->deskripsi }}</p>
    </div>

    <nav class="tab-menu d-flex justify-content-center mb-4" style="gap: 12px;">
        <button class="tab-button active" id="tab-materi">Materi</button>
        <button class="tab-button" id="tab-project">Project</button>
        <button class="tab-button" id="tab-course">Course Kamu</button>
    </nav>

    <section id="section-materi">
        <div class="text-center mb-3"style="margin-bottom: 20px;">
            <span style="font-weight: bold; font-size: 25px; color: orange;">Daftar Materi {{ $selectedCourse->nama_course }}</span>
            <button class="btn-orange" onclick="toggleMateriForm()">
    <span>+ create</span>
        </div>
        

        <div class="row justify-content-center">
            <div class="col-md-4">
                <div id="materi-form" style="display: none;" class="card p-4 mb-4 border-0 shadow" >
                    
                    <form action="{{ route('instruktur.materi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $selectedCourse->id }}">
                        <div class="form-group" style="margin-bottom: 20px;">
                        <label>Judul Materi <span style="color: red;">*</span></label>
                        <input type="text" name="judul" class="form-control mb-2" placeholder="Judul Materi" required>
                         </div>
                         
                        <div class="form-group" style="margin-bottom: 20px;">
                        <label>Deskripsi Materi <span style="color: red;">*</span></label>
                        <textarea name="deskripsi" class="form-control mb-2" placeholder="Deskripsi Materi" rows="3"></textarea>
                         </div>

                        <div class="form-group" style="margin-bottom: 20px;">
                        <label>Tipe <span style="color: red;">*</span></label>
                        <select name="tipe" class="form-control mb-2" style="margin-bottom: 20px;"> required>
                            <option value="pdf">PDF</option>
                            <option value="video">Video</option>
                            <option value="link">Link</option>
                        </select>
                        <label>Upload File <span style="color: red;">*</span></label>
                        <input type="file" name="file" class="form-control mb-2" style="margin-bottom: 20px;" accept=".pdf,.mp4,.">
                        <button type="submit" class="button w-100 fw-bold">
                            <i class="fas fa-save me-2"></i> Simpan Materi
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <form method="GET" action="{{ route('instruktur.dashboard') }}" class="mb-3 d-flex justify-content-center align-items-center" style="gap: 10px; margin-bottom: 20px;">
                    <input type="hidden" name="course_id" value="{{ $selectedCourse->id }}">
                    <input type="hidden" name="active_tab" value="materi">
                    <input type="search" name="search_materi" value="{{ request('search_materi') }}" placeholder="Cari Materi" class="form-control" style="width: 100%; max-width: 500px;" />
                    <button type="submit" class="btn-orange">
  <span>Cari</span>
</button>

                </form>

                @forelse($materi as $item)
                    <div class="materi-item d-flex justify-content-between align-items-start mb-3 p-3 border rounded">
                        <div class="materi-content">
                            <strong>{{ $item->judul }}</strong>
                            <p>{{ $item->deskripsi }}</p>
                        </div>
                        <div class="materi-action d-flex flex-column gap-2">
                            <a href="{{ route('instruktur.materi.show', $item->id) }}" class="detail-btn" title="Detail Materi" aria-label="Detail Materi">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-white">Belum ada materi untuk course ini.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section id="section-project" class="d-none" style="margin-top: -5px;">
        <div class="text-center mb-3" style="max-width: 1100px; margin: 0 auto; margin-bottom: 20px;">
            <span style="font-weight: bold; font-size: 25px; color: orange;">Daftar Project {{ $selectedCourse->nama_course }}</span>
        <button class="btn-orange" onclick="toggleProjectForm()">
    <span>+ create</span>
        </div>

        <div class="row justify-content-center" style="max-width: 1100px; margin: 0 auto;">
            <div class="col-md-4">
                  <div id="project-form" style="display: none;" class="card p-4 mb-4 border-0 shadow" >
                    <form action="{{ route('instruktur.project.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $selectedCourse->id }}">
                        
                        <div class="form-group" style="margin-bottom: 20px;">
                            <label>Judul Project</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>

                        <div class="form-group" style="margin-bottom: 20px;">
                            <label>Deskripsi Project</label>
                            <textarea name="deskripsi" class="form-control"></textarea>
                        </div>

                        <div class="form-group" style="margin-bottom: 20px;">
                            <label>Tipe</label>
                            <select name="tipe" class="form-control" required>
                                <option value="pdf">PDF</option>
                                <option value="video">Video</option>
                                <option value="link">Link</option>
                            </select>
                        </div>

                        <div class="form-group" style="margin-bottom: 20px;">
                            <label>Upload File</label>
                            <input type="file" name="file" class="form-control" accept=".pdf,.mp4">
                        </div>

                         <button type="submit" class="button w-100 fw-bold" style="margin-bottom: 20px;">
                            <i class="fas fa-save me-2"></i> Simpan Project
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <form method="GET" action="{{ route('instruktur.dashboard') }}" class="mb-3 d-flex justify-content-center align-items-center" style="gap: 10px;  margin-bottom: 20px;">
                    <input type="hidden" name="course_id" value="{{ $selectedCourse->id }}">
                    <input type="hidden" name="active_tab" value="project">
                    <input type="search" name="search_project" value="{{ request('search_project') }}" placeholder="Cari Project" class="form-control" style="width: 100%; max-width: 500px;" />
                    <button type="submit" class="btn-orange">
  <span>Cari</span>
</button>
                </form>

                @forelse($projects as $item)
                    <div class="materi-item d-flex justify-content-between align-items-start mb-3 p-3 border rounded">
                        <div class="materi-content">
                            <strong>{{ $item->judul }}</strong>
                            <p>{{ $item->deskripsi ?? 'Deskripsi tidak tersedia' }}</p>
                        </div>
                        <div class="materi-action d-flex flex-column gap-2">
                            <a href="{{ route('instruktur.submission.index', $item->id) }}" class="detail-btn" title="Lihat Submission Project" aria-label="Lihat Submission Project">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 20px; height: 20px;">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-white">Belum ada project untuk course ini.</p>
                @endforelse

            </div>
        </div>
    </section>

    <section id="section-course" class="d-none" style="margin-top: -5px;">
        <div class="materi-subtitle text-center mb-3 " style="max-width: 1100px; margin: 0 auto; font-weight: bold; font-size: 25px; margin-bottom: 20px; color: orange;">Daftar Course yang Diajarkan</div>
        <div class="course-list" style="max-width: 1100px; margin: 0 auto; ">
            @forelse($courses as $course)
                <div class="course-card mb-4" style="background: #f4d453; padding: 20px; border-radius: 16px; color: rgb(0, 0, 0); box-shadow: 0 4px 10px rgba(0,0,0,0.2); max-width: 1000px; margin: 20px auto;">
            @if($course->banner_image)
                <img src="{{ asset('storage/' . $course->banner_image) }}" alt="Course Banner"
                    style="width: 100%; max-height: 320px; object-fit: cover; border-radius: 12px; margin-bottom: 12px;">
            @else
                <img src="https://via.placeholder.com/1000x220?text=Course"
                    alt="Default Banner"
                    style="width: 100%; max-height: 220px; object-fit: cover; border-radius: 12px; margin-bottom: 12px;">
            @endif
            <h2 style="font-size: 24px; font-weight: bold;">{{ $course->nama_course }}</h2>
            <p style="font-size: 16px;">{{ Str::limit($course->deskripsi, 160) }}</p>
            <a href="{{ route('instruktur.dashboard', ['course_id' => $course->id]) }}" class="btn btn-light mt-2" style="font-weight: bold;">Lihat materi →</a>
        </div>

            @empty
                <p class="text-white">Belum ada course untuk ditampilkan.</p>
            @endforelse
        </div>
    </section>
    @else
        <p class="text-white">Belum ada course aktif.</p>
    @endif
</div>

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

                Object.values(sections).forEach(s => s.classList.remove('active'));
                sections[tab.id].classList.add('active');
            });
        });

        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = urlParams.get('active_tab') || 'materi';

        tabs.forEach(tab => tab.classList.remove('active'));
        Object.values(sections).forEach(s => s.classList.remove('active'));

        const activeTabButton = document.getElementById('tab-' + activeTab);
        const activeSection = sections['tab-' + activeTab] || sections['tab-materi'];

        if (activeTabButton) activeTabButton.classList.add('active');
        if (activeSection) activeSection.classList.add('active');
    });

    function toggleMateriForm() {
        const form = document.getElementById('materi-form');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }

    function toggleProjectForm() {
        const form = document.getElementById('project-form');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }
</script>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#3085d6'
        });
    @endif
</script>
@endpush

