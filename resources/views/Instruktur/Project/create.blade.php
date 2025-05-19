@extends('layouts.instructor')
@section('title', 'Tambah Project')
@section('content')

<h2 class="mb-4">Tambah Project Baru</h2>

<form action="{{ route('instruktur.project.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="kelas_id" class="form-label">Pilih Kelas</label>
        <select name="kelas_id" class="form-control" required>
            <option value="">-- Pilih Kelas --</option>
            @foreach ($kelas as $k)
                <option value="{{ $k->id }}">{{ $k->nama }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="judul" class="form-label">Judul Project</label>
        <input type="text" name="judul" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
    </div>

    <div class="mb-3">
        <label for="deadline" class="form-label">Deadline</label>
        <input type="date" name="deadline" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

@endsection
