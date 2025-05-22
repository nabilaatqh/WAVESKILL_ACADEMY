@extends('layouts.instruktur')

@section('title', 'Kelas Instruktur')

@section('content')
    <h2 class="welcome">Halo Selamat Datang, <br>
        <span class="highlight">Instruktur {{ Auth::user()->name }}</span>
    </h2>

    <div class="tab-menu mt-4">
        <a href="{{ route('instruktur.materi.index') }}" class="tab-button">Materi</a>
        <a href="{{ route('instruktur.project.index') }}" class="tab-button">Project</a>
        <button class="tab-button active">Kelas Kamu</button>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-5">
        <h4 class="section-title">Daftar Kelas yang Dipegang</h4>
        <a href="{{ route('instruktur.kelas.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Tambah Kelas
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="kelas-list mt-3">
        @forelse($kelas as $k)
            <div class="kelas-card">
                <img src="{{ asset('storage/' . $k->banner) }}" class="kelas-banner" alt="Banner">
                <h5>{{ $k->nama_kelas }}</h5>
                <p>{{ $k->deskripsi }}</p>

                <div class="d-flex gap-2 mt-2">
                    <a href="{{ route('instruktur.kelas.edit', $k->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('instruktur.kelas.destroy', $k->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus kelas ini?')">Hapus</button>
                    </form>
                    <a href="{{ route('instruktur.materi.index') }}?kelas_id={{ $k->id }}" class="btn btn-sm btn-info">Lihat Materi</a>
                </div>
            </div>
        @empty
            <p>Belum ada kelas ditemukan.</p>
        @endforelse
    </div>
@endsection
