@extends('layouts.instructor')
@section('title', 'Edit Materi')
@section('content')

<h2 class="mb-4">Edit Materi: {{ $materi->judul }}</h2>

<form action="{{ route('instruktur.materi.update', $materi->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="kelas_id" class="form-label">Pilih Kelas</label>
        <select name="kelas_id" class="form-control" required>
            <option value="">-- Pilih Kelas --</option>
            @foreach ($kelas as $k)
                <option value="{{ $k->id }}" {{ $materi->kelas_id == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="judul" class="form-label">Judul Materi</label>
        <input type="text" name="judul" class="form-control" value="{{ $materi->judul }}" required>
    </div>

    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="4" required>{{ $materi->deskripsi }}</textarea>
    </div>

    <div class="mb-3">
        <label for="file" class="form-label">Ganti File Materi (Opsional)</label>
        <input type="file" name="file" class="form-control">
        @if ($materi->file)
            <p class="mt-2">File saat ini: <a href="{{ asset('storage/' . $materi->file) }}" target="_blank">Lihat File</a></p>
        @endif
    </div>

    <button type="submit" class="btn btn-success">Update</button>
</form>

@endsection
