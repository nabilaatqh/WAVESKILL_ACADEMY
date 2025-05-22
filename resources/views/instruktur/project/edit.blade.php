@extends('layouts.instruktur')

@section('title', 'Edit Project')

@section('content')
<h3>Edit Project</h3>

<form action="{{ route('instruktur.project.update', $project->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Judul</label>
        <input type="text" name="judul" class="form-control" value="{{ old('judul', $project->judul) }}">
        @error('judul')<div class="text-danger">{{ $message }}</div>@enderror
    </div>
    <div class="form-group mt-2">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $project->deskripsi) }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Update</button>
</form>

<a href="{{ route('instruktur.project.index') }}" class="btn btn-link mt-3">← Kembali ke daftar</a>
@endsection