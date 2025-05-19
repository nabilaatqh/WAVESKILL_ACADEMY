@extends('layouts.instructor')
@section('title', 'Daftar Project')
@section('content')

<a href="{{ route('instruktur.project.create') }}" class="btn btn-success mb-3">+ Tambah Project</a>

@if(session('success'))
    <div style="background-color: #d4edda; padding: 10px; margin-bottom: 16px;">{{ session('success') }}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Judul</th>
            <th>Kelas</th>
            <th>Deadline</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($project as $p)
        <tr>
            <td>{{ $p->judul }}</td>
            <td>{{ $p->kelas->nama }}</td>
            <td>{{ $p->deadline }}</td>
            <td>
                <a href="{{ route('instruktur.project.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('instruktur.project.destroy', $p->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin hapus project ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
