@extends('layouts.instruktur')

@section('title', 'Edit Materi')

@section('content')
<div class="dashboard-wrapper">
    <h3>Edit Materi</h3>

    <form action="{{ route('instruktur.materi.update', $materi->id) }}" method="POST" enctype="multipart/form-data" style="max-width: 600px;">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Judul Materi <span class="text-danger">*</span></label>
            <input type="text" name="judul" value="{{ old('judul', $materi->judul) }}" class="form-control" required>
            @error('judul')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $materi->deskripsi) }}</textarea>
            @error('deskripsi')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3">
            <label>Kelas <span class="text-danger">*</span></label>
            <select name="kelas_id" class="form-control" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}" {{ (old('kelas_id', $materi->kelas_id) == $k->id) ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                @endforeach
            </select>
            @error('kelas_id')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3">
            <label>File Materi (PDF, DOCX)</label>
            <input type="file" name="file" class="form-control">
            <small class="text-muted">Kosongkan jika tidak ingin mengubah file.</small>
            @error('file')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('instruktur.materi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
