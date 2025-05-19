<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WaveSkill Academy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
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

    <!-- Hero -->
    <section class="hero d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="fw-bold mb-3">Tingkatkan Kemampuanmu bersama<br><span class="text-white">WaveSkill Academy!</span></h1>
                    <p>Mulai belajar dengan kursus menarik, interaktif, dan sesuai kebutuhan industri.</p>
                    <a href="{{ route('student.register') }}" class="btn btn-danger mt-3">Daftar Sekarang</a>
                </div>
                <div class="col-md-6 text-center">
                    <img src="{{ asset('images/ilustrasi-hero.png') }}" class="img-fluid" alt="Hero Illustration">
                </div>
            </div>
        </div>
    </section>

    <!-- Fitur Kelebihan -->
    <section class="py-5">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('images/fitur1.png') }}" height="70">
                    <p class="mt-2">Materi Tersusun</p>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('images/fitur2.png') }}" height="70">
                    <p class="mt-2">Akses Fleksibel</p>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('images/fitur3.png') }}" height="70">
                    <p class="mt-2">Sertifikat & Proyek</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Kursus Populer -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title">Cari Kursus Populer Kami</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="course-card">
                        <img src="{{ asset('images/kursus-html.png') }}" class="img-fluid mb-2">
                        <h6>HTML & CSS</h6>
                        <small>Rp. 200.000</small>
                    </div>
                </div>
                <!-- Duplikat card lainnya sesuai data kursus -->
            </div>
        </div>
    </section>

    <!-- Tentang Kami -->
    <section class="py-5" style="background-color: #ffb347;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="fw-bold">Tentang Kami</h2>
                    <p>WaveSkill Academy adalah platform pembelajaran daring untuk meningkatkan skill profesional. Kami menyediakan kursus berkualitas dengan pembimbing berpengalaman.</p>
                    <a href="{{ route('student.register') }}" class="btn btn-danger">Daftar Sekarang</a>
                </div>
                <div class="col-md-6 text-center">
                    <img src="{{ asset('images/ilustrasi-tentang.png') }}" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Footer -->
    <section class="footer-cta">
        <h4>Mari kita jelajahi bersama lautan ilmu di <strong>WaveSkill Academy</strong></h4>
        <div class="mt-3">
            <a href="{{ route('student.register') }}" class="btn btn-danger me-2">Daftar sekarang</a>
            <a href="{{ route('login') }}" class="btn btn-light">Sudah punya akun</a>
        </div>
    </section>
</body>
</html>