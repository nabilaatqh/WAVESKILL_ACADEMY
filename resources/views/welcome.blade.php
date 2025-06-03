<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Welcome - WaveSkill Academy</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{-- Bootstrap & FontAwesome --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  {{-- Panggil CSS eksternal --}}
    <link rel="stylesheet" href="{{ asset('frontsite/student/welcome.css') }}">
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
