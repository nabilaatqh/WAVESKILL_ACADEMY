<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WaveSkill Academy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Styling umum tetap ada */
body {
    font-family: 'Segoe UI', sans-serif;
    background-color: #ffffff;
    color: #333;
    }
    .navbar {
        background-color: #ffb347;
    }
    .hero {
        background-color: #44d9f7;
        padding: 4rem 2rem;
        color: white;
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

    /* CSS Footer yang diperbarui sesuai gambar */
    .footer-cta {
        padding: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
    }

    .cta-container {
        background-color: #42d3ea;
        padding: 30px 20px;
        border-radius: 18px;
        text-align: center;
        max-width: 600px;
        width: 100%;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .footer-cta h4 {
        color: white;
        font-size: 1.4rem;
        font-weight: 500;
        margin-bottom: 20px;
        line-height: 1.4;
        text-align: center;
    }

    .footer-cta strong {
        font-weight: 600;
    }

    .cta-buttons {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 15px;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 500;
        text-decoration: none;
        font-size: 1rem;
        transition: all 0.3s ease;
        border: none;
        min-width: 160px;
    }

    /* Tombol register sekarang */
    .btn-danger {
        background-color: #f26d6d;
        border: none;
        color: white;
    }

    .btn-danger:hover {
        background-color: #e85c5c;
    }

    /* Tombol sudah punya akun */
    .btn-light {
        background-color: #ffe569;
        color: #f26d6d;
        border: none;
    }

    .btn-light:hover {
        background-color: #ffd649;
    }

    /* Responsivitas untuk layar kecil */
    @media (max-width: 576px) {
        .cta-buttons {
            flex-direction: column;
            align-items: center;
        }
        
        .btn {
            width: 100%;
            margin-bottom: 10px;
        }
    }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light px-4">
        <a class="navbar-brand fw-bold" href="#">WaveSkill</a>
        <div class="ms-auto">
            <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
            <a href="{{ route('student.register') }}" class="btn btn-light">Daftar</a>
        </div>
    </nav>

   {{-- Hero --}}
    <section class="hero d-flex align-items-center" style="background-color: #4AC7F5; min-height: 300px;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-white">
                    <p style="font-size: 12px; font-weight: 600; color: #FFFA8D;">Sarana Belajar Online Course Terpercaya</p>
                    <h2 class="fw-bold" style="font-size: 24px; margin-top: 0; margin-bottom: 10px;">
                        Tingkatkan Kemampuan mu, dan <br>ikuti ombak pengetahuan dengan
                    </h2>
                    <h1 class="fw-bold" style="font-size: 32px; margin-bottom: 20px; font-style: italic; font-weight: 800;">
                        WaveSkill Academy!
                    </h1>
                    <p style="font-size: 14px; color: #FFFA8D; margin-bottom: 30px;">
                        Mulai belajar dengan biaya murah dan akses belajar <br>dimana saja dan kapan saja dengan WaveSkill Academy
                    </p>
                    <a href="{{ route('student.register') }}" class="btn btn-danger px-4 py-2" style="font-weight: 600;">Daftar Sekarang!</a>
                </div>
                <div class="col-md-6 text-center">
                    <img src="{{ asset('image/hero.png') }}" class="img-fluid" alt="Hero Illustration" style="max-height: 320px;">
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
        </div>
    </section>

    {{-- Testimoni --}}

    <!-- Tentang Kami -->
    <section class="py-5" style="background-color: #ffb347;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h3 style="color:white">Tentang Kami</h3>
                    <h1 style="color:white; font-size: 32px; font-weight: 800;">WaveSkill Academy</h1>
                    <p style="color:white">Kami merupakan Plaform pendidikan nomor 1 diIndonesia</p>
                    <p style="color:white">Bersama <b>WaveSkill Academy</b>, kita siap mengikuti ombak pengetahuan dan berselancar
                    dilautan ilmu yang luas!
                    <br>
                    Ayo tunggu apalagi? Daftarkan dirimu sekarang juga di <b>WaveSKill Academy</b></p>

                    <a href="{{ route('student.register') }}" class="btn btn-danger">Daftar Sekarang</a>
                </div>
                <div class="col-md-6 text-center">
                    <img src="{{ asset('image/about.png') }}" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

   <!-- CTA Footer -->
<section class="footer-cta">
    <div class="cta-container">
        <h4>Mari kita jelajahi bersama lautan ilmu di <strong>WaveSkill Academy</strong></h4>
        <div class="cta-buttons">
            <a href="{{ route('student.register') }}" class="btn btn-danger">Daftar sekarang</a>
            <a href="{{ route('login') }}" class="btn btn-light">Sudah punya akun</a>
        </div>
    </div>
</section>