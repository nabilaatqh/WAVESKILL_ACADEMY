@extends('layouts.admin')

@section('title', 'Edit Course')

@section('content')
<div class="container py-4">
    <h3 class="text-white mb-3">✏️ Edit Course</h3>

    <div class="card bg-white shadow-sm rounded p-4">
        <form action="{{ route('admin.course.update', $course->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama_course" class="form-label">Nama Course</label>
                <input type="text" class="form-control @error('nama_course') is-invalid @enderror"
                       id="nama_course" name="nama_course" value="{{ old('nama_course', $course->nama_course) }}" required>
                @error('nama_course')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="instruktur_id" class="form-label">Pilih Instruktur</label>
                <select name="instruktur_id" id="instruktur_id" class="form-select @error('instruktur_id') is-invalid @enderror">
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
                <textarea name="deskripsi" id="deskripsi" rows="4"
                          class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $course->deskripsi) }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="whatsapp_link" class="form-label">Link WhatsApp Grup</label>
                <input type="url" class="form-control @error('whatsapp_link') is-invalid @enderror"
                       name="whatsapp_link" value="{{ old('whatsapp_link', $course->whatsapp_link ?? '') }}"
                       placeholder="https://chat.whatsapp.com/xxxx">
                @error('whatsapp_link')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            @if($course->banner_image)
                <div class="mb-3">
                    <label class="form-label">Banner Saat Ini</label>
                    <div class="border rounded p-2" style="max-width: 300px;">
                        <img src="{{ asset('storage/' . $course->banner_image) }}" alt="Current Banner"
                             class="img-fluid rounded" style="max-height: 200px;">
                    </div>
                </div>
            @endif

            <div class="mb-4">
                <label for="banner_image" class="form-label">Upload Banner Baru (Opsional)</label>
                <input type="file" class="form-control @error('banner_image') is-invalid @enderror"
                       id="banner_image" name="banner_image">
                @error('banner_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.course.index') }}" class="btn btn-secondary">← Batal</a>
                <button type="submit" class="btn btn-success">💾 Perbarui Course</button>
            </div>
        </form>
    </div>
</div>
@endsection
