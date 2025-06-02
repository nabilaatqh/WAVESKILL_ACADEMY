@extends('layouts.student')

@section('title', 'Edit Profil')

@section('content')
<style>
    .profile-wrapper {
        background-color: #5ED0F4;
        min-height: 90vh;
        padding: 40px 20px;
        display: flex;
        justify-content: center;
        align-items: flex-start;
    }

    .profile-card {
        background-color: white;
        border-radius: 12px;
        padding: 40px 48px;
        width: 100%;
        max-width: 600px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow-y: auto;
        max-height: 80vh;
    }

    .profile-card h2 {
        color: #008080;
        font-weight: 700;
        margin-bottom: 32px;
        text-align: center;
    }

    .profile-photo-wrapper {
        display: flex;
        justify-content: center;
        margin-bottom: 32px;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        overflow: hidden;
        cursor: pointer;
        border: 3px solid #008080;
        transition: 0.3s ease;
        margin-left: auto;
        margin-right: auto;
    }

    .profile-photo-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        transition: opacity 0.3s ease;
        display: block;
    }

    .profile-photo-wrapper:hover img {
        opacity: 0.8;
    }

    /* Hide the actual file input */
    #photo-input {
        display: none;
    }

    /* Input styles for rest of the form */
    label {
        font-weight: 600;
        color: #444;
        margin-bottom: 6px;
        display: block;
    }
    input[type="text"],
    input[type="email"],
    input[type="tel"],
    input[type="date"],
    textarea {
        width: 100%;
        border: 1.5px solid #d9b77b;
        border-radius: 6px;
        padding: 8px 12px;
        margin-bottom: 24px;
        font-size: 1rem;
        color: #555;
        font-family: 'Poppins', sans-serif;
        box-sizing: border-box;
    }
    textarea {
        resize: vertical;
        min-height: 80px;
    }
    button {
        background-color: #d86c6c;
        border: none;
        color: white;
        font-weight: 600;
        padding: 10px 28px;
        border-radius: 10px;
        cursor: pointer;
        display: block;
        margin: 0 auto;
        font-family: 'Poppins', sans-serif;
        transition: background-color 0.3s ease;
    }
    button:hover {
        background-color: #c05151;
    }
</style>

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
