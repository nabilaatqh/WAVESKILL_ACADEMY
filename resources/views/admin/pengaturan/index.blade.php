@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h3 style="color: white;">
        Halo Selamat Datang,<br>
        <strong>Admin : {{ Auth::guard('admin')->user()->name ?? '' }}</strong>
    </h3>

    <div class="mt-4">
        <h3 style="color : white;">⚙️ Pengaturan Akun</h3>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-start align-items-center gap-3 mb-5">

        <!-- Ubah Foto Profil -->
        <form action="{{ route('admin.updateFoto') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center gap-2">
            @csrf
            <input type="file" name="foto" accept="image/*" class="form-control" style="width: 200px;">
            <button type="submit" class="btn btn-primary">Ubah Foto</button>
        </form>

        <!-- Tombol Logout -->
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>

    <div class="card p-4">
        <div>
            <strong>Foto Saat Ini:</strong><br>
            <img src="{{ asset($admin->foto ?? 'images/admin/default.png') }}" alt="Foto Profil" class="rounded-circle mt-2" width="100" height="100">
        </div>
    </div>
</div>
@endsection
