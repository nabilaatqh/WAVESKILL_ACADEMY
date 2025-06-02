{{-- resources/views/student/course_cards.blade.php --}}
@extends('layouts.student')

@section('title', 'Daftar Course')

@section('content')
<div class="container py-4">
    <h3 class="text-white mb-4" style="color: rgb(255, 251, 251); text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">📚 Semua Group Course</h3>

    @if ($courses->isEmpty())
        <div class="alert alert-info bg-light text-dark">
            Belum ada course yang tersedia.
        </div>
    @else
        <div class="row">
            @foreach ($courses as $course)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm" style="border-radius: 12px; overflow: hidden;">
                        {{-- Banner penuh --}}
                        <img 
                            src="{{ asset('storage/' . $course->banner_image) }}" 
                            class="card-img-top" 
                            alt="Banner {{ $course->nama_course }}" 
                            style="object-fit: cover; height: 180px; width: 100%;"
                        >

                        {{-- Konten di bawah banner --}}
                        <div class="card-body" style="background-color: #ffb347;">
                            {{-- Judul Course --}}
                            <h5 class="card-title mb-1" style="color: rgb(255, 251, 251); text-shadow: 2px 2px 4px rgba(0,0,0,0.5);"">{{ $course->nama_course }}</h5>

                            {{-- Deskripsi singkat (maks. 60 karakter) --}}
                            <p style="font-size: 0.9rem; color: rgb(255, 251, 251); text-shadow: 2px 2px 4px rgba(0,0,0,0.5);"">
                                {{ \Illuminate\Support\Str::limit($course->deskripsi ?? 'Tidak ada deskripsi.', 60, '...') }}
                            </p>

                            {{-- Tombol Link WhatsApp --}}
                            @if ($course->whatsapp_link)
                                <a href="{{ $course->whatsapp_link }}" target="_blank" class="btn btn-sm btn-success px-3">
                                    <i class="fab fa-whatsapp me-1"></i> Gabung WA
                                </a>
                            @else
                                <button class="btn btn-sm btn-secondary px-3" disabled>
                                    WA Belum Tersedia
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- pagination, jika menggunakan paginate --}}
        @if(method_exists($courses, 'links'))
            <div class="d-flex justify-content-center mt-4">
                {{ $courses->links() }}
            </div>
        @endif
    @endif
</div>
@endsection
