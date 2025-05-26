@extends('layouts.student')

@section('content')
<a href="{{ route('student.courses.index') }}" class="btn btn-secondary mb-3">← Kembali ke Daftar Kursus</a>

<h2>{{ $course->title }}</h2>

<p><strong>Harga:</strong> Rp {{ number_format($course->harga, 0, ',', '.') }}</p>
<p><strong>Deskripsi:</strong></p>
<p>{{ $course->deskripsi }}</p>

<h4>Grup Kelas</h4>
<ul>
    @foreach ($course->groups as $group)
        <li>
            {{ $group->title }} - 
            <a href="{{ $group->whatsapp_link }}" target="_blank">Grup WhatsApp</a>
        </li>
    @endforeach
</ul>

<a href="{{ route('student.enroll.form', $course->id) }}" class="btn btn-success">Beli Kursus</a>
@endsection
