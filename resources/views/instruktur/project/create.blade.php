@extends('layouts.instruktur')

@section('title', 'Tambah Project')

@section('content')
<div class="container py-4">
    <h4 class="mb-3">Tambah Project Baru</h4>

    <form action="{{ route('instruktur.project.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label>Course</label>
            <select name="course_id" class="form-control" required>
                @foreach($courseList as $course)
                <option value="{{ $course->id }}">{{ $course->nama_course }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>File (PDF)</label>
            <input type="file" name="file" class="form-control" accept=".pdf">
        </div>
        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
