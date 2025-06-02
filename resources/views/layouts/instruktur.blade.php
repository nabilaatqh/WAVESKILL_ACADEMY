<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Dashboard Instruktur')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/instruktur.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/backsite/instruktur/grup_kelas.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" href="{{ asset('image/logo.png') }}" type="image/png">
    <style>
        .dropdown-profile {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border: 1px solid #ccc;
            padding: 10px;
            min-width: 150px;
            display: none;
            border-radius: 6px;
            z-index: 999;
        }

        .dropdown-menu a,
        .dropdown-menu form button {
            display: block;
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            padding: 6px 10px;
            cursor: pointer;
            color: #333;
        }

        .dropdown-menu a:hover,
        .dropdown-menu form button:hover {
            background-color: #f5f5f5;
        }

        .profile:hover .dropdown-menu {
            display: block;
        }

        .profile img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
        }

        #materi-form.card,
        #project-form.card {
            display: none;
            width: 100%;
            max-width: 1100px;
            margin: 20px 0;
            padding: 2rem 1.5rem;
            border-radius: 16px;
            background-color: #ffffff;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.1);
        }

        /* From Uiverse.io by JasonMep */
        .button {
        color: #ecf0f1;
        font-size: 17px;
        background-color: #e67e22;
        border: 1px solid #f39c12;
        border-radius: 5px;
        cursor: pointer;
        padding: 12px 0; /* Sesuai padding awal kamu */
        box-shadow: 0px 6px 0px #d35400;
        transition: all 0.1s;
        width: 100%;        /* Agar tetap w-100 */
        font-weight: bold;  /* Agar tetap fw-bold */
        }

        .button:active {
        box-shadow: 0px 2px 0px #d35400;
        position: relative;
        top: 2px;
        }

        .button:hover {
        background-color: #d35400;
        color: white;
        }

        .btn-orange {
        border: 2px solid#f39c12;
        background-color: #e67e22;
        border-radius: 0.9em;
        cursor: pointer;
        padding: 0.4em 0.9em;
        transition: all ease-in-out 0.2s;
        font-size: 16px;
        }

        .btn-orange span {
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
        font-weight: 600;
        line-height: 1;
        }

        .btn-orange:hover {
        background-color: #e69500;
    }




    </style>
    @yield('head')
</head>
<body>

    <div class="sidebar">
        <!-- Logo -->
        <div class="logo text-center" style="margin-bottom: 20px;">
            <img src="{{ asset('image/logo.png') }}" alt="Logo" style="width: 65px; height: auto; background-color: transparent;">
        </div>
        <!-- Menu navigasi -->
        <a href="{{ route('instruktur.dashboard') }}" class="{{ request()->routeIs('instruktur.dashboard') ? 'active' : '' }}" title="Home">
            <i class="fas fa-home"></i>
        </a>
        <a href="{{ route('instruktur.group.index') }}" class="{{ request()->routeIs('instruktur.group.*') ? 'active' : '' }}" title="Group">
            <i class="fas fa-users"></i>
        </a>
        <a href="{{ route('instruktur.profile.edit') }}" class="{{ request()->routeIs('instruktur.profile.*') ? 'active' : '' }}" title="Profil">
            <i class="fas fa-user"></i>
        </a>

        @if(isset($selectedCourse) && $selectedCourse->whatsapp_group_link)
        <a href="{{ $selectedCourse->whatsapp_group_link }}" target="_blank" title="Grup WhatsApp" style="margin-top: 15px;">
            <i class="fab fa-whatsapp"></i>
        </a>
        @endif
    </div>

    <div class="main-content">
        <div class="topbar" style="height: 80px; padding: 16px 24px; background-color: #FFA500; display: flex; align-items: center;">
            <div class="profile dropdown-profile">
                @php
                    $instruktur = Auth::guard('instruktur')->user();
                    $fotoPath = $instruktur->foto;
                    $fotoUrl = $fotoPath && file_exists(public_path('storage/' . $fotoPath))
                        ? asset('storage/' . $fotoPath)
                        : 'https://ui-avatars.com/api/?name=' . urlencode($instruktur->nama_awal . ' ' . $instruktur->nama_akhir);
                @endphp

                <img src="{{ $fotoUrl }}" alt="Foto Profil">
                <span class="name" style="margin-left: 8px; color: white; font-weight: bold;">
                    {{ $instruktur->nama_awal }}
                </span>
                <i class="fas fa-chevron-down" style="margin-left: 8px;"></i>

                <div class="dropdown-menu">
                    <a href="{{ route('instruktur.profile.edit') }}">
                        <i class="fas fa-user-circle"></i> Edit Profil
                    </a>
                    <form method="POST" action="{{ route('instruktur.logout') }}">
                        @csrf
                        <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="content-area">
            @yield('content')
        </div>
    </div>

    @stack('scripts')
    @yield('scripts')
</body>
</html>
