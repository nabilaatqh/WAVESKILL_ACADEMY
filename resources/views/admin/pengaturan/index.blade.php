@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h3 class="text-white mb-4">
        Halo Selamat Datang,<br>
        <strong>Admin : {{ Auth::guard('admin')->user()->name ?? '' }}</strong>
    </h3>

    <div class="bg-white rounded shadow p-4 mb-4">
        <h4 class="mb-3">
            ⚙️ <strong>Pengaturan Akun</strong>
        </h4>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="d-flex flex-wrap align-items-center gap-3 mb-4">

            {{-- Upload Foto --}}
            <form action="{{ route('admin.updateFoto') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center gap-2 flex-wrap">
                @csrf
                <input type="file" name="foto" accept="image/*" class="form-control" style="max-width: 250px;">
                <button type="submit" class="btn btn-primary">Ubah Foto</button>
            </form>

            {{-- Logout --}}
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>

        <div class="d-flex align-items-center gap-4">
            <div>
                <strong>Foto Saat Ini:</strong>
                <div class="mt-2 border rounded-circle overflow-hidden" style="width: 100px; height: 100px;">
                    <img src="{{ asset($admin->foto ?? 'images/admin/default.png') }}" alt="Foto Profil" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
