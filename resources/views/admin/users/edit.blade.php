@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>✏️ Edit User</h3>

    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-secondary mb-3">← Kembali ke Daftar User</a>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.update', ['role' => $role, 'id' => $user->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $user->name) }}">
        </div>

        <div class="form-group mt-2">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email', $user->email) }}">
        </div>

        <button type="submit" class="btn btn-success mt-3">Perbarui</button>
    </form>
</div>
@endsection
