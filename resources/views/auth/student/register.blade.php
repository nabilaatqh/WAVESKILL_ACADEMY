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
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
        }

        .register-section {
            display: flex;
            min-height: 100vh;
        }

        .register-left {
            flex: 1;
            background-color: #ffb347;
            position: relative;
            overflow: hidden;
        }
        .register-left .image-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }
        .register-left .image-wrapper img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .register-right {
            flex: 1;
            background-color: #44d9f7;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .register-form-card {
            background-color: transparent;
            width: 100%;
            max-width: 420px;
        }

        .register-form-card h2 {
            color: #ffffff;
            font-weight: 700;
            margin-bottom: 1rem;
            font-size: 1.75rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.4);
        }

        .register-form-card .subtitle {
            color: #FFFA8D;
            margin-bottom: 1rem;
            font-size: 0.95rem;
            font-weight: 500;
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
            font-family: 'Poppins', sans-serif;
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

        .btn-register {
            background-color: #f26d6d;
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

        @media (max-width: 767.98px) {
            .register-section {
                flex-direction: column;
            }
            .register-left, .register-right {
                flex: none;
                width: 100%;
                height: 50vh;
            }
            .register-left {
                height: 35vh;
            }
            .register-right {
                height: 65vh;
                padding: 1.5rem;
            }
            .register-form-card {
                max-width: 100%;
            }
        }

        .email-notif-info {
            color: #fff;
            font-size: 0.9rem;
            background: rgba(0, 0, 0, 0.15);
            padding: 0.8rem 1rem;
            border-radius: 12px;
            margin-bottom: 1rem;
            line-height: 1.4;
        }
    </style>
</head>
<body>

<section class="register-section">
    <div class="register-left">
        <div class="image-wrapper">
            <img src="{{ asset('image/about.png') }}" alt="Ilustrasi" />
        </div>
    </div>

    <div class="register-right">
        <div class="register-form-card">
            <h2>Selamat datang di WaveSkill Academy!</h2>
            <p class="subtitle">Daftarkan akunmu sekarang</p>

            <div class="email-notif-info">
                Setelah mendaftar, kamu akan menerima email verifikasi.<br>
                Pastikan untuk mengecek <strong>inbox Gmail</strong> kamu dan klik link verifikasi agar akunmu aktif.
            </div>

            <form method="POST" action="{{ route('student.register') }}">
                @csrf

                <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                @error('name')
                    <div class="text-warning small mb-3">{{ $message }}</div>
                @enderror

                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="text-warning small mb-3">{{ $message }}</div>
                @enderror

                <input type="password" name="password" class="form-control" placeholder="Password" required>
                @error('password')
                    <div class="text-warning small mb-3">{{ $message }}</div>
                @enderror

                <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
                @error('password_confirmation')
                    <div class="text-warning small mb-3">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn-register">Daftar</button>
            </form>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
