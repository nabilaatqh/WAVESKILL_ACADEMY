<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Mahasiswa - WaveSkill Academy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-container {
            display: flex;
            height: 100vh;
        }

        .left-section {
            background-color: #ffb347; /* oranye */
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .left-section img {
            max-width: 80%;
            height: auto;
        }

        .right-section {
            background-color: #44d9f7; /* biru muda */
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 2rem;
        }

        .login-box {
            background: transparent;
            width: 100%;
            max-width: 400px;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px;
        }

        .btn-login {
            background-color: #ff6f61;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 8px;
            color: white;
            font-weight: bold;
        }

        .btn-login:hover {
            background-color: #ff4d40;
        }

        h2 {
            font-weight: bold;
            color: white;
        }

        .subtitle {
            font-size: 0.9rem;
            color: white;
            margin-bottom: 1.5rem;
        }

        .error-message {
            background-color: #ffc0c0;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 10px;
            color: red;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Kiri (ilustrasi) -->
        <div class="left-section">
            <img src="{{ asset('image/about.png') }}" alt="Ilustrasi Mahasiswa">
        </div>

        <!-- Kanan (form login) -->
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

                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email Mahasiswa" required autofocus>
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>

                    <button type="submit" class="btn btn-login">Masuk</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
