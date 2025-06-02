<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Email – WaveSkill Academy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #ffb347, #44d9f7);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .verify-card {
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            max-width: 480px;
            width: 100%;
            text-align: center;
        }

        .verify-card h2 {
            font-weight: 600;
            margin-bottom: 1rem;
            color: #333;
        }

        .verify-card p {
            font-size: 1rem;
            color: #666;
        }

        .btn-resend {
            background-color: #f26d6d;
            color: white;
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            border: none;
            font-weight: 500;
            margin-top: 1.5rem;
            transition: background-color 0.3s ease;
        }

        .btn-resend:hover {
            background-color: #e85c5c;
        }

        .alert-success {
            margin-top: 1rem;
        }
    </style>
</head>
<body>

<div class="verify-card">
    <h2>Verifikasi Email Kamu</h2>

    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            Link verifikasi baru telah dikirim ke email kamu.
        </div>
    @endif

    <p>Kami telah mengirim email berisi link verifikasi ke alamat yang kamu daftarkan.  
    <br>Silakan cek <strong>inbox Gmail</strong> kamu dan klik link tersebut untuk mengaktifkan akun.</p>

    <p>Belum menerima email?</p>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn-resend">Kirim Ulang Email Verifikasi</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
