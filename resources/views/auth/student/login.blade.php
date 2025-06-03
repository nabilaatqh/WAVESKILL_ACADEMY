{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Mahasiswa – WaveSkill Academy</title>
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
           Split‐Screen Container
        ---------------------------------------------------------------------------------------------------- */
        .login-container {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* --------------------------------------------------
           Bagian Kiri (Ilustrasi)
        -------------------------------------------------- */
        .left-section {
            flex: 1;
            background-color: #ffb347; /* oranye */
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .left-section img {
            max-width: 80%;
            max-height: 80%;
            object-fit: contain;
        }

        /* --------------------------------------------------
           Bagian Kanan (Form Login)
        -------------------------------------------------- */
        .right-section {
            flex: 1;
            background-color: #44d9f7; /* biru muda */
            display: flex;
            align-items: center;      /* center vertikal */
            justify-content: center;  /* center horisontal */
            padding: 2rem;
        }

        /* ----------------------------------------------------------------------------------------------------
           Login Box Container
        ---------------------------------------------------------------------------------------------------- */
        .login-box {
            background: transparent;
            width: 100%;
            max-width: 400px;
        }

        .login-box h2 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.4);
        }
        .login-box .subtitle {
            font-size: 0.95rem;
            color: #FFFA8D; /* kuning muda */
            margin-bottom: 1.5rem;
        }

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
            color: #333;
        }
        .form-control::placeholder {
            color: #888;
            opacity: 1;
        }
        .form-control:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(255,255,255,0.5);
        }

        /* ----------------------------------------------------------------------------------------------------
           Tombol Masuk
        ---------------------------------------------------------------------------------------------------- */
        .btn-login {
            background-color: #f26d6d; /* pink/merah tua */
            color: #ffffff;
            border: none;
            width: 100%;
            height: 48px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            box-shadow: 0 4px 0 #b33939;
            transition: all 0.2s ease-in-out;
        }
        .btn-login:hover {
            background-color: #e85c5c;
        }
        .btn-login:active {
            transform: translateY(2px);
            box-shadow: 0 2px 0 #b33939;
        }

        /* ----------------------------------------------------------------------------------------------------
           Kotak Pesan Error
        ---------------------------------------------------------------------------------------------------- */
        .error-message {
            background-color: #ffc0c0;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 1rem;
            color: #b33939;
            font-weight: 500;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        /* ----------------------------------------------------------------------------------------------------
           Responsive Adjustments
        ---------------------------------------------------------------------------------------------------- */
        @media (max-width: 767.98px) {
            .login-container {
                flex-direction: column;
            }
            .left-section, .right-section {
                flex: none;
                width: 100%;
                height: 50vh;
            }
            .left-section {
                height: 35vh;  /* tinggi gambar */
            }
            .right-section {
                height: 65vh;
                padding: 1.5rem;
            }
            .login-box {
                max-width: 100%;
            }
        }
    </style>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="login-container">
    {{-- Bagian Kiri: Ilustrasi --}}
    <div class="left-section">
        {{-- Ganti “about.png” dengan ilustrasi login sesuai kebutuhan --}}
        <img src="{{ asset('image/about.png') }}" alt="Ilustrasi Mahasiswa">
    </div>

    {{-- Bagian Kanan: Form Login --}}
    <div class="right-section">
        <div class="login-box">
            <h2>Login Mahasiswa</h2>
            <p class="subtitle">Akses materi dan tugas Anda di sini</p>

            @if(session('error'))
                <div class="error-message">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('student.login') }}">
                @csrf

                {{-- Input Tersembunyi: Redirect (jika ada) --}}
                <input type="hidden" name="redirect" value="{{ request('redirect') }}">

                <div class="mb-3">
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="Email Mahasiswa"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    >
                    @error('email')
                        <div class="text-warning small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Password"
                        required
                    >
                    @error('password')
                        <div class="text-warning small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-login">Masuk</button>
            </form>
        </div>
    </div>
</div>

{{-- SweetAlert2: tampilkan jika ada session 'success' --}}
<script>
    @if(session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK',
            allowOutsideClick: false,
            allowEscapeKey: false
        });
    @endif
</script>

{{-- Bootstrap JS (opsional) --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
