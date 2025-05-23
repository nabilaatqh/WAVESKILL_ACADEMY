@extends('layouts.admin')

@section('title', 'Daftar Course')

@section('content')
<div class="container">
    <h3 style="color: white;">
        Halo Selamat Datang,<br>
        <strong>Admin : {{ Auth::guard('admin')->user()->name ?? '' }}</strong>
    </h3>
    <h3 style="color : white;">Tambah Course</h3>
    <a href="{{ route('admin.course.create') }}" class="btn btn-primary mb-3">Tambah Course</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Course</th>
                <th>Instruktur</th>
                <th>Jumlah Student</th>
                <th>Link WhatsApp</th> {{-- Kolom baru --}}
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
            <tr>
                <td>{{ $course->nama_course }}</td>
                <td>{{ $course->instruktur ? $course->instruktur->name : '-' }}</td>
                <td>{{ $course->students_count }}</td>
                <td>
                    @if ($course->whatsapp_link)
                        <a href="{{ $course->whatsapp_link }}" target="_blank" class="btn btn-success btn-sm">
                            Gabung WA
                        </a>
                    @else
                        <span class="text-muted">Belum ada</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.course.show', $course->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('admin.course.edit', $course->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('admin.course.destroy', $course->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus course ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $courses->links() }}
</div>
@endsection
