@extends('layouts.admin')

@section('title', 'Edit Course')

@section('content')
<div class="container">
    <h1>Edit Course</h1>

    <form action="{{ route('admin.course.update', $course->id) }}" method="POST" enctype="multipart/form-data"> <!-- Pastikan enctype ada -->
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_course" class="form-label">Nama Course</label>
            <input type="text" class="form-control @error('nama_course') is-invalid @enderror" id="nama_course" name="nama_course" value="{{ old('nama_course', $course->nama_course) }}" required>
            @error('nama_course')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="instruktur_id" class="form-label">Pilih Instruktur</label>
            <select name="instruktur_id" id="instruktur_id" class="form-control @error('instruktur_id') is-invalid @enderror">
                <option value="">-- Pilih Instruktur --</option>
                @foreach ($instrukturs as $instruktur)
                    <option value="{{ $instruktur->id }}" {{ old('instruktur_id', $course->instruktur_id) == $instruktur->id ? 'selected' : '' }}>
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
            <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $course->deskripsi) }}</textarea>
            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Menampilkan banner_image jika ada -->
        @if($course->banner_image)
            <div class="mb-3">
                <label for="current_banner" class="form-label">Current Banner</label><br>
                <img src="{{ asset('storage/' . $course->banner_image) }}" alt="Current Banner" class="img-fluid" style="max-width: 100%; max-height: 300px;">
            </div>
        @endif

        <!-- Field untuk upload gambar banner -->
        <div class="mb-3">
            <label for="banner_image" class="form-label">Banner Course (Opsional)</label>
            <input type="file" class="form-control @error('banner_image') is-invalid @enderror" id="banner_image" name="banner_image">
            @error('banner_image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('admin.course.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
