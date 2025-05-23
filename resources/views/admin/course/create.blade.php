@extends('layouts.admin')

@section('title', 'Tambah Course')

@section('content')
<div class="container">
    <h1>Tambah Course</h1>

    <form action="{{ route('admin.course.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama_course" class="form-label">Nama Course</label>
            <input type="text" class="form-control @error('nama_course') is-invalid @enderror" id="nama_course" name="nama_course" value="{{ old('nama_course') }}" required>
            @error('nama_course')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="instruktur_id" class="form-label">Pilih Instruktur</label>
            <select name="instruktur_id" id="instruktur_id" class="form-control @error('instruktur_id') is-invalid @enderror">
                <option value="">-- Pilih Instruktur --</option>
                @foreach ($instrukturs as $instruktur)
                    <option value="{{ $instruktur->id }}" {{ old('instruktur_id') == $instruktur->id ? 'selected' : '' }}>
                        {{ $instruktur->name }}
                    </option>
                @endforeach
            </select>
            @error('instruktur_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.course.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
