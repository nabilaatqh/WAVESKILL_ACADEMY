@extends('layouts.landing')
@section('title', 'Beranda')

@section('content')
<style>
    .hero {
        background-color: #44d9f7;
        padding: 4rem 2rem;
        color: white;
    }
    .btn-danger {
        background-color: #ff6f61;
        border: none;
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
</style>

{{-- Hero --}}
<section class="hero d-flex align-items-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="fw-bold mb-3">Selamat Datang, {{ Auth::guard('student')->user()->name ?? 'Student' }}!</h1>
                <p>Yuk, tingkatkan kemampuanmu dengan kursus berkualitas bersama <strong>WaveSkill Academy!</strong></p>
                <a href="{{ route('student.courses.index') }}" class="btn btn-danger mt-3">Beli Kursus Sekarang</a>
                <a href="{{ route('student.dashboard') }}" class="btn btn-success mt-3">Lihat Kelas Saya</a>
            </div>
            <div class="col-md-6 text-center">
                <img src="{{ asset('image/hero.png') }}" class="img-fluid" alt="Hero Illustration">
            </div>
        </div>
    </div>
</section>

{{-- FITUR KEUNGGULAN --}}
<section class="mt-5 pb-5" style="margin-top: 60px;">
    <div class="container">
        <div class="card shadow rounded-4 px-4 py-5" style="background-color: #ffffff; border: none;">
            <div class="row text-center justify-content-between align-items-stretch">
                {{-- Fitur 1 --}}
                <div class="col-6 col-md-4 col-lg-2 d-flex flex-column align-items-center mb-4 mb-lg-0">
                    <img src="{{ asset('image/fitur.png') }}" alt="Instruktur Berpengalaman" class="img-fluid mb-3" style="height: 90px;">
                    <h6 class="fw-bold">Instruktur Berpengalaman</h6>
                    <p class="small mb-0">WaveSkill Academy menghadirkan Instruktur yang ahli di bidangnya!</p>
                </div>

                {{-- Fitur 2 --}}
                <div class="col-6 col-md-4 col-lg-2 d-flex flex-column align-items-center mb-4 mb-lg-0">
                    <img src="{{ asset('image/fitur1.png') }}" alt="Akses di Mana Saja" class="img-fluid mb-3" style="height: 90px;">
                    <h6 class="fw-bold">Akses di Mana Saja</h6>
                    <p class="small mb-0">Seluruh materi WaveSkill Academy bisa diakses dari mana saja loh!</p>
                </div>

                {{-- Fitur 3 --}}
                <div class="col-6 col-md-4 col-lg-2 d-flex flex-column align-items-center mb-4 mb-lg-0">
                    <img src="{{ asset('image/fitur2.png') }}" alt="Koneksi" class="img-fluid mb-3" style="height: 90px;">
                    <h6 class="fw-bold">Koneksi di seluruh Indonesia</h6>
                    <p class="small mb-0">Berkenalan dengan pelajar dan instruktur dari seluruh Indonesia!</p>
                </div>

                {{-- Fitur 4 --}}
                <div class="col-6 col-md-4 col-lg-2 d-flex flex-column align-items-center mb-4 mb-lg-0">
                    <img src="{{ asset('image/fitur3.png') }}" alt="Sertifikat" class="img-fluid mb-3" style="height: 90px;">
                    <h6 class="fw-bold">Sertifikat Resmi</h6>
                    <p class="small mb-0">Kamu akan mendapatkan sertifikat resmi dari WaveSkill Academy</p>
                </div>

                {{-- Fitur 5 --}}
                <div class="col-6 col-md-4 col-lg-2 d-flex flex-column align-items-center">
                    <img src="{{ asset('image/fitur4.png') }}" alt="Biaya Murah" class="img-fluid mb-3" style="height: 90px;">
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
                <h2 class="fw-bold">Tentang Kami</h2>
                <p>WaveSkill Academy adalah platform pembelajaran daring untuk meningkatkan skill profesional. Kami menyediakan kursus berkualitas dengan pembimbing berpengalaman.</p>
                <a href="#" class="btn btn-danger">Mulai Belajar</a>
            </div>
            <div class="col-md-6 text-center">
                <img src="{{ asset('image/about.png') }}" class="img-fluid">
            </div>
        </div>
    </div>
</section>
@endsection
