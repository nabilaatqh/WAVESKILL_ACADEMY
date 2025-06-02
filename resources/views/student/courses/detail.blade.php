@extends('layouts.landing')

@section('title', $course->nama_course)

@section('content')
<style>
  /* ============ CSS KHUSUS HALAMAN DETAIL ============ */

  /* Kontainer utama kartu */
  .course-card {
    max-width: 900px;
    margin: 2rem auto;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
  }

  /* Banner image di atas */
  .course-banner {
    width: 100%;
    height: 300px;
    object-fit: cover;
    display: block;
  }

  /* Bagian konten di dalam kartu */
  .course-body {
    padding: 2rem;
  }

  .course-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
    color: #333;
  }

  .course-subtitle {
    font-size: 1.1rem;
    color: #555;
    margin-bottom: 1.5rem;
  }

  /* Badge jumlah peserta */
  .badge-participants {
    background-color: #e0f3f3;
    color: #008080;
    font-weight: 600;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.9rem;
    display: inline-block;
    margin-right: 1rem;
  }

  /* Badge harga */
  .badge-price {
    background-color: #ffe3e3;
    color: #e53935;
    font-weight: 600;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.9rem;
    display: inline-block;
  }

  /* Deskripsi kursus */
  .course-description {
    margin-top: 1.5rem;
    line-height: 1.6;
    color: #444;
  }

  /* Daftar fitur / poin */
  .course-features {
    margin-top: 2rem;
  }

  .course-features h4 {
    font-size: 1.4rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
    color: #333;
  }

  .course-features ul {
    list-style-type: disc;
    padding-left: 1.5rem;
    color: #444;
  }

  .course-features ul li {
    margin-bottom: 0.5rem;
  }

  /* Tombol beli */
  .btn-buy {
    background-color: #fa6b6b;
    color: #fff;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    transition: background-color 0.2s;
    margin-top: 2rem;
    display: inline-block;
    text-decoration: none;
  }
  .btn-buy:hover {
    background-color: #e35b5b;
    color: #fff;
    text-decoration: none;
  }

  /* Tombol kembali ke daftar */
  .btn-back {
    display: inline-block;
    margin-bottom: 1.5rem;
    color: #008080;
    font-weight: 500;
    text-decoration: none;
  }
  .btn-back:hover {
    text-decoration: underline;
  }
</style>

<div class="course-card">
  {{-- 1) Banner Image --}}
  @if($course->banner_image)
    <img
      src="{{ asset('storage/' . $course->banner_image) }}"
      alt="{{ $course->nama_course }}"
      class="course-banner">
  @else
    {{-- Jika admin belum meng‐upload banner, tampilkan placeholder default --}}
    <img
      src="{{ asset('images/default-course.png') }}"
      alt="Default Course"
      class="course-banner">
  @endif

  <div class="course-body">
    {{-- Tombol Kembali ke halaman daftar --}}
    <a href="{{ route('student.courses.index') }}" class="btn-back">&larr; Kembali ke Daftar Kursus</a>

    {{-- 2) Judul dan (opsional) subtitle --}}
    <div class="course-title">{{ $course->nama_course }}</div>

    {{-- 3) Badge jumlah peserta & harga --}}
    <div class="mb-4">
      <span class="badge-participants">
        {{ number_format($course->students->count(), 0, ',', '.') }} Peserta
      </span>
      <span class="badge-price">
        Rp {{ number_format($course->harga ?? 0, 0, ',', '.') }}
      </span>
    </div>

    {{-- 4) Deskripsi panjang --}}
    <div class="course-description">
      <p><strong>Deskripsi:</strong></p>
      <p>{{ $course->deskripsi }}</p>
    </div>

    {{-- 5) “Apa yang akan kamu pelajari?” --}}
    @if(!empty($course->features) && is_array($course->features))
      <div class="course-features">
        <h4>Apa yang akan kamu pelajari?</h4>
        <ul>
          @foreach($course->features as $point)
            <li>{{ $point }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- 6) Tombol Beli Kursus --}}
    <a href="{{ route('student.enroll.index', $course->id) }}" class="btn-buy">
      Beli Kursus
    </a>
  </div>
</div>
@endsection
