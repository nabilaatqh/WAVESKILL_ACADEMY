@extends('layouts.instruktur')

@section('title', 'Tambah Kelas')

@section('content')
<h2 class="welcome">Tambah Kelas Baru</h2>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('instruktur.kelas.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group mb-3">
        <label for="nama_kelas">Nama Kelas</label>
        <input type="text" name="nama_kelas" id="nama_kelas" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label for="deskripsi">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4"></textarea>
    </div>

    <div class="form-group mb-3">
        <label for="banner">Banner</label>
        <input type="file" name="banner" id="banner" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Simpan Kelas</button>
    <a href="{{ route('instruktur.kelas.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
