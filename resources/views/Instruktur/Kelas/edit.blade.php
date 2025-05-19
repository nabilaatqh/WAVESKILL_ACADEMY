@extends('layouts.instructor')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Edit Kelas: {{ $kelas->nama }}</h2>

    <form action="{{ route('instruktur.kelas.update', $kelas->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Kelas</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $kelas->nama) }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control" required>{{ old('deskripsi', $kelas->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="banner" class="form-label">Ganti Banner (Opsional)</label>
            <input type="file" name="banner" id="banner" class="form-control" accept="image/*">
            @if ($kelas->banner)
                <small class="d-block mt-2">Banner saat ini:</small>
                <img src="{{ asset('storage/' . $kelas->banner) }}" alt="Banner" class="img-thumbnail mt-1" style="max-width: 200px;">
            @endif
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('instruktur.kelas.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
