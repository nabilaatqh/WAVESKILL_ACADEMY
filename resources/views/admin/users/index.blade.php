@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h3 class="text-white mb-4">
        Halo Selamat Datang,<br>
        <strong>Admin : {{ Auth::guard('admin')->user()->name ?? '' }}</strong>
    </h3>

    <div class="mb-3">
        <h4 class="text-white">📋 Manajemen User</h4>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">➕ Tambah User</a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white border-0">
            <h5 class="fw-bold mb-2" style="color: #FFA017;">Kelola User</h5>
            <div class="d-flex gap-3">
                <a href="{{ route('admin.users.index', ['role' => 'admin']) }}"
                   class="btn btn-sm {{ $role === 'admin' ? 'btn-warning' : 'btn-outline-secondary' }}">Admin</a>
                <a href="{{ route('admin.users.index', ['role' => 'instructor']) }}"
                   class="btn btn-sm {{ $role === 'instructor' ? 'btn-warning' : 'btn-outline-secondary' }}">Instructor</a>
                <a href="{{ route('admin.users.index', ['role' => 'student']) }}"
                   class="btn btn-sm {{ $role === 'student' ? 'btn-warning' : 'btn-outline-secondary' }}">Student</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                        <tr class="align-middle text-center">
                            <td>{{ $index + 1 }}</td>
                            <td class="text-start">{{ $user->name }}</td>
                            <td class="text-start">{{ $user->email }}</td>
                            <td>
                                <span class="badge 
                                    @if($user->role === 'admin') bg-primary
                                    @elseif($user->role === 'instructor') bg-success
                                    @elseif($user->role === 'student') bg-danger
                                    @else bg-secondary
                                    @endif">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td>
                                @if($user->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning" title="Edit User">✏️ Edit</a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" title="Hapus User">🗑️ Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data user.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
