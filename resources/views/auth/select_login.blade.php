<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Akses - WaveSkill</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            height: 100vh;
            background: linear-gradient(to bottom, #fdb049 50%, #4dd7ee 50%);
            overflow: hidden;
        }

        .image-top {
            display: flex;
            justify-content: center;
            padding-top: 40px;
        }

        .image-top img {
            max-width: 220px;
            height: auto;
        }

        .card-login {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            border-radius: 24px;
            padding: 60px 50px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
            width: 90%;
            max-width: 650px;
            text-align: center;
            z-index: 10;
        }

        .card-login h2 {
            font-weight: bold;
            margin-bottom: 30px;
            color: #333;
        }

        .login-btn {
            width: 180px;
            height: 60px;
            font-size: 1.25rem;
            font-weight: bold;
            border-radius: 12px;
            border: none;
            margin: 0 10px;
            transition: transform 0.2s ease-in-out;
        }

        .login-btn:hover {
            transform: scale(1.05);
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

    <div class="card-login">
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