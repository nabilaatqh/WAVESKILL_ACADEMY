@extends('layouts.instruktur')

@section('title', 'Tambah Materi')

@section('content')
<div class="dashboard-wrapper">
    <h3>Tambah Materi</h3>
    <form action="{{ route('materi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label>Tipe Materi</label>
            <select name="tipe" class="form-control" required>
                <option value="pdf">PDF</option>
                <option value="video">Video</option>
                <option value="link">Link</option>
            </select>
        </div>

        <div class="form-group">
            <label>Upload File (opsional)</label>
            <input type="file" name="file" class="form-control">
        </div>

        <div class="form-group">
            <label>Pilih Course</label>
            <select name="course_id" class="form-control" required>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->nama_course }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
