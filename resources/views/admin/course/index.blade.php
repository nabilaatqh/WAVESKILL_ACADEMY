@extends('layouts.admin')

@section('title', 'Daftar Course')

@section('content')
<div class="container py-4">
    <div class="mb-4 text-white">
        <h3>Halo Selamat Datang,<br>
            <strong>Admin : {{ Auth::guard('admin')->user()->name ?? '' }}</strong>
        </h3>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="text-white">📚 Daftar Course</h4>
        <a href="{{ route('admin.course.create') }}" class="btn btn-primary">➕ Tambah Course</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive bg-white rounded shadow p-3">
        <table class="table table-bordered table-striped mb-0">
            <thead class="table-light">
                <tr class="text-center">
                    <th>Nama Course</th>
                    <th>Instruktur</th>
                    <th>Jumlah Student</th>
                    <th>Link WhatsApp</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($courses as $course)
                <tr>
                    <td>{{ $course->nama_course }}</td>
                    <td>{{ $course->instruktur->name ?? '-' }}</td>
                    <td class="text-center">{{ $course->students_count }}</td>
                    <td class="text-center">
                        @if ($course->whatsapp_link)
                            <a href="{{ $course->whatsapp_link }}" target="_blank" class="btn btn-success btn-sm">
                                Gabung WA
                            </a>
                        @else
                            <span class="text-muted">Belum ada</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($course->harga)
                            Rp {{ number_format($course->harga, 0, ',', '.') }}
                        @else
                            <span class="text-muted">Gratis</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.course.show', $course->id) }}" class="btn btn-info btn-sm mb-1">Detail</a>
                        <a href="{{ route('admin.course.edit', $course->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                        <form action="{{ route('admin.course.destroy', $course->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus course ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Belum ada data course.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
