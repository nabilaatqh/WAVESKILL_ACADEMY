@extends('layouts.instructor')
@section('title', 'Daftar Materi')
@section('content')

<a href="{{ route('instruktur.materi.create') }}" class="btn btn-success mb-3">+ Tambah Materi</a>

@if(session('success'))
    <div style="background: #d4edda; padding: 10px; margin-bottom: 16px;">{{ session('success') }}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Judul</th>
            <th>Kelas</th>
            <th>File</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($materi as $m)
        <tr>
            <td>{{ $m->judul }}</td>
            <td>{{ $m->kelas->nama }}</td>
            <td>
                @if($m->file)
                    <a href="{{ asset('storage/' . $m->file) }}" target="_blank">Lihat File</a>
                @endif
            </td>
            <td>
                <a href="{{ route('instruktur.materi.edit', $m->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('instruktur.materi.destroy', $m->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin hapus?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
