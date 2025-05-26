@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h3 class="text-white mb-3">✏️ Edit Data User</h3>
    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-light mb-4">← Kembali ke Daftar User</a>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm rounded bg-white p-4">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" required value="{{ old('name', $user->name) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required value="{{ old('email', $user->email) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Password <small class="text-muted">(Opsional)</small></label>
                <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin diubah">
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-select" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="instructor" {{ old('role', $user->role) == 'instructor' ? 'selected' : '' }}>Instructor</option>
                    <option value="student" {{ old('role', $user->role) == 'student' ? 'selected' : '' }}>Student</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-select" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="1" {{ old('is_active', $user->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('is_active', $user->is_active) == '0' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">💾 Update User</button>
        </form>
    </div>
</div>
@endsection
