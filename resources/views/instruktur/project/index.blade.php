@extends('layouts.instruktur')

@section('title', 'Daftar Project')

@section('content')
<div class="container py-4">
    <h4 class="mb-3">Daftar Project</h4>
    <a href="{{ route('instruktur.project.create') }}" class="btn btn-primary mb-3">+ Tambah Project</a>

    @forelse ($projects as $project)
    <div class="card mb-3">
        <div class="card-body">
            <h5>{{ $project->judul }}</h5>
            <p>{{ $project->deskripsi }}</p>

            <a href="{{ route('instruktur.project.show', $project->id) }}" class="btn btn-warning btn-sm">Detail</a>
            <a href="{{ route('instruktur.project.edit', $project->id) }}" class="btn btn-secondary btn-sm">Edit</a>

            <form action="{{ route('instruktur.project.destroy', $project->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus project ini?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">Hapus</button>
            </form>
        </div>
    </div>
    @empty
    <p>Tidak ada project.</p>
    @endforelse
</div>
@endsection
