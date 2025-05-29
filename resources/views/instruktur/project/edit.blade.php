@extends('layouts.instruktur')

@section('title', 'Edit Project')

@section('content')
<div class="container py-4">
    <h4 class="mb-3">Edit Project</h4>

    <form action="{{ route('instruktur.project.update', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control" required value="{{ old('judul', $project->judul) }}">
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control">{{ old('deskripsi', $project->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="course_id" class="form-label">Course</label>
            <select name="course_id" id="course_id" class="form-control" required>
                @foreach($course as $course)
                <option value="{{ $course->id }}" {{ (old('course_id', $project->course_id) == $course->id) ? 'selected' : '' }}>
                    {{ $course->nama_course }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">File (PDF) @if($project->file) <small>(Biarkan kosong untuk mempertahankan file lama)</small> @endif</label>
            <input type="file" name="file" id="file" class="form-control" accept=".pdf">
        </div>

        <button type="submit" class="btn btn-primary">Update Project</button>
    </form>
</div>
@endsection
