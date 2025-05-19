@extends('layouts.instructor')
@section('title', 'Dashboard Instruktur')

@section('content')

@if ($kelasAktif)
    {{-- Kelas aktif --}}
    <div class="class-card">
        <h3>Kelas yang diajar saat ini</h3>
        <img src="{{ asset('storage/' . $kelasAktif->banner) }}" alt="{{ $kelasAktif->nama }}">
        <h4>{{ $kelasAktif->nama }}</h4>
        <p>{{ $kelasAktif->deskripsi }}</p>
    </div>

     <div class="search-box">
        <input type="text" placeholder="Cari Materi" style="width: 100%; border: none; outline: none;">
    </div>

   {{-- Tabs Navigasi --}}
<div class="tabs">
    <button onclick="showTab('materi')" class="tab-btn active" id="tab-materi">Materi</button>
    <button onclick="showTab('project')" class="tab-btn" id="tab-project">Project</button>
    <button onclick="showTab('kelas')" class="tab-btn" id="tab-kelas">Kelas Kamu</button>
</div>


    {{-- Konten Tab Materi --}}
<div id="materi-content" class="tab-content">
    @forelse ($materis as $materi)
        <div class="accordion-wrapper">
            <button class="accordion">{{ $materi->judul }}</button>
            <div class="panel" style="display: none;">
                <p>{{ $materi->deskripsi }}</p>

                @if ($materi->file)
                    <a href="{{ asset('storage/' . $materi->file) }}" target="_blank" class="btn btn-sm btn-primary mb-2">
                        📂 Lihat File
                    </a>
                @endif

                <br>
                <a href="{{ route('instruktur.materi.show', $materi->id) }}" class="btn btn-sm btn-outline-info">
                    🔍 Detail Lengkap →
                </a>
            </div>
        </div>
    @empty
        <p style="color: white;">Belum ada materi untuk kelas ini.</p>
    @endforelse
</div>


{{-- Konten Tab Project --}}
<div id="project-content" class="tab-content" style="display: none;">
    @forelse ($projects as $project)
        <div class="class-card" style="background-color: #FFF176; color: black; margin-bottom: 15px;">
            <h4>{{ $project->judul }}</h4>
            <p>{{ Str::limit($project->deskripsi, 150) }}</p>
            <a href="#" class="btn btn-danger btn-sm">Lihat Submission</a>
        </div>
    @empty
        <p style="color: white;">Belum ada project untuk kelas ini.</p>
    @endforelse
</div>

{{-- Konten Tab Kelas --}}
<div id="kelas-content" class="tab-content" style="display: none;">
    <h4 style="color: #FFA500; font-weight: bold;">Daftar Kelas Yang Diajarkan</h4>

    @forelse ($kelasList as $kelas)
        <div class="class-card" style="background-color: #FFF176; color: black; border-radius: 10px; padding: 16px; margin-bottom: 20px;">
            <div style="display: flex; gap: 16px;">
                <img src="{{ asset('storage/' . $kelas->banner) }}" alt="{{ $kelas->nama }}" style="width: 180px; border-radius: 10px;">
                <div>
                    <h4 style="font-weight: bold;">{{ $kelas->nama }}</h4>
                    <p style="margin-bottom: 10px;">{{ Str::limit($kelas->deskripsi, 200) }}</p>
                    <a href="{{ route('instruktur.materi.index', ['kelas' => $kelas->id]) }}" class="btn btn-sm btn-dark">
                        Lihat materi →
                    </a>
                </div>
            </div>
        </div>
    @empty
        <p style="color: white;">Belum ada kelas. Yuk buat kelas pertamamu!</p>
    @endforelse
</div>

{{-- JS untuk Tabs --}}
<script>
    function showTab(tab) {
        const tabs = ['materi', 'project', 'kelas'];

        tabs.forEach(t => {
            document.getElementById(`${t}-content`).style.display = (t === tab) ? 'block' : 'none';
            document.getElementById(`tab-${t}`).classList.toggle('active', t === tab);
        });
    }
</script>

<style>
    .tab-btn {
        border: none;
        border-radius: 15px;
        padding: 5px 15px;
        font-weight: bold;
        margin-right: 8px;
        cursor: pointer;
        background-color: #FFF176;
        color: black;
    }

    .tab-btn.active {
        background-color: #FF9F29;
        color: white;
    }

    .tab-content {
        margin-top: 20px;
    }
</style>

    {{-- Accordion Materi dari database --}}
@forelse ($materis as $materi)
    <div class="accordion-wrapper">
        <button class="accordion">{{ $materi->judul }}</button>
        <div class="panel" style="display: none;">
            <p>{{ $materi->deskripsi }}</p>
            @if ($materi->file)
                <a href="{{ asset('storage/' . $materi->file) }}" target="_blank" class="btn btn-sm btn-primary">Lihat File</a>
            @endif
        </div>
    </div>

@empty
@endforelse


@else
    {{-- Tidak ada kelas --}}
    <div class="class-card" style="text-align: center;">
        <h3>Belum ada kelas yang diajar saat ini</h3>
        <p>Silakan buat kelas pertamamu untuk memulai mengajar di WaveSkill Academy.</p>
        <a href="{{ route('instruktur.kelas.create') }}" class="btn btn-success" style="padding: 10px 20px; border-radius: 10px; background-color: #28a745; color: white; font-weight: bold; text-decoration: none;">+ Tambah Kelas</a>
    </div>
@endif

@endsection
