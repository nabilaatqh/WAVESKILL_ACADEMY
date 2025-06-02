@extends('layouts.instruktur')

@section('title', 'Edit Project')

@section('content')
<div class="center-container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card" style="
        background: white;
        padding: 40px 40px 80px 40px;
        border-radius: 20px;
        max-width: 900px;
        min-height: 500px;
        width: 100%;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    ">

     <h3 class="text-center mb-4" style="font-size: 28px; margin-bottom: 40px;">Edit Project</h3>

    <form action="{{ route('instruktur.project.update', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

      <div class="form-group mb-3" style="margin-bottom: 20px;">
            <label class="form-label fw-semibold">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control" required value="{{ old('judul', $project->judul) }}">
        </div>

       <div class="form-group mb-3" style="margin-bottom: 20px;>
            <label class="form-label fw-semibold">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control">{{ old('deskripsi', $project->deskripsi) }}</textarea>
        </div>

        <div class="form-group mb-4" style="margin-bottom: 20px;>
            <label class="form-label fw-semibold">Pilih Course</label>
            <select name="course_id" id="course_id" class="form-control" required>
                @foreach($course as $course)
                <option value="{{ $course->id }}" {{ (old('course_id', $project->course_id) == $course->id) ? 'selected' : '' }}>
                    {{ $course->nama_course }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3"  style="margin-bottom: 20px;>
            <label for="file" class="form-label">File (PDF) @if($project->file) <small>(Biarkan kosong untuk mempertahankan file lama)</small> @endif</label>
            <input type="file" name="file" id="file" class="form-control" accept=".pdf">
        </div>

        <div class="text-end">
                <button type="submit" class="btn btn-danger">Update</button>
    </form>
</div>
@endsection
