@extends('layouts.instruktur')

@section('title', 'Edit Materi')

@section('content')
<div class="dashboard-wrapper">
    <h3>Edit Materi</h3>
    <form action="{{ route('instruktur.materi.update', $materi->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ $materi->judul }}" required>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ $materi->deskripsi }}</textarea>
        </div>

        <div class="form-group">
            <label>File Materi</label>
            <input type="file" name="file" class="form-control">
        </div>

        <div class="form-group">
            <label>Pilih Course</label>
            <select name="course_id" class="form-control" required>
                @foreach($course as $course)
                    <option value="{{ $course->id }}" {{ $materi->course_id == $course->id ? 'selected' : '' }}>
                        {{ $course->nama_course }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
