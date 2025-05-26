@extends('layouts.instruktur')

@section('title', 'Dashboard Instruktur')

@section('content')
<div class="dashboard-wrapper container-center">
    <div class="welcome-section">
        <h3>
            Halo Selamat Datang,<br>
            instruktur, <span class="highlight">{{ Auth::user()->name }}</span>
        </h3>

        @if($selectedCourse)
        <div class="course-card">
            @if($selectedCourse->banner_image)
            <img src="{{ asset('storage/' . $selectedCourse->banner_image) }}" alt="Course Banner" style="max-width: 100%; max-height: 200px;">
            @endif
            <h4>{{ $selectedCourse->nama_course }}</h4>
            <p>{{ $selectedCourse->deskripsi }}</p>
        </div>
        @else
        <p class="no-course">Belum ada course yang ditambahkan.</p>
        @endif
    </div>

    <nav class="tab-menu">
        <button class="tab-button active" id="tab-materi">Materi</button>
        <button class="tab-button" id="tab-project">Project</button>
        <button class="tab-button" id="tab-course">Course Kamu</button>
    </nav>

    <section id="section-materi">
        @if($selectedCourse)
        <div class="materi-subtitle mb-3 d-flex justify-content-between align-items-center">
            <span>Daftar Materi {{ $selectedCourse->nama_course }}</span>
            <button class="btn btn-success btn-sm" onclick="toggleMateriForm()">+</button>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div id="materi-form" style="display: none;" class="p-3 border rounded bg-light mb-3">
                    <form action="{{ route('instruktur.materi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $selectedCourse->id }}">

                        <input type="text" name="judul" class="form-control mb-2" placeholder="Judul Materi" required>
                        <textarea name="deskripsi" class="form-control mb-2" placeholder="Deskripsi Materi" rows="2"></textarea>
                        <select name="tipe" class="form-control mb-2" required>
                            <option value="pdf">PDF</option>
                            <option value="video">Video</option>
                            <option value="link">Link</option>
                        </select>
                        <input type="file" name="file" class="form-control mb-2" accept=".pdf,.mp4,.">

                        <button type="submit" class="btn btn-primary w-100">Simpan Materi</button>
                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <form method="GET" action="{{ route('instruktur.dashboard') }}" class="mb-3 d-flex">
                    <input type="hidden" name="course_id" value="{{ $selectedCourse->id }}">
                    <input type="hidden" name="active_tab" value="materi">
                    <input
                        type="search"
                        name="search_materi"
                        value="{{ request('search_materi') }}"
                        placeholder="Cari Materi"
                        class="form-control"
                    />
                    <button type="submit" class="btn btn-primary ms-2">Cari</button>
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
        @else
        <p class="text-white">Belum ada course aktif.</p>
        @endif
    </section>

    <section id="section-project" class="d-none">
        @if($selectedCourse)
        <div class="materi-subtitle mb-3 d-flex justify-content-between align-items-center">
            <span>Daftar Project {{ $selectedCourse->nama_course }}</span>
            <button class="btn btn-primary btn-sm" onclick="toggleProjectForm()">+</button>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div id="project-form" style="display: none;" class="p-3 border rounded bg-light mb-3">
                    <form action="{{ route('instruktur.project.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $selectedCourse->id }}">
                        <input type="text" name="judul" class="form-control mb-2" placeholder="Judul Project" required>
                        <textarea name="deskripsi" class="form-control mb-2" placeholder="Deskripsi Project" rows="2"></textarea>
                        <input type="file" name="file" class="form-control mb-2" accept=".pdf">
                        <button type="submit" class="btn btn-success w-100">Simpan</button>
                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <form method="GET" action="{{ route('instruktur.dashboard') }}" class="mb-3 d-flex">
                    <input type="hidden" name="course_id" value="{{ $selectedCourse->id }}">
                    <input type="hidden" name="active_tab" value="project">
                    <input
                        type="search"
                        name="search_project"
                        value="{{ request('search_project') }}"
                        placeholder="Cari Project"
                        class="form-control"
                    />
                    <button type="submit" class="btn btn-primary ms-2">Cari</button>
                </form>

                @forelse($projects as $item)
                <div class="project-item">
                    <div class="project-info">
                        <div class="project-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" class="feather feather-file-text" viewBox="0 0 24 24" width="24" height="24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><line x1="10" y1="9" x2="9" y2="9"></line></svg>
                        </div>
                        <div class="project-details">
                            <div class="project-title">{{ $item->judul }}</div>
                            <div class="project-description">{{ $item->deskripsi ?? 'Deskripsi tidak tersedia' }}</div>
                            <div class="project-description" style="font-size: 13px; margin-top: 4px;">50 Project dikumpulkan</div>
                        </div>
                    </div>
                    <a href="{{ route('instruktur.submission.index', $item->id) }}" class="btn-submission">Lihat Submission</a>
                </div>
                @empty
                <p class="text-white">Belum ada project untuk course ini.</p>
                @endforelse
            </div>
        </div>
        @else
        <p class="text-white">Belum ada course aktif.</p>
        @endif
    </section>

    <section id="section-course" class="d-none">
        <div class="materi-subtitle">Daftar Course yang Diajarkan</div>
        <div class="course-list">
            @forelse($courses as $course)
                <div class="kelas-horizontal-card">
                    <div class="card-image">
                        @if(!empty($course->banner_image))
                            <img src="{{ asset('storage/' . $course->banner_image) }}" alt="Course Banner" style="max-width: 150px; max-height: 100px;">
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
