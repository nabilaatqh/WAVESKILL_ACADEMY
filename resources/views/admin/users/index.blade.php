@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>📋 Manajemen User</h3>
        <form action="{{ route('admin.logout') }}" method="POST" onsubmit="return confirm('Keluar dari akun admin?')">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm">🚪 Logout</button>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    <div class="mb-3 text-end">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">➕ Tambah User</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td><span class="badge bg-info text-white">{{ ucfirst($user['role']) }}</span></td>
                <td>
                    <a href="{{ route('admin.users.edit', ['role' => $user['role'], 'id' => $user['id']]) }}" class="btn btn-sm btn-warning">✏️ Edit</a>

                    <form action="{{ route('admin.users.destroy', ['role' => $user['role'], 'id' => $user['id']]) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">🗑️ Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
