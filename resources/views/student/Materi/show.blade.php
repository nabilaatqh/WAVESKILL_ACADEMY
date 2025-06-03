@extends('layouts.student')

@section('title', 'Detail Materi')

@section('content')
<div class="container py-4">
    <h3>{{ $materi->judul }}</h3>
    <p>{{ $materi->deskripsi }}</p>

    @if($materi->tipe === 'pdf')
        <iframe src="{{ asset('storage/' . $materi->file) }}" width="100%" height="600px"></iframe>
    @elseif($materi->tipe === 'video')
        <video width="100%" controls>
            <source src="{{ asset('storage/' . $materi->file) }}" type="video/mp4">
        </video>
    @elseif($materi->tipe === 'link')
        <a href="{{ $materi->file }}" target="_blank" class="btn btn-warning">Buka Link</a>
    @endif
</div>
@endsection