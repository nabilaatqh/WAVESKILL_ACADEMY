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
            background-color: #54c7ef; /* Biru cerah untuk content */
        }

        .app-container {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* === Sidebar === */
        .sidebar {
            width: 70px; /* Lebar sidebar sesuai desain student */
            background-color: #ff9042; /* Orange */
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

        /* === Topbar === */
        .topbar {
            height: 56px; /* Sesuaikan dengan desain */
            background-color: #ffb347;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 0 20px;
            box-sizing: border-box;
            gap: 1rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            font-weight: 600;
        }

        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 1.5px solid #008080;
            cursor: pointer;
        }

        .notif-icon {
            position: relative;
            cursor: pointer;
            color: #333;
        }

        .notif-icon .badge {
            position: absolute;
            top: -6px;
            right: -6px;
            font-size: 0.6rem;
        }

        /* === Content === */
        .main-content-wrapper {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .content {
            padding: 2rem 2.5rem;
            height: calc(100vh - 56px);
            overflow-y: auto;
            box-sizing: border-box;
            background-color: #54c7ef; /* Biru cerah untuk content */
        }
    </style>
</head>
<body>
    <div class="app-container">
        {{-- Sidebar --}}
        <aside class="sidebar">
            <a href="{{ route('student.landingpage') }}" class="logo" title="Beranda">
                <img src="{{ asset('image/logo_umkt.png') }}" alt="Logo WaveSkill">
            </a>
            <a href="{{ route('student.dashboard') }}" class="{{ request()->routeIs('student.dashboard') ? 'active' : '' }}" title="Dashboard">
                <i class="fas fa-home"></i>
            </a>
            <a href="{{ route('student.groups.index') }}" class="{{ request()->routeIs('student.groups.*') ? 'active' : '' }}" title="Grup Kelas">
                <i class="fas fa-users"></i>
            </a>
            <a href="{{ route('student.certificates.index') }}" class="{{ request()->routeIs('student.certificates.*') ? 'active' : '' }}">
                <i class="fas fa-certificate"></i>
            </a>
            <a href="{{ route('student.profile.edit') }}" class="{{ request()->routeIs('student.profile') ? 'active' : '' }}" title="Profil">
                <i class="fas fa-user"></i>
            </a>
            <form method="POST" action="{{ route('student.logout') }}" class="mt-auto">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm rounded-circle" style="width: 45px; height: 45px;" title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>

        </aside>

        {{-- Main Content (Topbar + Content) --}}
        <div class="main-content-wrapper">
        <header class="topbar d-flex align-items-center justify-content-end gap-3 px-3" style="background-color: #FFA94D; height: 70px;">
            {{-- Notifikasi --}}
            <div class="notif-icon position-relative" style="cursor:pointer;" title="Notifikasi" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Notifikasi">
                <i class="fa-regular fa-bell fa-lg" style="color: white;"></i>
                <span class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle p-1" style="font-size: 0.7rem;">
                    3
                </span>
            </div>

            {{-- Profile --}}
            <div class="user-info d-flex align-items-center gap-2 dropdown">
                <img src="{{ $student && $student->photo
                            ? asset('storage/' . ltrim(str_replace('public/', '', $student->photo), '/'))
                            : asset('images/avatar-placeholder.png') }}"
                    class="rounded-circle object-fit-cover"
                    alt="User"
                    style="width: 38px; height: 38px; border: 2px solid #008080; cursor: pointer;"
                    id="profileDropdown"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                >
                <span class="text-white fw-semibold cursor-pointer" style="user-select:none;">{{ $student->name ?? 'Student' }}</span>

                {{-- Dropdown Menu --}}
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown" style="min-width: 220px;">
                    <li class="px-3 py-3 text-center">
                        @if($student && $student->photo)
                        <img src="{{ asset('storage/' . ltrim(str_replace('public/', '', $student->photo), '/')) }}" alt="Foto Profil" class="rounded-circle mb-2" style="width: 80px; height: 80px; object-fit: cover;">
                        @else
                        <img src="{{ asset('images/avatar-placeholder.png') }}" alt="Foto Profil" class="rounded-circle mb-2" style="width: 80px; height: 80px; object-fit: cover; opacity: 0.5;">
                        @endif
                        <h6 class="mb-1">{{ $student->first_name ?? '' }} {{ $student->last_name ?? '' }}</h6>
                        <small class="text-muted d-block">{{ $student->email ?? '' }}</small>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a href="{{ route('student.profile.edit') }}" class="dropdown-item text-center text-decoration-none">
                            Edit Profile
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('student.logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="dropdown-item text-center text-danger fw-bold">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </header>

        <main class="content">
            @yield('content')
        </main>
    </div>

    {{-- Tambahkan script Bootstrap untuk tooltip dan dropdown --}}
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
    @stack('scripts')
</body>
</html>
