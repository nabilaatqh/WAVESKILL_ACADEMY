@extends('layouts.instruktur')

@section('title', 'Daftar Materi')

@section('content')
<div class="dashboard-wrapper">
    <h3>Materi per Course</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @foreach($courses as $course)
        <div class="kelas-card mt-4">
            <h4>{{ $course->nama_course }}</h4>
            <a href="{{ route('materi.create') }}?course_id={{ $course->id }}" class="btn btn-sm btn-primary">Tambah Materi</a>
            <ul class="mt-3">
                @forelse($course->materis as $materi)
                    <li>
                        {{ $materi->judul }} - {{ $materi->tipe }}
                        <a href="{{ route('materi.edit', $materi->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('materi.destroy', $materi->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus materi ini?')">Hapus</button>
                        </form>
                    </li>
                @empty
                    <li>Tidak ada materi.</li>
                @endforelse
            </ul>
        </div>
    @endforeach
</div>
@endsection