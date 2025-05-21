<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Login - WaveSkill Academy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #4CDFFF; /* biru muda */
            color: #fff;
        }

        .login-container {
            display: flex;
            height: 100vh;
            width: 100vw;
        }

        .left-section {
            background-color: #FFA94D; /* oranye */
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .left-section img {
            max-width: 80%;
            height: auto;
        }

        .right-section {
            background-color: #4CDFFF; /* biru muda */
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 3rem 4rem;
        }

        .login-box {
            width: 100%;
            max-width: 400px;
        }

        h2 {
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 0 3px rgba(0,0,0,0.15);
        }

        .subtitle {
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            color: #fff;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.7rem 1rem;
            font-size: 1rem;
            border: none;
            box-shadow: inset 0 0 6px rgba(0,0,0,0.1);
            outline: none;
            margin-bottom: 1.7rem;
        }

        .form-control:focus {
            box-shadow: 0 0 8px #FFA94D;
        }

        .btn-login {
            background-color: #EA6464;
            border: none;
            padding: 0.9rem 0;
            width: 100%;
            border-radius: 25px;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            box-shadow: 4px 4px 6px rgba(0,0,0,0.2);
            transition: background-color 0.3s ease;
        }

        .btn-login:hover {
            background-color: #d95454;
        }

        /* Error message */
        .error-message {
            background-color: #f44336;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            color: white;
            font-weight: 600;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }
            .left-section, .right-section {
                flex: unset;
                width: 100%;
                height: 50vh;
                padding: 1rem 2rem;
            }
            .btn-login {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Left Illustration -->
        <div class="left-section">
            <img src="{{ asset('images/admin/ilustrasi_login.png') }}" alt="Ilustrasi" />
        </div>

        <!-- Right Form -->
        <div class="right-section">
            <div class="login-box">
                <h2>Selamat datang di<br>WaveSkill Academy!</h2>
                <p class="subtitle">Mulai berbagi tautan ilmu di sini</p>

                {{-- Tampilkan error validasi --}}
                @if ($errors->any())
                    <div class="error-message">
                        <ul style="margin:0; padding-left:1.2rem;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="Email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    />

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Password"
                        required
                    />

                    <button type="submit" class="btn btn-login">Masuk</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
