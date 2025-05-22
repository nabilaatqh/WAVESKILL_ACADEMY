@extends('layouts.instruktur')

@section('title', 'Edit Profil Instruktur')

@section('content')
<div class="profile-card-container">
    <h2 class="profile-title">Profile Akun</h2>

    <div class="profile-card">
        <div class="profile-avatar">
            <img src="{{ asset('images/default-profile.png') }}" alt="Profile Avatar">
        </div>

        <form action="{{ route('instruktur.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama_awal">Nama awal <span class="required">*</span></label>
                <input type="text" name="nama_awal" id="nama_awal" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="nama_akhir">Nama akhir</label>
                <input type="text" name="nama_akhir" id="nama_akhir" class="form-control">
            </div>

            <div class="form-group">
                <label for="domisili">Kota/Kabupaten domisili</label>
                <input type="text" name="domisili" id="domisili" class="form-control">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>

            <div class="form-group">
                <label for="tentang">Tentang Saya</label>
                <textarea name="tentang" id="tentang" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="telepon">Telepon (62) <span class="required">*</span></label>
                <input type="text" name="telepon" id="telepon" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="tempat_lahir">Tempat lahir <span class="required">*</span></label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="tanggal_lahir">Tanggal lahir <span class="required">*</span></label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-submit">Simpan</button>
        </form>
    </div>
</div>
@endsection