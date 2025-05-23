@extends('layouts.instruktur')

@section('title', 'Daftar Materi')

@section('content')
<div class="dashboard-wrapper">
    <h3>Daftar Materi</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('instruktur.materi.create') }}" class="btn btn-primary mb-3">+ Tambah Materi</a>

    @if($materis->count())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Course</th>
                <th>File</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materis as $materi)
            <tr>
                <td>{{ $materi->judul }}</td>
                <td>{{ $materi->course->nama_course ?? '-' }}</td>
                <td>
                    <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank">Lihat File</a>
                </td>
                <td>
                    <a href="{{ route('instruktur.materi.edit', $materi->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('instruktur.materi.destroy', $materi->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus materi ini?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $materis->links() }}

    @else
        <p>Belum ada materi yang dibuat.</p>
    @endif
</div>
@endsection
