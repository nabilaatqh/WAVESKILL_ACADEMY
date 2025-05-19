@extends('layouts.instructor')
@section('title', 'Daftar Kelas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Daftar Kelas Kamu</h2>
    <a href="{{ route('instruktur.kelas.create') }}" class="btn btn-success" style="padding: 8px 16px; border-radius: 8px;">+ Tambah Kelas</a>
</div>

@if(session('success'))
    <div style="background-color: #d4edda; padding: 10px; border-radius: 6px; margin-bottom: 16px; color: #155724;">
        {{ session('success') }}
    </div>
@endif

@if($kelas->count())
    <div class="row" style="display: flex; flex-wrap: wrap; gap: 20px;">
        @foreach ($kelas as $item)
            <div class="class-card" style="flex: 1 1 calc(33.333% - 20px);">
                @if ($item->banner)
                    <img src="{{ asset('storage/' . $item->banner) }}" alt="Banner {{ $item->nama }}">
                @endif
                <h4>{{ $item->nama }}</h4>
                <p>{{ Str::limit($item->deskripsi, 100) }}</p>
                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('instruktur.kelas.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('instruktur.kelas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kelas ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p>Belum ada kelas yang kamu buat.</p>
@endif
@endsection
