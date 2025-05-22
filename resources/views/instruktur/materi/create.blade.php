@extends('layouts.instruktur')

@section('content')
<div class="container p-4" style="background-color: #33c9f1; min-height: 90vh;">
    <h3 class="mb-4" style="color: #000; font-weight: 600;">Tambah Materi untuk Kelas: {{ $kelas->nama_kelas }}</h3>

    <form action="{{ route('instruktur.materi.store', $kelas->id) }}" method="POST" enctype="multipart/form-data" style="max-width: 600px; background: white; padding: 20px; border-radius: 8px;">
        @csrf

        <div class="mb-3">
            <input type="text" name="judul" placeholder="Judul Materi" value="{{ old('judul') }}" required
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
            @error('judul')
                <div style="color: red; font-size: 0.9rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <textarea name="deskripsi" placeholder="Deskripsi Materi" rows="4" required
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc;">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <div style="color: red; font-size: 0.9rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="file" style="font-weight: 600;">Upload File Materi</label><br>
            <input type="file" name="file" id="file" required>
            @error('file')
                <div style="color: red; font-size: 0.9rem;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" style="background-color: #f68b1f; border: none; padding: 10px 20px; color: white; font-weight: 600; border-radius: 5px; cursor: pointer;">
            Simpan
        </button>
    </form>
</div>
@endsection
