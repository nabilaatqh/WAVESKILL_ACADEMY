@extends('layouts.instruktur')

@section('title', 'Detail Materi')

@section('content')
<div class="dashboard-wrapper">
    <div class="materi-detail-card">
        <h2 class="materi-title">{{ $materi->judul }}</h2>
        <p class="materi-deskripsi">{{ $materi->deskripsi }}</p>

        @if($materi->tipe === 'file')
            <div class="materi-file">
                <iframe src="{{ asset('storage/' . $materi->file) }}" width="100%" height="500px"></iframe>
            </div>
        @elseif($materi->tipe === 'link' && $materi->link)
            <div class="materi-video">
                <iframe width="100%" height="400" src="{{ $materi->link }}" frameborder="0" allowfullscreen></iframe>
            </div>
        @endif

        <div class="mt-4">
            <a href="{{ route('instruktur.dashboard', ['course_id' => $materi->course_id]) }}" class="btn btn-secondary">Kembali ke Dashboard</a>
        </div>
    </div>
</div>
@endsection
