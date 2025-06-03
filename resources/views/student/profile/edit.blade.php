@extends('layouts.student')

@section('title', 'Edit Profil')

@section('content')

<link rel="stylesheet" href="{{ asset('frontsite/student/profile.css') }}">

<div class="profile-wrapper">
    <div class="profile-card">
        <h2>Profile Akun</h2>

        <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Preview Foto Profil clickable --}}
            <div class="profile-photo-wrapper">
                <label for="photo-input" title="Klik untuk ganti foto profil">
                    <img id="preview-photo"
                         src="{{ $student->photo ? Storage::url($student->photo) : asset('images/avatar-placeholder.png') }}"
                         alt="Foto Profil">
                </label>
                <input type="file" name="photo" id="photo-input" accept="image/*" />
            </div>

            <label for="first_name">Nama Awal <span style="color: red;">*</span></label>
            <input type="text" name="first_name" id="first_name"
                   value="{{ old('first_name', $student->first_name ?? '') }}" required>

            <label for="last_name">Nama Akhir</label>
            <input type="text" name="last_name" id="last_name"
                   value="{{ old('last_name', $student->last_name ?? '') }}">

            <label for="city">Kota/Kabupaten Domisili</label>
            <input type="text" name="city" id="city"
                   value="{{ old('city', $student->city ?? '') }}">

            <label for="email">Email</label>
            <input type="email" name="email" id="email"
                   value="{{ old('email', $student->email ?? '') }}">

            <label for="about">Tentang Saya</label>
            <textarea name="about" id="about">{{ old('about', $student->about ?? '') }}</textarea>

            <label for="phone">Telepon (62) <span style="color: red;">*</span></label>
            <input type="tel" name="phone" id="phone"
                   value="{{ old('phone', $student->phone ?? '') }}" required>

            <label for="birth_place">Tempat Lahir <span style="color: red;">*</span></label>
            <input type="text" name="birth_place" id="birth_place"
                   value="{{ old('birth_place', $student->birth_place ?? '') }}" required>

            <label for="birth_date">Tanggal Lahir <span style="color: red;">*</span></label>
            <input type="date" name="birth_date" id="birth_date"
                   value="{{ old('birth_date', $student->birth_date ?? '') }}" required>

            <button type="submit">Simpan</button>
        </form>
    </div>
</div>

{{-- Sertakan SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Preview gambar sebelum upload
    const photoInput = document.getElementById('photo-input');
    const previewPhoto = document.getElementById('preview-photo');

    photoInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewPhoto.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    // Tampilkan SweetAlert jika ada session 'success'
    @if(session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK',
            allowOutsideClick: false,
            allowEscapeKey: false
        });
    @endif
</script>
@endsection
