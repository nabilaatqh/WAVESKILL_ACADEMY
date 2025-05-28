@extends('layouts.instruktur')
@section('title', 'Kelola Project')

@section('content')
<div class="container mt-4">
    <h4>Daftar Project</h4>
    <a href="{{ route('instruktur.project.create') }}" class="btn btn-primary mb-3">+ Tambah Project</a>

    @forelse($projects as $project)
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $project->judul }}</h5>
                <p>{{ $project->deskripsi }}</p>
                <p><strong>Course:</strong> {{ $project->course->title ?? '-' }}</p>
                <a href="{{ route('instruktur.project.show', $project->id) }}" class="btn btn-sm btn-success">Detail</a>
                <a href="{{ route('instruktur.project.edit', $project->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('instruktur.project.destroy', $project->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Yakin ingin menghapus project ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    @empty
        <p>Belum ada project ditambahkan.</p>
    @endforelse
</div>
@endsection
