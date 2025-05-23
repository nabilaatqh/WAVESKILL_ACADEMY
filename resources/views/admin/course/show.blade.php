@extends('layouts.admin')

@section('title', 'Detail Course')

@section('content')
<div class="container">
    <h1>Detail Course: {{ $course->nama_course }}</h1>

    <p><strong>Instruktur:</strong> {{ $course->instruktur ? $course->instruktur->name : '-' }}</p>
    <p><strong>Deskripsi:</strong> {{ $course->deskripsi ?? '-' }}</p>

    <h3>Daftar Student</h3>
    @if($course->students->count() > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Student</th>
                <th>Email</th>
                <th>Tanggal Bergabung</th>
            </tr>
        </thead>
        <tbody>
            @foreach($course->students as $student)
            <tr>
                <td>{{ $student->name }}</td> <!-- Ganti 'nama' menjadi 'name' -->
                <td>{{ $student->email }}</td>
                <td>{{ $student->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p>Belum ada student yang terdaftar di course ini.</p>
    @endif

    <a href="{{ route('admin.course.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
