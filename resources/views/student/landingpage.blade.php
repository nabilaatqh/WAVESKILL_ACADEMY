@extends('layouts.landing')
@section('title', 'Beranda')

@section('content')
<style>

    .hero {
    background-color: #44d9f7;
    padding: 2.5rem 2rem 3.5rem; /* bottom diperbesar */
    color: white;
    position: relative;
    z-index: 1;
    }

    .hero img {
    max-width: 100%;
    height: auto;
    margin-top: -30px; /* naikkan gambar */
    }

    .section-title {
        font-weight: bold;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }
    .course-card {
        border: 1px solid #eee;
        border-radius: 10px;
        padding: 1rem;
        transition: 0.3s;
        background: white;
    }
    .course-card:hover {
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    .footer-cta {
        background-color: #44d9f7;
        padding: 3rem 2rem;
        text-align: center;
    }

    .footer-cta h4 {
        color: white;   
        font-weight: bold;
    }
    .btn-shadow {
        box-shadow: 0 4px 0 #b33939;
        transition: all 0.15s ease-in-out;
        border-radius: 10px;
    }

    .btn-shadow:active {
        transform: translateY(2px);
        box-shadow: 0 2px 0 #b33939;
    }

    .btn-success.btn-shadow {
        box-shadow: 0 4px 0 #276749;
    }

    .btn-success.btn-shadow:active {
        transform: translateY(2px);
        box-shadow: 0 2px 0 #276749;
    }
    .fitur-wrapper {
        position: relative;
        z-index: 10;
        margin-top: -100px; 
    }

    .fitur-card {
        background-color: #ffffff;
        border: none;
        border-radius: 1rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        padding: 2rem 1rem;
    }   
    /* ================= KURSUS POPULER ================= */
    .populer-section {
        background-color: #ffffff;
        padding-top: 2rem;
        padding-bottom: 2rem;
    }
    .populer-section h2 {
        font-weight: bold;
        font-size: 1.75rem;
    }
    .populer-section p.subtext {
        color: #d96c6c;
        margin-bottom: 1.5rem;
        font-size: 1rem;
    }

    /* Outer card berwarna kuning, membulat, dan memiliki shadow halus */
    .populer-card {
    background-color: #ffe569;           /* kuning */
    border-radius: 0.75rem;
    overflow: hidden;
    /* Tambahkan dua lapis bayangan: 
       1) bayangan lembut yang lebih besar (spread 15px, blur 30px), 
       2) bayangan halus yang lebih kecil */
    box-shadow: 
        0 8px 30px rgba(0, 0, 0, 0.08),
        0 2px 6px rgba(0, 0, 0, 0.04);
    transition: transform 0.2s, box-shadow 0.2s;
    display: flex;
    flex-direction: column;
    height: 100%;
    }

    .populer-card:hover {
    transform: translateY(-4px);
    /* Saat hover, kita tingkatkan bayangan agar lebih menonjol */
    box-shadow: 
        0 12px 40px rgba(0, 0, 0, 0.12),
        0 4px 10px rgba(0, 0, 0, 0.06);
    }


    /* Wrapper gambar agar su   dut atas ikut membulat */
    .populer-img-wrapper {
        height: 180px;
        overflow: hidden;
        border-top-left-radius: 0.75rem;
        border-top-right-radius: 0.75rem;
    }
    .populer-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Badan kartu (teks, deskripsi, peserta, dan tombol harga) */
    .populer-body {
        padding: 0.75rem 0.75rem 1rem 0.75rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    .populer-body h5 {
        font-weight: 600;
        margin-bottom: 0.25rem;
        font-size: 1.05rem;
        color: #1F1F1F;
    }
    .populer-body p.desc {
        margin-bottom: 0.75rem;
        color: #333333;
        flex-grow: 1;
        font-size: 0.9rem;
        line-height: 1.3;
    }
    .populer-body small.peserta {
        font-size: 0.85rem;
        color: #555555;
        margin-bottom: 0.5rem;
        display: block;
    }

    /* Tombol harga: model “pill” berwarna merah muda/darkPink (#f26d6d) */
    .populer-body .price-button {
        background-color: #f26d6d;   /* pink/dark red */
        color: white;
        font-weight: 600;
        padding: 0.35rem 0.75rem;
        border-radius: 0.5rem;
        font-size: 0.9rem;
        text-decoration: none;
        text-align: center;
        white-space: nowrap;
        transition: background-color 0.15s, transform 0.15s;
    }
    .populer-body .price-button:hover {
        background-color: #d4525b;
    }

    .populer-body .price-button:active {
        transform: translateY(2px);
    }

    /* Pastikan tombol harga ada di baris yang sama dengan jumlah peserta */
    .populer-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
    }

    /* Responsif: tombol harga menjadi penuh lebar pada layar sempit */
    @media (max-width: 576px) {
        .populer-footer .price-button {
            width: 100%;
        }
    }
</style>

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
                $popularSix = $courses->take(6);
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
@endsection
