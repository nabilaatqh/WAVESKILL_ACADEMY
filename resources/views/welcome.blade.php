<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Welcome - WaveSkill Academy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #ffb347;
            padding: 0.75rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: 700;
            color: #fff;
        }

        .btn-danger {
            background-color: #f26d6d;
            color: #fff;
            box-shadow: 0 4px 0 #b33939;
        }

        .btn-danger:hover {
            background-color: #e85c5c;
        }

        .btn-danger:active {
            transform: translateY(2px);
            box-shadow: 0 2px 0 #b33939;
        }

        .btn-light-yellow {
            background-color: #ffe569;
            color: #f26d6d;
            box-shadow: 0 4px 0 #b33939;
            border: none;
        }

        .btn-light-yellow:hover {
            background-color: #ffd54c;
            color: #f26d6d;
        }

        .btn-light-yellow:active {
            transform: translateY(2px);
            box-shadow: 0 2px 0 #b33939;
        }

        .hero {
            background-color: #44d9f7;
            padding: 3rem 2rem 6rem;
            color: white;
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            font-size: 2.5rem;
            color: #FFFA8D;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.4);
        }

        .hero h4 {
            text-shadow: 1px 1px 3px rgba(0,0,0,0.4);
        }

        .hero p {
            font-size: 14px;
            color: #FFFA8D;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }

        .hero .hero-img {
            max-height: 320px;
            margin-top: -30px;
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

        .tentang-kami {
            background-color: #ffb347;
            color: white;
            padding: 4rem 2rem;
        }

        .tentang-kami h2 {
            text-shadow: 1px 1px 3px rgba(0,0,0,0.4);
        }

        .footer-cta {
            background-color: #44d9f7;
            padding: 3rem 2rem;
            text-align: center;
            margin-top: -30px;
        }

        .footer-cta h4 {
            color: white;
            font-weight: bold;
        }

    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar d-flex justify-content-between align-items-center">
        <a class="navbar-brand" href="#">WaveSkill Academy</a>
        <div class="d-flex gap-3">
            <a href="{{ route('login') }}" class="btn btn-danger px-4 py-2 fw-semibold">Masuk</a>
            <a href="{{ route('student.register') }}" class="btn btn-light-yellow px-4 py-2 fw-semibold">Daftar</a>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1>Selamat Datang, <span style="color:white;">Pengunjung!</span></h1>
                    <h4>Ikuti ombak pengetahuan bersama <strong>WaveSkill Academy!</strong></h4>
                    <p>Mulai belajar dengan biaya murah dan akses belajar<br>dimana saja dan kapan saja.</p>
                </div>
                <div class="col-md-6 text-center">
                    <img src="{{ asset('image/hero.gif') }}" alt="Hero Illustration" class="img-fluid hero-img">
                </div>
            </div>
        </div>
    </section>

    <!-- Fitur Keunggulan -->
    <section class="fitur-wrapper">
        <div class="container">
            <div class="card fitur-card">
                <div class="row text-center justify-content-between align-items-stretch">
                    <div class="col-6 col-md-4 col-lg-2 d-flex flex-column align-items-center mb-4 mb-lg-0">
                        <img src="{{ asset('image/fitur.png') }}" class="img-fluid mb-3" style="height: 130px;">
                        <h6 class="fw-bold">Instruktur Berpengalaman</h6>
                        <p class="small mb-0">Instruktur ahli dan terpercaya.</p>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2 d-flex flex-column align-items-center mb-4 mb-lg-0">
                        <img src="{{ asset('image/fitur1.png') }}" class="img-fluid mb-3" style="height: 130px;">
                        <h6 class="fw-bold">Akses di Mana Saja</h6>
                        <p class="small mb-0">Belajar fleksibel dari mana saja.</p>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2 d-flex flex-column align-items-center mb-4 mb-lg-0">
                        <img src="{{ asset('image/fitur2.png') }}" class="img-fluid mb-3" style="height: 130px;">
                        <h6 class="fw-bold">Koneksi Nasional</h6>
                        <p class="small mb-0">Jalin koneksi pelajar se-Indonesia.</p>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2 d-flex flex-column align-items-center mb-4 mb-lg-0">
                        <img src="{{ asset('image/fitur3.png') }}" class="img-fluid mb-3" style="height: 130px;">
                        <h6 class="fw-bold">Sertifikat Resmi</h6>
                        <p class="small mb-0">Sertifikasi langsung dari platform.</p>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2 d-flex flex-column align-items-center">
                        <img src="{{ asset('image/fitur4.png') }}" class="img-fluid mb-3" style="height: 130px;">
                        <h6 class="fw-bold">Biaya Terjangkau</h6>
                        <p class="small mb-0">Belajar murah tapi berkualitas!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Kami -->
    <section class="tentang-kami">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="fw-bold">Tentang Kami</h2>
                    <p class="mt-3">WaveSkill Academy adalah platform pembelajaran daring untuk meningkatkan skill profesional dengan pembimbing berkualitas.</p>
                    <a href="#" class="btn btn-danger mt-3">Mulai Belajar</a>
                </div>
                <div class="col-md-6 text-center">
                    <img src="{{ asset('image/about.png') }}" alt="Tentang Kami" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Footer -->
    <section class="footer-cta">
        <div class="container text-center">
            <h4 class="mb-4 text-white">Mari jelajahi lautan ilmu bersama <strong>WaveSkill Academy</strong></h4>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ route('student.register') }}" class="btn btn-danger btn-shadow px-4 py-2 fw-semibold">
                    Daftar sekarang
                </a>
                <a href="{{ route('login') }}" class="btn btn-light-yellow btn-shadow px-4 py-2 fw-semibold">
                    Sudah punya akun
                </a>
            </div>
        </div>
    </section>
</body>
</html>
