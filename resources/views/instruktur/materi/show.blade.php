@extends('layouts.instruktur')

@section('title', 'Detail Materi')

@section('content')
<h3>{{ $materi->judul }}</h3>
<p>{{ $materi->isi }}</p>
<a href="{{ route('instruktur.materi.index') }}">Kembali</a>
@endsection
