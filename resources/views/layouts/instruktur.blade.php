<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Dashboard Instruktur')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/instruktur.css') }}" rel="stylesheet">
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
    </div>

    <div class="main-content">
        <div class="topbar">
            <div class="notif" title="Notifikasi">
                <i class="fas fa-bell"></i>
            </div>
            <div class="profile">
                <img src="{{ asset('images/avatar-default.png') }}" alt="Avatar" />
                <span class="name">{{ Auth::user()->name }}</span>
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>

        <div class="content-area">
            @yield('content')
        </div>
    </div>

    @yield('scripts')
</body>
</html>
