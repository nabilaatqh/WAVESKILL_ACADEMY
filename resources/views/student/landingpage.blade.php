@extends('layouts.landing')
@section('title', 'Beranda')

@section('content')
<link rel="stylesheet" href="{{ asset('frontsite/student/landingpage.css') }}">

{{-- Hero --}}
<section class="hero d-flex align-items-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="fw-bold mb-3" style="color:#FFFA8D; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                    Selamat Datang,
                    <span style="color: rgb(255, 251, 251); text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                        {{ Auth::guard('student')->user()->name ?? 'Student' }}!
                    </span>
                </h1>
                <h4 style="text-shadow: 1px 1px 3px rgba(0,0,0,0.4);">
                    Yuk, tingkatkan kemampuanmu dengan kursus berkualitas bersama <strong>WaveSkill Academy!</strong>
                </h4>
                <p style="font-size: 14px; color: #FFFA8D; margin-bottom: 15px; text-shadow: 1px 1px 2px rgba(0,0,0,0.5);">
                    Mulai belajar dengan biaya murah dan akses belajar <br>
                    dimana saja dan kapan saja dengan WaveSkill Academy
                </p>
                <a href="{{ route('student.courses.index') }}" class="btn btn-danger btn-shadow mt-3">
                    Beli Kursus Sekarang
                </a>
                <a href="{{ route('student.dashboard') }}" class="btn btn-success btn-shadow mt-3 ms-2">
                    Lihat Kelas Saya
                </a>
            </div>
            <div class="col-md-6 text-center" >
                <img src="{{ asset('image/hero.gif') }}" class="img-fluid" alt="Hero Illustration">
            </div>
        </div>
    </div>
</section>

{{-- FITUR KEUNGGULAN --}}
<section class="fitur-wrapper">
    <div class="container">
        <div class="card fitur-card">
            <div class="row text-center justify-content-between align-items-stretch">
                {{-- Fitur 1 --}}
                <div class="col-6 col-md-4 col-lg-2 d-flex flex-column align-items-center mb-4 mb-lg-0">
                    <img src="{{ asset('image/fitur.png') }}" alt="Instruktur Berpengalaman" class="img-fluid mb-3" style="height: 120px;">
                    <h6 class="fw-bold">Instruktur Berpengalaman</h6>
                    <p class="small mb-0">WaveSkill Academy menghadirkan Instruktur yang ahli di bidangnya!</p>
                </div>
                {{-- Fitur 2 --}}
                <div class="col-6 col-md-4 col-lg-2 d-flex flex-column align-items-center mb-4 mb-lg-0">
                    <img src="{{ asset('image/fitur1.png') }}" alt="Akses di Mana Saja" class="img-fluid mb-3" style="height: 120px;">
                    <h6 class="fw-bold">Akses di Mana Saja</h6>
                    <p class="small mb-0">Seluruh materi WaveSkill Academy bisa diakses dari mana saja loh!</p>
                </div>
                {{-- Fitur 3 --}}
                <div class="col-6 col-md-4 col-lg-2 d-flex flex-column align-items-center mb-4 mb-lg-0">
                    <img src="{{ asset('image/fitur2.png') }}" alt="Koneksi" class="img-fluid mb-3" style="height: 120px;">
                    <h6 class="fw-bold">Koneksi di seluruh Indonesia</h6>
                    <p class="small mb-0">Berkenalan dengan pelajar dan instruktur dari seluruh Indonesia!</p>
                </div>
                {{-- Fitur 4 --}}
                <div class="col-6 col-md-4 col-lg-2 d-flex flex-column align-items-center mb-4 mb-lg-0">
                    <img src="{{ asset('image/fitur3.png') }}" alt="Sertifikat" class="img-fluid mb-3" style="height: 120px;">
                    <h6 class="fw-bold">Sertifikat Resmi</h6>
                    <p class="small mb-0">Kamu akan mendapatkan sertifikat resmi dari WaveSkill Academy</p>
                </div>
                {{-- Fitur 5 --}}
                <div class="col-6 col-md-4 col-lg-2 d-flex flex-column align-items-center">
                    <img src="{{ asset('image/fitur4.png') }}" alt="Biaya Murah" class="img-fluid mb-3" style="height: 120px;">
                    <h6 class="fw-bold">Biaya Murah</h6>
                    <p class="small mb-0">Akses banyak materi, tapi dengan biaya yang minim!</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ================= KURSUS POPULER ================= --}}
<section class="populer-section">
    <div class="container">
        {{-- Judul & Subteks --}}
        <h2 class="text-center mb-1">Cari Kursus Populer Kami</h2>
        <p class="text-center subtext">
            Temukan berbagai macam kursus sesuai dengan keinginanmu di sini!
        </p>

        {{-- Grid responsif: 1 kolom HP, 2 kolom tablet, 3 kolom desktop --}}
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @php
                $popularSix = $courses->take(9);
            @endphp

            @forelse($popularSix as $course)
                <div class="col">
                    <div class="populer-card h-100 d-flex flex-column">
                        {{-- 1) Gambar Banner --}}
                        <div class="populer-img-wrapper">
                            <img
                                src="{{ 
                                    $course->banner_image 
                                        ? asset('storage/' . $course->banner_image) 
                                        : asset('image/default-course.png') 
                                }}"
                                class="img-fluid">
                        </div>

                        <div class="populer-body d-flex flex-column">
                            {{-- Judul Course --}}
                            <h5>{{ $course->nama_course }}</h5>

                            {{-- Deskripsi singkat (maks. 60 karakter) --}}
                            @if(!empty($course->deskripsi))
                                <p class="desc">
                                    {{ \Illuminate\Support\Str::limit($course->deskripsi, 60, '...') }}
                                </p>
                            @else
                                <p class="desc">
                                    Belum ada deskripsi.
                                </p>
                            @endif

                            {{-- Jumlah peserta --}}
                            <small class="peserta">
                                {{ $course->students->count() ?? '0' }} Peserta
                            </small>

                            <div class="populer-footer">
                                <a 
                                    href="{{ route('student.courses.detail', $course->id) }}"
                                    class="price-button">
                                    Rp {{ number_format($course->harga ?? 0, 0, ',', '.') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                {{-- Jika tidak ada course --}}
                <div class="col-12 text-center text-muted">
                    <p>Belum ada course tersedia saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- Tentang Kami --}}
<section class="py-5" style="background-color: #ffb347;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="fw-bold" style="color:#ffffff; text-shadow: 1px 1px 3px rgba(0,0,0,0.4);">Tentang Kami</h2>
                <h5>WaveSkill Academy adalah platform pembelajaran daring untuk meningkatkan skill profesional. Kami menyediakan kursus berkualitas dengan pembimbing berpengalaman.</h5>
                <br>
                <h5>Bersama <b>WaveSkill Academy</b>, kita siap mengikuti ombak pengetahuan dan berselancar dilautan ilmu yang luas!</h5>
                <br>
                <h5>Ayo tunggu apa lagi? Daftarkan dirimu Sekarang juga di <b>WaveSkill!</b></h5>
                <a href="#" class="btn btn-danger btn-shadow mt-3">Mulai Belajar</a>
            </div>
            <div class="col-md-6 text-center">
                <img src="{{ asset('image/about.png') }}" class="img-fluid">
            </div>
        </div>
    </div>
</section>

{{-- Tambahkan SweetAlert bila session('success') ada --}}
@if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK',
            allowOutsideClick: false,
            allowEscapeKey: false
        });
    </script>
@endif

@endsection
