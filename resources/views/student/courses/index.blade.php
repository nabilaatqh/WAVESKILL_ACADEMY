@extends('layouts.landing')

@section('title', 'Daftar Kursus')

@section('content')
<style>
    /* ====== STYLING UTAMA (sesuai mockup Figma) ====== */
    .populer-section {
        background-color: #ffffff;
        padding-top: 2rem;
        padding-bottom: 2rem;
    }
    .populer-section h2 {
        font-weight: bold;
        font-size: 1.75rem;
        margin-bottom: 0.25rem;
        color: #333333;
    }
    .populer-section p.subtext {
        color: #d96c6c;
        margin-bottom: 1.75rem;
        font-size: 1rem;
    }

    /* Outer card kuning (background #FFE569), corner radius 0.75rem, box-shadow lembut */
    .populer-card {
        background-color: #FFE569;           /* kuning */
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

    /* Wrapper gambar: tinggi 180px, sudut atas ikut membulat */
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

    /* Badan kartu: padding 0.75rem, flex‐column */
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

    /* Tombol harga “pill” merah muda (#F26D6D) */
    .populer-body .price-button {
        background-color: #F26D6D;   /* pink/dark red */
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
        background-color: #D4525B;
    }
    .populer-body .price-button:active {
        transform: translateY(2px);
    }

    /* Footer kartu: letakkan tombol & jumlah peserta di baris yang sama */
    .populer-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
    }

    /* Pada layar ≤576px: tombol harga stretch 100% */
    @media (max-width: 576px) {
        .populer-footer .price-button {
            width: 100%;
        }
    }

    /* Styling judul & subtext di atas grid */
    .header-section {
        text-align: center;
        margin-bottom: 2rem;
    }
    .header-section h2 {
        font-weight: bold;
        font-size: 2rem;
        color: #333333;
        margin-bottom: 0.25rem;
    }
    .header-section p.subtext {
        color: #d96c6c;
        font-size: 1rem;
    }
</style>

<section class="populer-section">
    <div class="container">
        {{-- Judul & Subteks --}}
        <div class="header-section">
            <h2>Beli Kursus Sekarang!</h2>
            <p class="subtext">Temukan berbagai macam kursus sesuai dengan keinginanmu di sini!</p>
        </div>

        {{-- Grid responsif: 1 kolom HP, 2 kolom tablet, 3 kolom desktop --}}
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @forelse ($courses as $course)
                <div class="col">
                    <div class="populer-card h-100 d-flex flex-column">
                        {{-- 1) Gambar Banner --}}
                        <div class="populer-img-wrapper">
                            <img
                                src="{{ 
                                    $course->banner_image 
                                        ? asset('storage/' . $course->banner_image) 
                                        : asset('images/default-course.png') 
                                }}"
                                alt="{{ $course->nama_course }}"
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
                                {{ $course->students_count ?? 0 }} Peserta
                            </small>

                            {{-- Harga “pill” merah sebagai tombol beli --}}
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
                    <p>Belum ada kursus tersedia saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
