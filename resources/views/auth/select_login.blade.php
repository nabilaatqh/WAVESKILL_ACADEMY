@extends('layouts.app')

@section('title', 'Login Akses')
<link rel="stylesheet" href="{{ asset('css/instruktur.css') }}">
@section('content')
<style>
    body {
        background: linear-gradient(to bottom, #fdb049 50%, #4dd7ee 50%);
        height: 100vh;
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
    }

    .login-card {
        background-color: white;
        border-radius: 24px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        padding: 60px 50px;
        max-width: 650px;
        margin: auto;
        text-align: center;
    }

    

        .card-login h2 {
            font-weight: bold;
            margin-bottom: 30px;
            color: #333;
        }

        .login-btn {
            width: 180px;
            height: 60px;
            font-size: 1.2rem;
            font-weight: 600;
            border-radius: 12px;
            border: none;
            transition: all 0.2s ease-in-out;
            margin: 0 10px;
        }

        /* Tombol Instruktur */
        .btn-instruktur {
            background-color: #f56969;
            color: white;
            box-shadow: 0 4px 0 #c34646;
        }

        .btn-instruktur:active {
            transform: translateY(2px);
            box-shadow: 0 2px 0 #c34646;
        }

        /* Tombol Pelajar */
        .btn-pelajar {
            background-color: #f9e47d;
            color: #d35400;
            box-shadow: 0 4px 0 #e0c85a;
        }

        .btn-pelajar:active {
            transform: translateY(2px);
            box-shadow: 0 2px 0 #e0c85a;
        }

        @media (max-width: 576px) {
            .login-btn {
                width: 100%;
                margin: 10px 0;
            }

            .card-login {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="image-top">
        <img src="{{ asset('image/about.png') }}" alt="Login Illustration">
    </div>
    <div class="card-login" style="max-width: 720px; padding: 60px 50px;">
    <h2>Masuk Sebagai</h2>
   <div class="d-flex flex-wrap justify-content-center">
    <a href="{{ route('instruktur.login') }}">
        <button class="login-btn btn-instruktur">Instruktur</button>
    </a>
    <a href="{{ route('student.login') }}">
        <button class="login-btn btn-pelajar">Pelajar</button>
    </a>
</div>

</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
