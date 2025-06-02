@extends('layouts.instruktur')

@section('title', 'Detail Materi')

@section('content')
<div class="dashboard-wrapper">
    <div class="materi-detail-card" style="max-width: 1140px; width: 95%; margin: auto; padding: 30px; background: #fff; border-radius: 16px; box-shadow: 0 8px 16px rgba(0,0,0,0.08);">

        <h2 class="materi-title" style="font-weight: 700; margin-bottom: 12px; color: #333;">{{ $materi->judul }}</h2>
        <p class="materi-deskripsi" style="color: #555; margin-bottom: 24px; font-size: 1rem;">{{ $materi->deskripsi }}</p>

        @if($materi->tipe === 'pdf' && $materi->file)
    <div class="materi-file" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden; margin-bottom: 30px;">
       <iframe src="{{ asset('storage/' . $materi->file) }}" width="100%" height="600px" frameborder="0"></iframe>
    </div>

        @elseif($materi->tipe === 'video' && $materi->file)
            <div class="materi-file" style="border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                <video width="100%" height="auto" controls style="display: block; border-radius: 8px;">
                    <source src="{{ asset('storage/' . $materi->file) }}" type="video/mp4">
                    Browser Anda tidak mendukung tag video.
                </video>
            </div>
        @elseif($materi->tipe === 'link' && $materi->file)
            <div class="materi-link" style="margin-top: 10px;">
                <a href="{{ $materi->file }}" target="_blank" rel="noopener noreferrer" style="color: #F68B1F; font-weight: 600; font-size: 1.1rem;">
                    Klik untuk membuka link materi &rarr;
                </a>
            </div>
        @else
            <p class="text-muted" style="color: #888; margin-top: 10px;">Materi tidak tersedia atau belum diunggah.</p>
        @endif
        
 <div class="action-buttons mb-4 d-flex flex-wrap gap-3 align-items-center">
     <!-- Tombol Edit -->
        <form action="{{ route('instruktur.materi.edit', $materi->id) }}" method="GET" style="display:inline;">
            <button type="submit"
                    class="btn"
                    style="background-color: #FFA500; color: white; font-weight: 600; padding: 10px 20px; border-radius: 8px;">
                ✏ Edit
            </button>
        </form>

    <!-- Tombol Hapus -->
    <form id="delete-materi-form" action="{{ route('instruktur.materi.destroy', $materi->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="button" id="btn-delete-materi" 
                class="btn d-flex align-items-center"
                style="background-color: #dc3545; color: white; font-weight: 600; padding: 8px 16px; border-radius: 8px;">
            🗑 Hapus
        </button>
    </form>

    <!-- Tombol Kembali -->
    <form action="{{ route('instruktur.dashboard', ['course_id' => $materi->course_id]) }}" method="GET" style="display:inline;">
        <button type="submit"
                class="btn"
                style="background-color: #008CBA; color: white; font-weight: 600; padding: 10px 20px; border-radius: 8px;">
            ← Kembali ke Dashboard
        </button>
    </form>
</div>




@push('scripts')
<script>
    document.getElementById('btn-delete-materi').addEventListener('click', function () {
        Swal.fire({
            title: 'Yakin ingin menghapus materi ini?',
            text: "Data materi akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e74c3c',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-materi-form').submit();
            }
        });
    });
</script>
@endpush
@endsection