<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Instruktur - WaveSkill')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome (opsional) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f7fa;
        }

        .sidebar {
            width: 220px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: #0077b6;
            padding: 20px;
            color: white;
        }

        .sidebar h4 {
            font-size: 1.4rem;
            margin-bottom: 2rem;
        }

        .sidebar a {
            color: white;
            display: block;
            margin: 10px 0;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 6px;
        }

        .sidebar a:hover, .sidebar a.active {
            background-color: #023e8a;
        }

        .content {
            margin-left: 220px;
            padding: 30px;
        }

        .topbar {
            background-color: #00b4d8;
            padding: 10px 20px;
            color: white;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4>WaveSkill</h4>
        <a href="{{ route('instruktur.dashboard') }}" class="{{ request()->is('instruktur/dashboard') ? 'active' : '' }}">
            <i class="fas fa-home me-2"></i> Dashboard
        </a>
        <a href="#">
            <i class="fas fa-chalkboard-teacher me-2"></i> Kursus Saya
        </a>
        <a href="#">
            <i class="fas fa-file-alt me-2"></i> Materi
        </a>
        <a href="#">
            <i class="fas fa-tasks me-2"></i> Tugas
        </a>
        <a href="{{ route('instruktur.logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
        </a>

        <form id="logout-form" action="{{ route('instruktur.logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="topbar">
            <strong>👨‍🏫 Halo, {{ Auth::user()->name ?? 'Instruktur' }}</strong>
        </div>

        @yield('content')
    </div>

</body>
</html>
