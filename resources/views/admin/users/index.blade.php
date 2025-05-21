@extends('layouts.admin')

@section('content')

<h3 style="color: white;">
    Halo Selamat Datang,<br>
    <strong>Admin : {{ Auth::guard('admin')->user()->name ?? '' }}</strong>
</h3>
<div class="mt-4">
    <h3 style="color : white;">📋 Manajemen User</h3>
</div>

@if(session('success'))
    <div class="alert alert-success mt-2">{{ session('success') }}</div>
@endif

<div class="mb-3 text-start">
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">➕ Tambah User</a>
</div>

<table class="table table-bordered table-hover">
    {{-- Baris khusus untuk tab filter --}}
    <thead>
        <tr style="background-color: white;">
            <th colspan="6">
                <h5 class="fw-bold mb-2" style="color: #FFA017;">Kelola User</h5>
                <div class="custom-tabs d-flex gap-3">
                    <a href="{{ route('admin.users.index', ['role' => 'admin']) }}"
                       class="tab-link {{ $role === 'admin' ? 'active' : '' }}">Admin</a>
                    <a href="{{ route('admin.users.index', ['role' => 'instructor']) }}"
                       class="tab-link {{ $role === 'instructor' ? 'active' : '' }}">Instructor</a>
                    <a href="{{ route('admin.users.index', ['role' => 'student']) }}"
                       class="tab-link {{ $role === 'student' ? 'active' : '' }}">Student</a>
                </div>
            </th>
        </tr>
        <tr class="thead-light">
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($users as $index => $user)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td class="align-middle">
                    @if($user->role === 'admin')
                        <span class="badge-role admin">Admin</span>
                    @elseif($user->role === 'instructor')
                        <span class="badge-role instructor">Instructor</span>
                    @elseif($user->role === 'student')
                        <span class="badge-role student">Student</span>
                    @endif
                </td>
                <td>
                    @if($user->is_active)
                        <span class="badge-status active">Aktif</span>
                    @else
                        <span class="badge-status nonactive">Nonaktif</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">✏️ Edit</a>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">🗑️ Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
