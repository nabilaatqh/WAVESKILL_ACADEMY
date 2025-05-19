<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student - WaveSkill')</title>

    {{-- Bootstrap & Font Awesome --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    {{-- Tambahan CSS --}}
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f8fb;
        }
        .sidebar {
            height: 100vh;
            background-color: #008080;
            color: white;
        }
        .sidebar a {
            color: white;
            display: block;
            padding: 10px 15px;
            text-decoration: none;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #006666;
        }
        .content {
            padding: 2rem;
        }
        .topbar {
            background-color: #ffffff;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
        }
    </style>

    @stack('styles')
</head>
<body>
<div class="d-flex">
    {{-- Sidebar --}}
    <div class="sidebar p-3">
        <h5 class="text-white mb-4">👩‍🎓 WaveSkill</h5>
        <a href="{{ route('student.dashboard') }}" class="{{ request()->routeIs('student.dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i> Dashboard</a>
        {{-- <a href="{{ route('student.kelas.index') }}">Kelas</a> --}}
        {{-- <a href="{{ route('student.komunikasi.index') }}"><i class="fas fa-comments"></i> Komunikasi</a> --}}
        {{-- <a href="{{ route('student.pengaturan.index') }}"><i class="fas fa-cog"></i> Pengaturan</a> --}}
        <form action="{{ route('student.logout') }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-light btn-sm w-100"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </form>
    </div>

    {{-- Main Content --}}
    <div class="flex-grow-1">
        <div class="topbar">
            <span>Halo, {{ Auth::guard('student')->user()->name ?? 'Student' }}</span>
        </div>
        <div class="content">
            @yield('content')
        </div>
    </div>
</div>

@stack('scripts')
</body>
</html>