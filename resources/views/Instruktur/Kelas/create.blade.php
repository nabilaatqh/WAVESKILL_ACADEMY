@extends('layouts.instructor')

<form action="{{ route('instruktur.kelas.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Nama Kelas</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
    </div>

    <div class="mb-3">
        <label>Upload Gambar Banner</label>
        <input type="file" name="banner" class="form-control" accept="image/*" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
