<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'Student Panel - WaveSkill')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #54c7ef;
        }

        .app-container {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            width: 70px;
            background-color: #ff9042;
            color: white;
            padding: 1rem 0.3rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2rem;
            position: sticky;
            top: 0;
            height: 100vh;
            box-sizing: border-box;
        }

        .sidebar .logo {
            width: 50px;
            height: 50px;
            background-color: white;
            border-radius: 50%;
            margin-bottom: 1rem;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .sidebar .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .sidebar a {
            color: white;
            font-size: 1.8rem;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            transition: background-color 0.2s;
            text-decoration: none;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background-color: #e67e22;
        }

        .topbar {
            height: 70px;
            background-color: #ffb347;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
            box-sizing: border-box;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .profile-container {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border: 2px solid rgba(255, 255, 255, 0.6);
            border-radius: 50px;
            padding: 4px 10px 4px 12px;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .profile-name {
            color: #fff;
            font-weight: 600;
            margin: 0;
        }

        .nav-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
        }

        .main-content-wrapper {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .content {
            padding: 2rem 2.5rem;
            height: calc(100vh - 70px);
            overflow-y: auto;
            box-sizing: border-box;
            background-color: #54c7ef;
        }
    </style>
</head>
<body>
<div class="app-container">
    <aside class="sidebar">
        <div class="logo">
            <img src="{{ asset('image/logo_umkt.png') }}" alt="Logo WaveSkill">
        </div>
        <a href="{{ route('student.dashboard') }}" class="{{ request()->routeIs('student.dashboard') ? 'active' : '' }}" title="Dashboard">
            <i class="fas fa-home"></i>
        </a>
        <a href="{{ route('student.groups.index') }}" class="{{ request()->routeIs('student.groups.*') ? 'active' : '' }}" title="Grup Kelas">
            <i class="fas fa-users"></i>
        </a>
        <a href="{{ route('student.certificates.index') }}" 
        class="{{ request()->routeIs('student.certificates.*') ? 'active' : '' }}" 
        title="Sertifikat">
            <i class="fas fa-certificate"></i>
        </a>
        <a href="{{ route('student.profile.edit') }}" class="{{ request()->routeIs('student.profile') ? 'active' : '' }}" title="Profil">
            <i class="fas fa-user"></i>
        </a>
        <a href="{{ route('student.landingpage') }}" class="text-white" title="Kembali ke Landing">
            <i class="fas fa-arrow-left"></i>
        </a>
    </aside>

    <div class="main-content-wrapper">
        <header class="topbar">
            <div></div>
            <div class="profile-container">
                <p class="profile-name">{{ $student->first_name ?? 'Student' }} {{ $student->last_name ?? '' }}</p>
                <button class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#profileModal">
                    <img src="{{ isset($student) && $student->photo ? asset('storage/' . ltrim(str_replace('public/', '', $student->photo), '/')) : asset('images/avatar-placeholder.png') }}" alt="Avatar" class="nav-icon">
                </button>
            </div>
        </header>

        <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="profileModalLabel">Profil Saya</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        @if(!$student || empty($student->first_name))
                            <img src="{{ asset('images/id-card-clip-alt.png') }}" style="width:100px;height:100px;opacity:.5;margin-bottom:10px" alt="No profile">
                            <p class="text-muted mb-3">Profilmu belum lengkap.</p>
                            <a href="{{ route('student.profile.edit') }}" class="btn btn-primary">Isi Profil Sekarang</a>
                        @else
                            <img src="{{ $student->photo ? asset('storage/' . ltrim(str_replace('public/', '', $student->photo), '/')) : asset('images/avatar-placeholder.png') }}" class="rounded-circle mb-3" style="width:100px;height:100px;object-fit:cover;" alt="Avatar">
                            <h5>{{ $student->first_name }} {{ $student->last_name }}</h5>
                            <p class="text-muted">{{ $student->email }}</p>
                            <p class="text-muted">{{ $student->phone }}</p>
                            <p class="text-muted">{{ $student->city }}</p>
                            <p class="text-muted">{{ $student->birth_place }}, {{ $student->birth_date }}</p>
                            <p class="mb-1">Bio saya:<br>{{ $student->about }}</p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <form method="POST" action="{{ route('student.logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <main class="content">
            @yield('content')
        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
