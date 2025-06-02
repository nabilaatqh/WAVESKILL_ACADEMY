@extends('layouts.instruktur')

@section('title', 'Detail Project')

@section('content')
<div class="dashboard-wrapper">
    <div class="project-detail-card">

        {{-- Tombol Aksi --}}
        <div class="mb-3 d-flex gap-2">
            <a href="{{ route('instruktur.project.edit', $project->id) }}" class="btn btn-primary">
                ✏️ Edit
            </a>

            <form id="delete-project-form" action="{{ route('instruktur.project.destroy', $project->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="button" id="btn-delete-project" class="btn btn-danger">
                    🗑️ Hapus
                </button>
            </form>

            <a href="{{ route('instruktur.dashboard', ['course_id' => $project->course_id]) }}" class="btn btn-secondary ms-auto">
                ← Kembali ke Dashboard
            </a>
        </div>

        <h2>{{ $project->judul }}</h2>
        <p>{{ $project->deskripsi }}</p>

        @php
            $extension = pathinfo($project->file, PATHINFO_EXTENSION);
        @endphp

        @if($project->file)
            <div class="project-file mb-4" style="border-radius: 8px; overflow: hidden;">

                @if ($extension === 'pdf')
                    <iframe src="{{ asset('storage/' . $project->file) }}" width="100%" height="600px" style="border-radius: 8px; border: 1px solid #ccc;"></iframe>

                @elseif ($extension === 'mp4')
                    <video width="100%" height="auto" controls style="border-radius: 8px;">
                        <source src="{{ asset('storage/' . $project->file) }}" type="video/mp4">
                        Browser Anda tidak mendukung video.
                    </video>

                @else
                    <a href="{{ asset('storage/' . $project->file) }}" target="_blank" class="btn btn-primary mt-2">
                        📥 Lihat File Project
                    </a>
                @endif

            </div>
        @else
            <p class="text-muted">Project tidak tersedia atau belum diunggah.</p>
        @endif

    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('btn-delete-project').addEventListener('click', function () {
        Swal.fire({
            title: 'Yakin ingin menghapus project ini?',
            text: "Data project akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e74c3c',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-project-form').submit();
            }
        });
    });
</script>
@endpush
