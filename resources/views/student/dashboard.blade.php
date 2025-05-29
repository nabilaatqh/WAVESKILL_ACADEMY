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
    <div class="current-class-card" id="current-course">
        <h4 class="class-title">Kursus kamu saat ini</h4>

        @if ($currentCourse)
            <div class="class-content mb-3" style="background-color: #FFB347; border-radius: 10px; padding: 15px; display: flex; gap: 15px; align-items: center;">
                <div class="class-image" style="width: 35%;">
                    <img src="{{ asset('images/' . ($currentCourse->image ?? 'default-course.png')) }}"
                        alt="{{ $currentCourse->nama_course }}" style="width: 100%; border-radius: 10px;">
                </div>
                <div class="class-details" style="width: 65%; color: white;">
                    <h3 class="course-title" style="font-weight: 600;">{{ $currentCourse->nama_course }}</h3>
                    <p class="mb-0">Instruktur: <strong>{{ $currentCourse->instruktur->name ?? '-' }}</strong></p>
                    <p class="course-description" style="font-size: 0.9rem;">
                        {{ Str::limit($currentCourse->deskripsi, 150) }}
                    </p>
                    <a href="{{ route('student.courses.show', $currentCourse->id) }}" class="btn btn-light btn-sm mt-2">Lihat Detail Kelas</a>
                </div>
            </div>
        @else
            @foreach($enrolledCourses as $course)
                <div class="class-content mb-3" style="background-color: #FFB347; border-radius: 10px; padding: 15px; display: flex; gap: 15px; align-items: center;">
                    <div class="class-image" style="width: 35%;">
                        @if ($course->banner_image)
                            <img src="{{ asset('storage/' . $course->banner_image) }}"
                                alt="{{ $course->nama_course }}"
                                class="img-fluid rounded mb-3"
                                style="max-height: 150px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/default-course.png') }}"
                                alt="Default Image"
                                class="img-fluid rounded mb-3"
                                style="max-height: 150px; object-fit: cover;">
                        @endif
                    </div>

                    <div class="class-details" style="width: 65%; color: white;">
                        <h3 class="course-title" style="font-weight: 600;">{{ $course->nama_course }}</h3>
                        <p class="course-description" style="font-size: 0.9rem;">
                            {{ Str::limit($course->deskripsi ?? '-', 150) }}
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
        <button class="tab tab-button" data-tab="kelas-kamu">Kursus Kamu</button>
    </div>

    <!-- Tab Materi -->
    <div id="materi" class="tab-content" style="display: block; margin-top: 15px;">
        <h4 style="color: #FFA017;">Materi dari Kursus: {{ $currentCourse->title ?? '-' }}</h4>

        @if ($materi->isEmpty())
            <div style="background: #FFF3CD; padding: 15px; border-radius: 8px;">Belum ada materi tersedia.</div>
        @else
            @foreach ($materi as $item)
                <div style="background: #FFF59D; padding: 10px; border-radius: 8px; margin-bottom: 10px;">
                    <strong>{{ $item->judul }}</strong><br>
                    <small>{{ Str::limit($item->deskripsi, 100) }}</small>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Tab Project -->
    <div id="project" class="tab-content" style="display: none; margin-top: 15px;">
        <h4>Project dari Kursus: {{ $currentCourse->title ?? '-' }}</h4>

        @if ($projects->isEmpty())
            <div style="background: #FFE5B4; padding: 15px; border-radius: 8px;">Belum ada project tersedia.</div>
        @else
            @foreach ($projects as $project)
                <div style="background: #FFF; padding: 15px; border-radius: 10px; margin-bottom: 10px; color: black;">
                    <h5>{{ $project->judul }}</h5>
                    <p>{{ Str::limit($project->deskripsi, 100) }}</p>
                    <a href="{{ route('student.project.show', $project->id) }}" class="btn btn-sm btn-primary">Lihat Project</a>
                </div>
            @endforeach
        @endif
    </div>

    <div id="kelas-kamu" class="tab-content" style="display: none; margin-top: 15px; color: white;">
        <h4>Semua Kursus Kamu</h4>
        @foreach ($enrolledCourses as $course)
            <div class="class-card mb-3 select-course"
                data-id="{{ $course->id }}"
                data-nama="{{ $course->nama_course }}"
                data-deskripsi="{{ $course->deskripsi }}"
                data-image="{{ asset('images/' . ($course->image ?? 'default-course.png')) }}"
                data-instruktur="{{ $course->instruktur->name ?? '-' }}"
                style="background-color: #FF8C00; border-radius: 10px; padding: 15px; cursor: pointer;">
                
                <img src="{{ asset('images/' . ($course->image ?? 'default-course.png')) }}"
                    alt="{{ $course->nama_course }}" style="width: 100%; border-radius: 8px; margin-bottom: 10px;">
                <h5 style="color: white;">{{ $course->nama_course }}</h5>
                <p class="mb-1" style="color: white;">
                    Instruktur: <strong>{{ $course->instruktur->name ?? '-' }}</strong>
                </p>
                <p style="color: white;">{{ Str::limit($course->deskripsi, 150) }}</p>
                <a href="{{ route('student.courses.show', $course->id) }}" class="btn btn-light btn-sm mt-2">Lihat Detail</a>
            </div>
        @endforeach
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
    document.querySelectorAll('.select-course').forEach(card => {
        card.addEventListener('click', () => {
            const id = card.dataset.id;
            const nama = card.dataset.nama;
            const deskripsi = card.dataset.deskripsi;
            const image = card.dataset.image;
            const instruktur = card.dataset.instruktur;

            document.getElementById('current-course').innerHTML = `
                <h4 class="class-title">Kursus kamu saat ini</h4>
                <div class="class-content mb-3" style="background-color: #FFB347; border-radius: 10px; padding: 15px; display: flex; gap: 15px; align-items: center;">
                    <div class="class-image" style="width: 35%;">
                        <img src="${image}" alt="${nama}" style="width: 100%; border-radius: 10px;">
                    </div>
                    <div class="class-details" style="width: 65%; color: white;">
                        <h3 class="course-title" style="font-weight: 600;">${nama}</h3>
                        <p class="mb-0">Instruktur: <strong>${instruktur}</strong></p>
                        <p class="course-description" style="font-size: 0.9rem;">${deskripsi.substring(0, 150)}</p>
                        <a href="/student/courses/${id}" class="btn btn-light btn-sm mt-2">Lihat Detail Kelas</a>
                    </div>
                </div>`;
        });
    });
</script>
@endsection
