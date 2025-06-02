@extends('layouts.instruktur')

@section('title', 'Tambah Project')

@section('content')
<div class="container py-4">
    <h4 class="mb-3">Tambah Project Baru</h4>

    {{-- Tampilkan error validasi jika ada --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Tambah Project --}}
    <form action="{{ route('instruktur.project.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="judul">Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="course_id">Pilih Course</label>
            <select name="course_id" class="form-control" required>
                <option value="">-- Pilih Course --</option>
                @foreach($course as $item)
                    <option value="{{ $item->id }}" {{ old('course_id') == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_course }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tipe">Tipe Project</label>
            <select name="tipe" class="form-control" required>
                <option value="">-- Pilih Tipe --</option>
                <option value="pdf" {{ old('tipe') == 'pdf' ? 'selected' : '' }}>PDF</option>
                <option value="video" {{ old('tipe') == 'video' ? 'selected' : '' }}>Video</option>
                <option value="link" {{ old('tipe') == 'link' ? 'selected' : '' }}>Link</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="file">Upload File (PDF/Video)</label>
            <input type="file" name="file" class="form-control" accept=".pdf,.mp4">
        </div>

        <button type="submit" class="btn btn-primary w-100">Simpan</button>
    </form>
</div>
@endsection
