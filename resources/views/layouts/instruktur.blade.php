<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard Instruktur')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles -->
    <link href="{{ asset('css/instruktur.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">LOGO WAVESKILL</div>
        <ul class="nav">
            <li>
                <a href="{{ route('instruktur.dashboard') }}"
                   class="{{ request()->routeIs('instruktur.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                </a>
            </li>
            <li>
                <a href="{{ route('instruktur.kelas.index') }}"
                   class="{{ request()->routeIs('instruktur.kelas.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                </a>
            </li>
            <li>
                <a href="{{ route('instruktur.group.index') }}"
                   class="{{ request()->routeIs('instruktur.group.*') ? 'active' : '' }}">
                    <i class="fas fa-book-open"></i>
                </a>
            </li>
            <li>
                <a href="{{ route('instruktur.project.index') }}"
                   class="{{ request()->routeIs('instruktur.project.*') ? 'active' : '' }}">
                    <i class="fas fa-folder-plus"></i>
                </a>
            </li>
            <li>
                <a href="{{ route('instruktur.profile.edit') }}"
                   class="{{ request()->routeIs('instruktur.profile.*') ? 'active' : '' }}">
                    <i class="fas fa-user"></i>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <div class="user-info">
                <i class="fas fa-bell"></i>
                <div class="user-name">
                    <a href="{{ route('instruktur.profile.edit') }}" style="color: inherit; text-decoration: none;">
                        {{ Auth::user()->name }} <i class="fas fa-chevron-down"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="content px-4 py-3">
            @yield('content')
        </div>
    </div>
</body>
</html>
