@extends('layouts.instruktur')

@section('title', 'Edit Profil Instruktur')
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">

@section('content')

<div class="center-container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="profile-card" style="
        background: white;
        padding: 40px 40px 80px 40px;
        border-radius: 16px;
        max-width: 700px;
        width: 100%;
        min-height: 700px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        
">
        

        <h3 class="text-center mb-4" style=" font-size: 28px; margin-bottom: 20px;">Profile Akun</h3>

        @if(session('success'))
     <script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#3085d6'
        });
    @endif
</script>
        @endif

        @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}'
            });
        </script>
        @endif



        <form action="{{ route('instruktur.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

          {{-- Foto Profil --}}
<div class="text-center mb-4">
    <label for="foto-upload" style="cursor: pointer;">
        @php
            $fotoPath = $instruktur->foto;
            $fotoUrl = $fotoPath 
                ? asset('storage/' . $fotoPath)
                : 'https://ui-avatars.com/api/?name=' . urlencode($instruktur->nama_awal . ' ' . $instruktur->nama_akhir);
        @endphp

        <img src="{{ $fotoUrl }}"
             alt="Foto Profil"
             id="preview-foto"
             style="width: 200px; height: 200px; border-radius: 50%; border: 3px solid #FFB347; margin: 0 auto 30px auto; display: block;">
    </label>
    

    <input type="file" name="foto" id="foto-upload" style="display: none;" onchange="previewImage(this)">
</div>


        <div class="form-group" style="margin-bottom: 20px;">
            <label>Nama Awal <span style="color: red;">*</span></label>
            <input type="text" name="nama_awal" value="{{ old('nama_awal', $instruktur->nama_awal) }}" class="form-control" required>
            @error('nama_awal') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
            <label>Nama Akhir</label>
            <input type="text" name="nama_akhir" value="{{ old('nama_akhir', $instruktur->nama_akhir) }}" class="form-control">
            @error('nama_akhir') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
            <label>Kota/Kabupaten Domisili</label>
            <input type="text" name="domisili" value="{{ old('domisili', $instruktur->domisili) }}" class="form-control">
            @error('domisili') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $instruktur->email) }}" class="form-control" required>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
            <label>Tentang Saya</label>
            <textarea name="tentang_saya" class="form-control" rows="4">{{ old('tentang_saya', $instruktur->tentang_saya) }}</textarea>
            @error('tentang_saya') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
            <label>Telepon (+62) <span style="color: red;">*</span></label>
            <input type="text" name="telepon" value="{{ old('telepon', $instruktur->telepon) }}" class="form-control" required>
            @error('telepon') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
            <label>Tempat Lahir <span style="color: red;">*</span></label>
            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $instruktur->tempat_lahir) }}" class="form-control" required>
            @error('tempat_lahir') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
            <label>Tanggal Lahir <span style="color: red;">*</span></label>
            <input type="date" name="tanggal_lahir"
                value="{{ old('tanggal_lahir', optional($instruktur->tanggal_lahir)->format('Y-m-d')) }}"
                class="form-control" required>
            @error('tanggal_lahir') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-danger">Simpan</button>

        <script>
    function previewImage(input) {
        const preview = document.getElementById('preview-foto');
        const file = input.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }
</script>
    </form>
</div>

@endsection
