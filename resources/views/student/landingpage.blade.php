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


{{-- Kursus Populer --}}
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title text-center mb-4">Cari Kursus Populer Kami</h2>
        <div class="row g-4">
            @foreach ($courses as $course)
            <div class="col-md-3">
                <div class="course-card text-center">
                    <img src="{{ asset('image/bobo.png')}}" class="img-fluid mb-2" style="height: 160px; object-fit: cover;">
                    <h6>{{ $course['title'] }}</h6>
                    <small class="text-danger">{{ $course['price'] }}</small>
                </div> 
            </div>
            @endforeach
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
