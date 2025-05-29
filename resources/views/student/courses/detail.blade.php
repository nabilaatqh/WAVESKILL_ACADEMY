@extends('layouts.student')

@section('content')

<h2>{{ $course->title }}</h2>

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

@endsection
