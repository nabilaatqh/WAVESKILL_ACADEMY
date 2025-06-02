<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Welcome - WaveSkill Academy</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{-- Bootstrap & FontAwesome --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #ffffff;
      margin: 0;
      padding: 0;
    }

    /* ---------------------- Topbar / Navbar ---------------------- */
    .topbar {
      background-color: #ffb347;
      padding: 0.75rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .brand {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .brand img {
      height: 42px;
    }
    .brand-text {
      color: #fff;
      font-weight: 700;
      font-size: 1.3rem;
      margin: 0;
    }
    .auth-buttons {
      display: flex;
      gap: 10px;
    }
    .btn-danger {
      background-color: #f26d6d;
      color: #fff;
      box-shadow: 0 4px 0 #b33939;
      border: none;
    }
    .btn-danger:hover {
      background-color: #e85c5c;
    }
    .btn-light-yellow {
      background-color: #ffe569;
      color: #f26d6d;
      box-shadow: 0 4px 0 #b33939;
      border: none;
    }
    .btn-light-yellow:hover {
      background-color: #ffd54c;
    }
    .btn-shadow:active {
      transform: translateY(2px);
      box-shadow: 0 2px 0 #b33939;
    }

    /* ---------------------- Hero Section ---------------------- */
    .hero {
      background-color: #44d9f7;
      padding: 3rem 2rem 4rem;  /* Tambah padding-bottom di sini */
      color: white;
      position: relative;
      z-index: 1;
    }
    .hero .hero-img {
      max-height: 360px;
      margin-top: -20px;
    }
    .hero small.subtitle {
      font-size: 1rem;
      color: #ffee8d;
      margin-bottom: 0.75rem;
      display: inline-block;
      font-weight: 500;
    }
    .hero h1 {
      font-size: 2.5rem;
      color: #FFFA8D;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.4);
      margin-bottom: 1rem;
      line-height: 1.2;
    }
    .hero h1 span.highlight {
      font-style: italic;
      font-weight: 700;
      color: #ffffff;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.4);
    }
    .hero p {
      text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
      color: #FFFA8D;
      font-size: 1rem;
      margin-bottom: 2rem;
      line-height: 1.4;
    }
    .hero a.btn-register-now {
      background-color: #f26d6d;
      color: #fff;
      box-shadow: 0 4px 0 #b33939;
      border: none;
      border-radius: 0.75rem;
      padding: 0.75rem 2rem;
      font-size: 1rem;
      font-weight: 600;
      transition: all 0.15s ease-in-out;
      text-decoration: none;
      display: inline-block;
    }
    .hero a.btn-register-now:hover {
      background-color: #e85c5c;
    }
    .hero a.btn-register-now:active {
      transform: translateY(2px);
      box-shadow: 0 2px 0 #b33939;
    }

    /* ---------------------- Fitur Keunggulan ---------------------- */
    .fitur-wrapper {
      position: relative;
      z-index: 10;
      margin-top: -50px; 
    }
    .fitur-card {
      background-color: #ffffff;
      border: none;
      border-radius: 1rem;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      padding: 2rem 1rem;
    }

    /* ---------------------- Popular Courses ---------------------- */
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
    .populer-card {
      background-color: #ffe569;
      border-radius: 0.75rem;
      overflow: hidden;
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
      box-shadow:
        0 12px 40px rgba(0, 0, 0, 0.12),
        0 4px 10px rgba(0, 0, 0, 0.06);
    }
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
    .populer-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: auto;
    }
    .populer-body .price-button {
      background-color: #f26d6d;
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
    @media (max-width: 576px) {
      .populer-footer .price-button {
        width: 100%;
      }
    }

    /* ---------------------- Tentang Kami ---------------------- */
    .tentang-kami {
      background-color: #ffb347;
      color: white;
      padding: 4rem 2rem;
    }
    .tentang-kami h2 {
      text-shadow: 1px 1px 3px rgba(0,0,0,0.4);
    }

    /* ---------------------- CTA Footer ---------------------- */
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
    .footer-cta .btn-cta {
      padding: 0.75rem 2rem;
      font-size: 1rem;
      font-weight: 600;
      border-radius: 8px;
      transition: transform 0.15s ease, box-shadow 0.15s ease;
      box-shadow: 0 4px 0 rgba(0, 0, 0, 0.25);
      text-decoration: none;
      display: inline-block;
    }
    .footer-cta .btn-cta + .btn-cta {
      margin-left: 0.75rem;
    }
    @media (max-width: 576px) {
      .footer-cta .btn-cta {
        width: 100%;
        margin-left: 0 !important;
        margin-bottom: 0.75rem;
      }
      .footer-cta .btn-cta:last-child {
        margin-bottom: 0;
      }
    }
    .footer-cta .btn-danger-cta {
      background-color: #f26d6d;
      color: #fff;
    }
    .footer-cta .btn-danger-cta:hover {
      background-color: #e85c5c;
    }
    .footer-cta .btn-danger-cta:active {
      transform: translateY(2px);
      box-shadow: 0 2px 0 rgba(0, 0, 0, 0.25);
    }
    .footer-cta .btn-warning-cta {
      background-color: #ffe569;
      color: #f26d6d;
    }
    .footer-cta .btn-warning-cta:hover {
      background-color: #ffd54c;
    }
    .footer-cta .btn-warning-cta:active {
      transform: translateY(2px);
      box-shadow: 0 2px 0 rgba(0, 0, 0, 0.25);
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <header class="topbar">
    <div class="brand">
      <img src="image/logo_umkt.png" alt="Logo">
      <span class="brand-text">WaveSkill Academy</span>
    </div>
    <div class="auth-buttons">
      <a href="{{ route('login') }}" class="btn btn-danger btn-shadow px-4 py-2 fw-semibold">Masuk</a>
      <a href="{{ route('student.register') }}" class="btn btn-light-yellow btn-shadow px-4 py-2 fw-semibold">Daftar</a>
    </div>
  </header>

  <!-- Hero -->
  <section class="hero">
    <div class="container">
      <div class="row align-items-center">
        <!-- Teks Hero di Kiri -->
        <div class="col-md-6">
          <small class="subtitle">Sarana Belajar Online Course Terpercaya</small>
          <h1>
            Tingkatkan Kemampuan mu, dan<br>
            ikuti ombak pengetahuan dengan<br>
            <span class="highlight">WaveSkill Academy!</span>
          </h1>
          <p>
            Mulai belajar dengan biaya murah dan akses belajar<br>
            dimana saja dan kapan saja dengan WaveSkill Academy
          </p>
          <a href="{{ route('student.register') }}" class="btn-register-now">Daftar Sekarang!</a>
        </div>
        <!-- Ilustrasi Hero di Kanan -->
        <div class="col-md-6 text-center">
          <img src="image/hero.gif" class="img-fluid hero-img" alt="Hero">
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
            <img src="image/fitur.png" class="img-fluid mb-3" style="height: 120px;">
            <h6 class="fw-bold">Instruktur Berpengalaman</h6>
            <p class="small mb-0">WaveSkill Academy menghadirkan Instruktur yang ahli di bidangnya!</p>
          </div>
          <div class="col-6 col-md-4 col-lg-2 d-flex flex-column align-items-center mb-4 mb-lg-0">
            <img src="image/fitur1.png" class="img-fluid mb-3" style="height: 120px;">
            <h6 class="fw-bold">Akses di Mana Saja</h6>
            <p class="small mb-0">Seluruh materi WaveSkill Academy bisa diakses dari mana saja loh!</p>
          </div>
          <div class="col-6 col-md-4 col-lg-2 d-flex flex-column align-items-center mb-4 mb-lg-0">
            <img src="image/fitur2.png" class="img-fluid mb-3" style="height: 120px;">
            <h6 class="fw-bold">Koneksi Di seluruh Indonesia</h6>
            <p class="small mb-0">Berkenalan dengan pelajar dan instruktur dari seluruh Indonesia!</p>
          </div>
          <div class="col-6 col-md-4 col-lg-2 d-flex flex-column align-items-center mb-4 mb-lg-0">
            <img src="image/fitur3.png" class="img-fluid mb-3" style="height: 120px;">
            <h6 class="fw-bold">Sertifikat Resmi</h6>
            <p class="small mb-0">Sertifikasi langsung dari platform.</p>
          </div>
          <div class="col-6 col-md-4 col-lg-2 d-flex flex-column align-items-center">
            <img src="image/fitur4.png" class="img-fluid mb-3" style="height: 120px;">
            <h6 class="fw-bold">Biaya Murah</h6>
            <p class="small mb-0">Akses banyak materi, tapi dengan biaya yang minim!</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Popular Courses -->
  <section class="populer-section">
    <div class="container">
      <h2 class="text-center mb-1">Cari Kursus Populer Kami</h2>
      <p class="text-center subtext">Temukan berbagai macam kursus sesuai dengan keinginanmu di sini!</p>
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @php
          $popularSix = $courses->take(9);
        @endphp

        @forelse($popularSix as $course)
          <div class="col">
            <div class="populer-card h-100 d-flex flex-column">
              <!-- Gambar -->
              <div class="populer-img-wrapper">
                <img src="{{ 
                    $course->banner_image 
                      ? asset('storage/' . $course->banner_image) 
                      : asset('image/default-course.png') 
                  }}" class="img-fluid" alt="{{ $course->nama_course }}">
              </div>
              <!-- Body -->
              <div class="populer-body d-flex flex-column">
                <h5>{{ $course->nama_course }}</h5>
                <p class="desc">
                  {{ \Illuminate\Support\Str::limit($course->deskripsi, 60, '...') }}
                </p>
                <small class="peserta">{{ $course->students->count() ?? 0 }} Peserta</small>
                <!-- Footer: Harga sebagai “tombol” -->
                <div class="populer-footer">
                  <a href="{{ route('student.courses.detail', $course->id) }}" class="price-button">
                    Rp {{ number_format($course->harga, 0, ',', '.') }}
                  </a>
                </div>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12 text-center text-muted">
            <p>Belum ada course tersedia saat ini.</p>
          </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- Tentang Kami -->
  <section class="tentang-kami">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <h2 class="fw-bold">Tentang Kami</h2>
          <h2 class="fw-bold">WaveSkill Academy</h2>
          <p class="mt-3 text-white" style="font-size: 1rem; line-height: 1.6;">
            Kami merupakan Platform pendidikan nomor 1 di Indonesia!
          </p>
          <p class="mt-2 text-white" style="font-size: 1rem; line-height: 1.6;">
            Bersama <strong>WaveSkill Academy</strong>, kita siap mengikuti ombak pengetahuan dan berselancar di lautan ilmu yang luas!
          </p>
          <p class="mt-2 text-white" style="font-size: 1rem; line-height: 1.6;">
            Ayo tunggu apalagi? Daftarkan dirimu sekarang juga di <strong>WaveSkill Academy</strong>!
          </p>
          <a href="#" class="btn btn-danger btn-shadow mt-4 px-4 py-2" style="font-size: 1rem;">
            Daftar Sekarang!
          </a>
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
        <a href="{{ route('student.register') }}" class="btn-cta btn-danger-cta">Daftar sekarang</a>
        <a href="{{ route('student.login') }}" class="btn-cta btn-warning-cta">Sudah punya akun</a>
      </div>
    </div>
  </section>
</body>
</html>
