<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Dashboard Instruktur')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/instruktur.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('head')
</head>
<body>
    <div class="sidebar">
        <div class="logo">WS</div>

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
        <div class="topbar">
            <div class="notif" title="Notifikasi">
                <i class="fas fa-bell"></i>
            </div>

            <div class="profile dropdown-profile">
                @php
                    $foto = Auth::user()->foto;
                    $urlFoto = $foto ? asset('storage/' . $foto) : asset('images/avatar-default.png');
                @endphp
                <img src="{{ $urlFoto }}" alt="Avatar">
                <span class="name">{{ Auth::user()->name }}</span>
                <i class="fas fa-chevron-down"></i>

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
