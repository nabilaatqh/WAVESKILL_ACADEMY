@extends('layouts.admin')

@section('content')
<div class="mt-4">
    <h3>✏️ Edit Data User</h3>

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

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
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

        <div class="form-group mt-2">
            <label>Password (Opsional)</label>
            <input type="password" name="password" class="form-control">
            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
        </div>

        <div class="form-group mt-2">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="instructor" {{ old('role', $user->role) == 'instructor' ? 'selected' : '' }}>Instructor</option>
                <option value="student" {{ old('role', $user->role) == 'student' ? 'selected' : '' }}>Student</option>
            </select>
        </div>

        <div class="form-group mt-2">
            <label>Status</label>
            <select name="is_active" class="form-control" required>
                <option value="">-- Pilih Status --</option>
                <option value="1" {{ old('is_active', $user->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ old('is_active', $user->is_active) == '0' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
