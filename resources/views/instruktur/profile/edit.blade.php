@extends('layouts.instruktur')

@section('title', 'Edit Profil Instruktur')

@section('content')
<div class="dashboard-wrapper">
    <h3>Profile Akun</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('instruktur.profile.update') }}" method="POST" enctype="multipart/form-data" style="max-width: 500px; background: white; padding: 25px; border-radius: 12px;">
        @csrf
        @method('PUT')

        {{-- Tampilkan foto profil saat ini jika ada --}}
        <div class="text-center mb-3">
            @if($instruktur->foto)
                <img src="{{ asset('storage/' . $instruktur->foto) }}" alt="Foto Profil" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($instruktur->nama_awal . ' ' . $instruktur->nama_akhir) }}" alt="Avatar" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
            @endif
        </div>

        <div class="form-group mb-3">
            <label>Unggah Foto Profil</label>
            <input type="file" name="foto" class="form-control">
            @error('foto') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group mb-3">
            <label>Nama awal <span style="color: red;">*</span></label>
            <input type="text" name="nama_awal" value="{{ old('nama_awal', $instruktur->nama_awal) }}" class="form-control" required>
            @error('nama_awal') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group mb-3">
            <label>Nama akhir</label>
            <input type="text" name="nama_akhir" value="{{ old('nama_akhir', $instruktur->nama_akhir) }}" class="form-control">
            @error('nama_akhir') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group mb-3">
            <label>Kota/Kabupaten domisili</label>
            <input type="text" name="domisili" value="{{ old('domisili', $instruktur->domisili) }}" class="form-control">
            @error('domisili') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $instruktur->email) }}" class="form-control" required>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group mb-3">
            <label>Tentang Saya</label>
            <textarea name="tentang_saya" class="form-control" rows="4">{{ old('tentang_saya', $instruktur->tentang_saya) }}</textarea>
            @error('tentang_saya') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group mb-3">
            <label>Telepon (62) <span style="color: red;">*</span></label>
            <input type="text" name="telepon" value="{{ old('telepon', $instruktur->telepon) }}" class="form-control" required>
            @error('telepon') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group mb-3">
            <label>Tempat lahir <span style="color: red;">*</span></label>
            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $instruktur->tempat_lahir) }}" class="form-control" required>
            @error('tempat_lahir') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group mb-3">
            <label>Tanggal lahir <span style="color: red;">*</span></label>
            <input type="date" name="tanggal_lahir"
                value="{{ old('tanggal_lahir', optional($instruktur->tanggal_lahir)->format('Y-m-d')) }}"
                class="form-control" required>
            @error('tanggal_lahir') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-danger">Simpan</button>
    </form>
</div>
@endsection
