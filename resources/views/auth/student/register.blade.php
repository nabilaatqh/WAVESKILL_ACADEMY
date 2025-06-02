{{-- resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun – WaveSkill Academy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Google Fonts Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ----------------------------------------------------------------------------------------------------
           Reset & Font
        ---------------------------------------------------------------------------------------------------- */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
        }

        /* ----------------------------------------------------------------------------------------------------
           Split-Screen Container
        ---------------------------------------------------------------------------------------------------- */
        .register-section {
            display: flex;
            min-height: 100vh;
        }

        /* --------------------------------------------------
           Bagian Kiri: Gambar Ilustrasi
        -------------------------------------------------- */
        .register-left {
            flex: 1;
            background-color: #ffb347; /* oranye */
            position: relative;
            overflow: hidden;
        }
        .register-left .image-wrapper {
            display: flex;                  /* jadikan flex container */
            align-items: center;            /* center vertikal */
            justify-content: center;        /* center horisontal */
            width: 100%;
            height: 100%;
        }
        .register-left .image-wrapper img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        /* --------------------------------------------------
           Bagian Kanan: Form Registrasi
        -------------------------------------------------- */
        .register-right {
            flex: 1;
            background-color: #44d9f7; /* biru */
            display: flex;
            align-items: center;          /* center vertikal */
            justify-content: center;      /* center horisontal */
            padding: 2rem;
        }

        /* ----------------------------------------------------------------------------------------------------
           Form Container di Halaman Register
        ---------------------------------------------------------------------------------------------------- */
        .register-form-card {
            background-color: transparent;
            width: 100%;
            max-width: 420px;
        }

        /* Heading Utama */
        .register-form-card h2 {
            color: #ffffff;
            font-weight: 700;
            margin-bottom: 1rem;
            font-size: 1.75rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.4);  /* efek bayangan ringan */
        }

        /* Subtitle di bawah heading */
        .register-form-card .subtitle {
            color: #FFFA8D; /* kuning muda yang seragam */
            margin-bottom: 2rem;
            font-size: 0.95rem;
            font-weight: 500;
        }

        /* ----------------------------------------------------------------------------------------------------
           Style Input & Button
        ---------------------------------------------------------------------------------------------------- */
        .form-control {
            border-radius: 50px;
            height: 48px;
            background-color: #ffffff;
            border: none;
            font-size: 1rem;
            padding-left: 1rem;
            padding-right: 1rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            font-family: 'Poppins', sans-serif;
            color: #333;
        }
        .form-control::placeholder {
            color: #888; /* placeholder lebih soft */
            opacity: 1;
        }
        .form-control:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(255,255,255,0.5);
        }

        .btn-register {
            background-color: #f26d6d; /* pink/merah agak tua */
            color: #ffffff;
            border-radius: 50px;
            padding: 0.5rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            box-shadow: 0 4px 0 #b33939;
            transition: all 0.2s ease-in-out;
            border: none;
            width: 100%;
            margin-top: 1rem;
            font-family: 'Poppins', sans-serif;
        }
        .btn-register:hover {
            background-color: #e85c5c;
        }
        .btn-register:active {
            transform: translateY(2px);
            box-shadow: 0 2px 0 #b33939;
        }

        /* ----------------------------------------------------------------------------------------------------
           Responsive Adjustments
        ---------------------------------------------------------------------------------------------------- */
        @media (max-width: 767.98px) {
            .register-section {
                flex-direction: column;
            }
            .register-left, .register-right {
                flex: none;
                width: 100%;
                height: 50vh;        /* bagi jadi 50%/50% secara vertikal */
            }
            .register-left {
                height: 35vh;        /* sedikit lebih kecil untuk gambar */
            }
            .register-right {
                height: 65vh;
                padding: 1.5rem;
            }
            .register-form-card {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>

<section class="register-section">
    {{-- Bagian Kiri (Gambar) --}}
    <div class="register-left">
        <div class="image-wrapper">
            {{-- Ganti “your-placeholder.png” dengan ilustrasi pilihan Anda --}}
            <img src="{{ asset('image/about.png') }}" alt="Ilustrasi" />
        </div>
    </div>

    {{-- Bagian Kanan (Form) --}}
    <div class="register-right">
        <div class="register-form-card">
            <h2>Selamat datang di WaveSkill Academy!</h2>
            <p class="subtitle">Daftarkan akunmu sekarang</p>

            <form method="POST" action="{{ route('student.register') }}">
                @csrf

                {{-- Nama Lengkap --}}
                <input
                    type="text"
                    name="name"
                    class="form-control"
                    placeholder="Nama Lengkap"
                    value="{{ old('name') }}"
                    required
                />
                @error('name')
                    <div class="text-warning small mb-3">{{ $message }}</div>
                @enderror

                {{-- Email --}}
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Email"
                    value="{{ old('email') }}"
                    required
                />
                @error('email')
                    <div class="text-warning small mb-3">{{ $message }}</div>
                @enderror

                {{-- Password --}}
                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Password"
                    required
                />
                @error('password')
                    <div class="text-warning small mb-3">{{ $message }}</div>
                @enderror

                {{-- Konfirmasi Password --}}
                <input
                    type="password"
                    name="password_confirmation"
                    class="form-control"
                    placeholder="Konfirmasi Password"
                    required
                />
                @error('password_confirmation')
                    <div class="text-warning small mb-3">{{ $message }}</div>
                @enderror

                {{-- Tombol Daftar --}}
                <button type="submit" class="btn-register">
                    Daftar
                </button>
            </form>
        </div>
    </div>
</section>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
