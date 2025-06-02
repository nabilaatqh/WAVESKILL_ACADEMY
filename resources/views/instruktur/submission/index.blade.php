@extends('layouts.instruktur')

@section('title', 'Submission Project')

@section('content')
<div class="dashboard-wrapper">
    <div class="materi-detail-card" style="max-width: 1200px; width: 95%; margin: auto; padding: 30px; background: #fff; border-radius: 16px; box-shadow: 0 8px 16px rgba(0,0,0,0.08);">

        <h2 class="materi-title" style="font-weight: 700; margin-bottom: 12px; color: #333;">{{ $project->judul }}</h2>
        <p class="materi-deskripsi" style="color: #555; margin-bottom: 24px; font-size: 1rem;">{{ $project->deskripsi }}</p>

        @php
            $ext = pathinfo($project->file, PATHINFO_EXTENSION);
        @endphp

        @if($ext === 'pdf')
            <div class="materi-file" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden; margin-bottom: 30px;">
                <iframe src="{{ asset('storage/' . $project->file) }}" width="100%" height="600px" frameborder="0"></iframe>
            </div>
        @elseif($ext === 'mp4')
            <div class="materi-file" style="border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                <video width="100%" height="auto" controls style="display: block; border-radius: 8px;">
                    <source src="{{ asset('storage/' . $project->file) }}" type="video/mp4">
                    Browser Anda tidak mendukung tag video.
                </video>
            </div>
        @elseif($ext && $project->file)
            <div class="materi-link mb-4">
                <a href="{{ asset('storage/' . $project->file) }}" target="_blank" rel="noopener noreferrer" style="color: #F68B1F; font-weight: 600; font-size: 1.1rem;">
                    📥 Klik untuk unduh file project →
                </a>
            </div>
        @else
            <p class="text-muted">File project belum tersedia.</p>
        @endif

       

        
         <form action="{{ route('instruktur.project.edit',  $project->id) }}" method="GET" style="display:inline;">
            <button type="submit"
                    class="btn"
                    style="background-color: #FFA500; color: white; font-weight: 600; padding: 10px 20px; border-radius: 8px;">
                ✏ Edit
            </button>
        </form>

    <!-- Tombol Hapus -->
    <form id="delete-project-form" action="{{ route('instruktur.project.destroy',  $project->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="button" onclick="confirmDelete()" 
                class="btn d-flex align-items-center"
                style="background-color: #dc3545; color: white; font-weight: 600; padding: 8px 16px; border-radius: 8px;">
            🗑 Hapus
        </button>
    </form>

    <!-- Tombol Kembali -->
    <form action="{{ route('instruktur.dashboard', ['course_id' =>  $project->course_id]) }}" method="GET" style="display:inline;">
        <button type="submit"
                class="btn"
                style="background-color: #008CBA; color: white; font-weight: 600; padding: 10px 20px; border-radius: 8px;">
            ← Kembali ke Dashboard
        </button>
    </form>
</div>

        

        

        <!-- Form Edit -->
        <div id="edit-form" style="display: none;" class="mt-3 p-3 border rounded bg-light mb-4">
            <form method="POST" action="{{ route('instruktur.project.update', $project->id) }}" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="mb-2">
                    <label class="form-label">Judul Project</label>
                    <input type="text" name="judul" value="{{ $project->judul }}" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="form-control">{{ $project->deskripsi }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Unggah File Baru (Opsional)</label>
                    <input type="file" name="file" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>

        <!-- Tabel Submission Mahasiswa -->
        <div class="table-responsive">
            <h5 class="mt-4 mb-3" style="color: #333;">Submission Mahasiswa:</h5>

            @if($submissions->isEmpty())
                <p class="text-muted">Belum ada submission dari mahasiswa.</p>
            @else
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
            @endif
        </div>
    </div>
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
