@extends('layouts.instruktur')

@section('title', isset($materi) ? 'Edit Materi' : 'Tambah Materi')

@section('content')
<h3>{{ isset($materi) ? 'Edit' : 'Tambah' }} Materi</h3>

<form action="{{ isset($materi) ? route('instruktur.materi.update', $materi->id) : route('instruktur.materi.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($materi))
        @method('PUT')
    @endif

    <input type="text" name="judul" placeholder="Judul Materi" value="{{ old('judul', $materi->judul ?? '') }}" required><br>

    <textarea name="deskripsi" placeholder="Deskripsi Materi" required>{{ old('deskripsi', $materi->deskripsi ?? '') }}</textarea><br>

    <input type="file" name="file" {{ isset($materi) ? '' : 'required' }}><br>

    <input type="number" name="kelas_id" placeholder="ID Kelas" value="{{ old('kelas_id', $materi->kelas_id ?? '') }}" required><br>

    <button type="submit">Simpan</button>
</form>
@endsection
