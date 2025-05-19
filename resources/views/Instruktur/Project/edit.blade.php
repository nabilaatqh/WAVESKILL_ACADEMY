@extends('layouts.instructor')
@section('title', 'Edit Project')
@section('content')

<h2 class="mb-4">Edit Project: {{ $project->judul }}</h2>

<form action="{{ route('instruktur.project.update', $project->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="kelas_id" class="form-label">Pilih Kelas</label>
        <select name="kelas_id" class="form-control" required>
            <option value="">-- Pilih Kelas --</option>
            @foreach ($kelas as $k)
                <option value="{{ $k->id }}" {{ $project->kelas_id == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="judul" class="form-label">Judul Project</label>
        <input type="text" name="judul" class="form-control" value="{{ $project->judul }}" required>
    </div>

    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="4" required>{{ $project->deskripsi }}</textarea>
    </div>

    <div class="mb-3">
        <label for="deadline" class="form-label">Deadline</label>
        <input type="date" name="deadline" class="form-control" value="{{ $project->deadline ? \Carbon\Carbon::parse($project->deadline)->format('Y-m-d') : '' }}">
    </div>

    <button type="submit" class="btn btn-success">Update</button>
</form>

@endsection
