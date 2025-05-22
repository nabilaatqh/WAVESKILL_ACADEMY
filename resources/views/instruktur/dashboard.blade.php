@extends('layouts.instruktur')

@section('title', 'Dashboard Instruktur')

@section('content')
<h2 class="welcome">Halo Selamat Datang, <br>
    <span class="highlight">Instruktur {{ Auth::user()->name }}</span>
</h2>

@if($kelas->count())
    <div class="current-class-card">
        <h4>Kelas yang diajar saat ini</h4>
        <div class="class-box">
            <img src="{{ asset('storage/' . $kelas[0]->banner) }}" alt="Banner" class="dashboard-banner">
            <div class="class-desc">
                <h3>{{ $kelas[0]->nama_kelas }}</h3>
            </div>
        </div>
    </div>
@endif

<div class="tab-menu mt-4">
    <button class="tab-button active" onclick="showTab('materi-tab', this)">Materi</button>
    <button class="tab-button" onclick="showTab('project-tab', this)">Project</button>
    <button class="tab-button" onclick="showTab('kelas-tab', this)">Kelas Kamu</button>
</div>

{{-- Tab: Materi --}}
<div id="materi-tab" class="tab-content">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="section-title mt-5">Daftar Materi</h4>
        @if($kelas->count())
            <a href="{{ route('instruktur.materi.create', $kelas[0]->id) }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Tambah Materi
            </a>
        @else
            <span class="text-muted">Tambahkan kelas terlebih dahulu untuk membuat materi</span>
        @endif
    </div>
    <div class="accordion-list">
        @forelse($materi as $m)
            <div class="accordion d-flex justify-content-between align-items-center">
                <a href="{{ route('instruktur.materi.show', $m->id) }}">
                    {{ $m->judul }}
                </a>
                <div>
                    <a href="{{ route('instruktur.materi.edit', $m->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('instruktur.materi.destroy', $m->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus materi ini?')">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <p style="margin-top: 10px;">Belum ada materi.</p>
        @endforelse
    </div>
</div>

{{-- Tab: Project --}}
<div id="project-tab" class="tab-content hidden">
    <h4 class="section-title mt-5">Daftar Project</h4>
    <div class="accordion-list">
        @forelse($projects as $p)
            <div class="accordion">
                <div class="left">
                    <h4>📁 {{ $p->judul }}</h4>
                    <p>{{ $p->deskripsi }}</p>
                    <p><strong>{{ $p->jumlah_submission ?? 0 }}</strong> Project dikumpulkan</p>
                </div>
                <div class="right">
                    <a href="{{ route('instruktur.project.submission', $p->id) }}">
                        <button>Lihat Submission</button>
                    </a>
                </div>
            </div>
        @empty
            <p>Belum ada project.</p>
        @endforelse
    </div>
</div>

{{-- Tab: Kelas --}}
<div id="kelas-tab" class="tab-content hidden">
    <h4 class="section-title mt-5">Daftar Kelas yang Dipegang</h4>
    <div class="kelas-list mt-3">
        @foreach($kelas as $k)
            <div class="kelas-card">
                <img src="{{ asset('storage/' . $k->banner) }}" class="kelas-banner" alt="Banner">
                <h5>{{ $k->nama_kelas }}</h5>
            </div>
        @endforeach
    </div>
</div>

{{-- Script --}}
<script>
    function showTab(tabId, el) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
        document.getElementById(tabId).classList.remove('hidden');
        el.classList.add('active');
    }
</script>

<style>
    .hidden { display: none; }
</style>
@endsection
