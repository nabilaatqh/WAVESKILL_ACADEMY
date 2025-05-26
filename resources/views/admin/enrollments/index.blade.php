@extends('layouts.admin')

@section('title', 'Verifikasi Enrollment')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">📄 Daftar Pembayaran Masuk</h4>

    <form method="GET" action="{{ route('admin.enrollments.index') }}" class="mb-3 d-flex align-items-center gap-2">
        <label for="status" class="form-label mb-0 fw-bold">Filter Status:</label>
        <select name="status" id="status" class="form-select w-auto" onchange="this.form.submit()">
            <option value="">-- Semua --</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
        </select>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Nama Siswa</th>
                <th>Kursus</th>
                <th>Bukti</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $hasPending = false; @endphp

            @foreach($enrollments as $enrollment)
                @if($enrollment->status === 'pending')
                    @php $hasPending = true; @endphp
                    <tr>
                        <td>{{ $enrollment->student->name }}</td>
                        <td>{{ $enrollment->course->title ?? $enrollment->course->nama_course ?? '-' }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $enrollment->bukti_transfer) }}" style="max-height: 100px;" class="img-thumbnail">
                        </td>
                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                        <td>
                            <form action="{{ route('admin.enrollments.approve', $enrollment->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button class="btn btn-success btn-sm" onclick="return confirm('Yakin setujui pembayaran ini?')">Setujui</button>
                            </form>
                            <form action="{{ route('admin.enrollments.reject', $enrollment->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin tolak pembayaran ini?')">Tolak</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach

            @if(!$hasPending)
                <tr>
                    <td colspan="5" class="text-center text-muted">Tidak ada pembayaran pending.</td>
                </tr>
            @endif
        </tbody>
    </table>

    {{ $enrollments->links() }}

    <hr class="my-4">

    <h5>📜 Histori Verifikasi</h5>
    @php $hasHistory = false; @endphp
    <ul class="list-group">
        @foreach($enrollments as $e)
            @if($e->status != 'pending')
                @php $hasHistory = true; @endphp
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        {{ $e->student->name }} - <strong>{{ $e->course->title ?? $e->course->nama_course }}</strong>
                        <br>
                        <small>Status: 
                            <strong class="text-{{ $e->status == 'approved' ? 'success' : 'danger' }}">
                                {{ ucfirst($e->status) }}
                            </strong>
                        </small>
                    </div>
                    <img src="{{ asset('storage/' . $e->bukti_transfer) }}" style="max-height: 50px;" class="img-thumbnail">
                </li>
            @endif
        @endforeach

        @if(!$hasHistory)
            <li class="list-group-item text-muted text-center">Belum ada histori verifikasi.</li>
        @endif
    </ul>
</div>
@endsection
