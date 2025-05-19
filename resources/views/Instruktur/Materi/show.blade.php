@extends('layouts.instructor')
@section('title', 'Detail Materi')

@section('content')
<div class="container mt-4">
    <h3>{{ $materi->judul }}</h3>
    <p><strong>Deskripsi:</strong></p>
    <p>{{ $materi->deskripsi }}</p>

    @if ($materi->file)
        <p><strong>File:</strong></p>
        <a href="{{ asset('storage/' . $materi->file) }}" target="_blank" class="btn btn-primary">
            📂 Lihat / Unduh File
        </a>

        {{-- Optional: Embed preview if PDF --}}
        @if(Str::endsWith($materi->file, ['.pdf']))
            <embed src="{{ asset('storage/' . $materi->file) }}" width="100%" height="600px" type="application/pdf">
        @endif
    @endif

    <br><br>
    <a href="{{ route('instruktur.dashboard') }}" class="btn btn-secondary">← Kembali ke Dashboard</a>
</div>
@endsection
