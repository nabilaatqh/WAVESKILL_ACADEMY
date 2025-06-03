@extends('layouts.student')

@section('title', 'Detail Materi')

@section('content')
<div class="dashboard-wrapper container-center" 
     style="max-width: 1140px; margin: 40px auto; padding: 30px; background: #FFFFFF; border-radius: 16px; box-shadow: 0 8px 16px rgba(0,0,0,0.08);">
    
    <!-- Judul Materi -->
    <h2 style="font-weight: 700; color: #333333; margin-bottom: 20px;">
        {{ $materi->judul }}
    </h2>

    <!-- Deskripsi Materi -->
    <p style="color: #555555; margin-bottom: 30px;">
        {{ $materi->deskripsi }}
    </p>

    <!-- Tampilkan Konten Materi Berdasarkan Tipe -->
    @if($materi->tipe === 'pdf' && $materi->file)
        <div style="border: 1px solid #DDDDDD; border-radius: 8px; overflow: hidden; margin-bottom: 30px;">
            <iframe 
                src="{{ asset('storage/' . $materi->file) }}" 
                width="100%" 
                height="600px" 
                frameborder="0"
            ></iframe>
        </div>

    @elseif($materi->tipe === 'video' && $materi->file)
        <div style="border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.1); margin-bottom: 30px;">
            <video 
                width="100%" 
                height="auto" 
                controls 
                style="display: block; border-radius: 8px;"
            >
                <source src="{{ asset('storage/' . $materi->file) }}" type="video/mp4">
                Browser Anda tidak mendukung tag video.
            </video>
        </div>

    @elseif($materi->tipe === 'link' && $materi->file)
        <div style="margin-bottom: 30px;">
            <a 
                href="{{ $materi->file }}" 
                target="_blank" 
                style="color: #FFA017; font-weight: 600; font-size: 1.1rem; text-decoration: none;"
            >
                Klik untuk membuka link materi &rarr;
            </a>
        </div>

    @else
        <p style="color: #888888; margin-bottom: 30px;">
            Materi tidak tersedia atau belum diunggah.
        </p>
    @endif

    <!-- Tombol Kembali ke Daftar Materi -->
    <div style="margin-top: 20px;">
        <a 
            href="{{ route('student.dashboard', ['course_id' => $materi->course_id]) }}" 
            style="background: #008CBA; color: #FFFFFF; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600;"
        >
            ← Kembali ke Materi
        </a>
    </div>
</div>
@endsection
