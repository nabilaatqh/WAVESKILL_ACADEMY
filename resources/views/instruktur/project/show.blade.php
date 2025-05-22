@extends('layouts.instruktur')

@section('title', $project->judul)

@section('content')
<h3>{{ $project->judul }}</h3>
<p>{{ $project->deskripsi }}</p>

<a href="{{ route('instruktur.project.index') }}" class="btn btn-link mt-3">← Kembali ke daftar</a>
@endsection
