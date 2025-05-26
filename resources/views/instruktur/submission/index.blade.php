@extends('layouts.instruktur')

@section('title', 'Submission Project')

@section('content')
<div class="dashboard-wrapper container-center">

    <h4 class="materi-subtitle mb-3">Submission Project: {{ $project->judul }}</h4>

    {{-- Tombol Edit & Hapus --}}
    <div class="mb-3 d-flex gap-2">
        <button class="btn btn-sm btn-outline-warning" onclick="toggleEditForm()">✏️ Edit Project</button>

        <form action="{{ route('instruktur.project.destroy', $project->id) }}" method="POST" id="delete-form">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete()">🗑️ Hapus Project</button>
        </form>
    </div>

    {{-- Form Edit --}}
    <div id="edit-form" style="display: none;" class="mt-3 p-3 border rounded bg-light mb-4">
        <form method="POST" action="{{ route('instruktur.project.update', $project->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-2">
                <label for="judul" class="form-label">Judul Project</label>
                <input type="text" id="judul" name="judul" value="{{ $project->judul }}" class="form-control" required>
            </div>

            <div class="mb-2">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="3" class="form-control">{{ $project->deskripsi }}</textarea>
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">File Project (Opsional)</label>
                <input type="file" id="file" name="file" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>

    {{-- Tabel Submission --}}
    @if($submissions->isEmpty())
        <p class="text-white">Belum ada submission dari mahasiswa.</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered bg-white">
                <thead class="table-warning">
                    <tr>
                        <th>#</th>
                        <th>Nama Mahasiswa</th>
                        <th>File</th>
                        <th>Nilai</th>
                        <th>Catatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($submissions as $index => $submission)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $submission->student->name }}</td>
                        <td>
                            <a href="{{ asset('storage/' . $submission->file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                📥 Lihat File
                            </a>
                        </td>
                        <td>{{ $submission->nilai ?? '-' }}</td>
                        <td>{{ $submission->catatan ?? '-' }}</td>
                        <td>
                            <a href="{{ route('instruktur.submission.show', $submission->id) }}" class="btn btn-sm btn-warning">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@push('scripts')
<script>
    function toggleEditForm() {
        const form = document.getElementById('edit-form');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }

    function confirmDelete() {
        Swal.fire({
            title: 'Yakin ingin menghapus project ini?',
            text: "Tindakan ini akan menghapus semua submission dari mahasiswa!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e74c3c',
            cancelButtonColor: '#aaa',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form').submit();
            }
        });
    }
</script>
@endpush
@endsection
