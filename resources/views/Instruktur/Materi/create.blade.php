@extends('layouts.instructor')
@section('title', 'Tambah Materi')

@section('content')
<div class="container mt-4">
    <h3>📁 Tambah Materi untuk Kelas: <strong>{{ $kelasAktif->nama }}</strong></h3>

    <a href="{{ route('instruktur.dashboard') }}" class="btn btn-sm btn-secondary mb-3">← Kembali ke Dashboard</a>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('instruktur.materi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Hidden kelas_id --}}
        <input type="hidden" name="kelas_id" value="{{ $kelasAktif->id }}">

        <div class="form-group">
            <label>Judul Materi</label>
            <input type="text" name="judul" class="form-control" required value="{{ old('judul') }}">
        </div>

        <div class="form-group mt-2">
            <label>Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="form-control" required>{{ old('deskripsi') }}</textarea>
        </div>

        <div class="form-group mt-2">
            <label>Upload File Materi (opsional)</label>
            <input type="file" name="file" class="form-control" accept=".pdf,.mp4,.doc,.ppt,.zip">
        </div>

        <button type="submit" class="btn btn-success mt-3">Simpan</button>
    </form>
</div>
@endsection
