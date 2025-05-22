@extends('layouts.instruktur')

@section('title', 'Buat Project Baru')

@section('content')
<h3>Buat Project Baru</h3>

<form action="{{ route('instruktur.project.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Judul</label>
        <input type="text" name="judul" class="form-control" value="{{ old('judul') }}">
        @error('judul')<div class="text-danger">{{ $message }}</div>@enderror
    </div>
    <div class="form-group mt-2">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control">{{ old('deskripsi') }}</textarea>
    </div>
    <button type="submit" class="btn btn-success mt-3">Simpan</button>
</form>

<a href="{{ route('instruktur.project.index') }}" class="btn btn-link mt-3">← Kembali ke daftar</a>
@endsection
