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

        @if($project->tipe === 'pdf' && $project->file)
            <div class="project-file">
                <iframe src="{{ asset('storage/' . $project->file) }}" width="100%" height="600px" frameborder="0"></iframe>
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
