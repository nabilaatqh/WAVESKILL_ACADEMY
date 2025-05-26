@extends('layouts.instruktur')

@section('title', 'Detail Submission')

@section('content')
<div class="dashboard-wrapper container-center">
    <h4 class="materi-subtitle mb-4">Detail Submission</h4>

    <div class="card bg-white p-4 mb-4">
        <h5 class="mb-2">Nama Mahasiswa:</h5>
        <p>{{ $submission->student->name }}</p>

        <h5 class="mt-3 mb-2">File Submission:</h5>
        <a href="{{ asset('storage/' . $submission->file) }}" target="_blank" class="btn btn-primary btn-sm">
            📥 Lihat File
        </a>

        <h5 class="mt-4 mb-2">Tanggal Submit:</h5>
        <p>{{ $submission->created_at->format('d M Y, H:i') }}</p>
    </div>

    <form action="{{ route('instruktur.submission.update', $submission->id) }}" method="POST" class="card bg-light p-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nilai" class="form-label">Nilai</label>
            <input type="number" name="nilai" id="nilai" class="form-control" value="{{ old('nilai', $submission->nilai) }}" min="0" max="100" required>
        </div>

        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan / Komentar</label>
            <textarea name="catatan" id="catatan" rows="3" class="form-control">{{ old('catatan', $submission->catatan) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">💾 Simpan Penilaian</button>
        <a href="{{ route('instruktur.submission.index', $submission->project_id) }}" class="btn btn-secondary">← Kembali</a>
    </form>
</div>
@endsection
