<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'Admin Panel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #4ED7F1;
        }

        .app-container {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* === Sidebar === */
        .sidebar {
            width: 80px;
            background-color: #FFA017;
            color: white;
            padding: 1rem 0.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2rem;
            position: sticky;
            top: 0;
            height: 100vh;
        }

        .sidebar .logo {
            width: 50px;
            height: 50px;
            background-color: white;
            border-radius: 50%;
            margin-bottom: 1rem;
        }

        .sidebar a {
            color: white;
            font-size: 1.4rem;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            transition: background-color 0.2s;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background-color: #e67e22;
        }

        /* === Topbar === */
        .topbar {
            height: 70px;
            background-color: #FFA94D;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 0 2rem;
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
        }

        .logout-btn {
            background-color: #dc3545;
            border: none;
            color: white;
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* === Content === */
        .main-content-wrapper {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .content {
            padding: 2rem 3rem;
            background-color: #eaf9fc;
            height: calc(100vh - 70px);
            overflow-y: auto;
        }

        /* === Tambahan gaya sebelumnya === */
        .badge-instructor {
            background-color: #198754;
            color: white;
            padding: 0.3rem 0.7rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .badge-Student {
            background-color: #dc3545;
            color: white;
            padding: 0.3rem 0.7rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .badge-role {
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
            text-align: center;
            color: white;
        }

        .badge-role.admin { background-color: #007bff; }
        .badge-role.instructor { background-color: #198754; }
        .badge-role.student { background-color: #dc3545; }

        .badge-status {
            padding: 6px 12px;
            border-radius: 10px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
            color: white;
        }

        .badge-status.active { background-color: #28a745; }
        .badge-status.nonactive { background-color: #6c757d; }

        .table td, .table th {
            vertical-align: middle !important;
        }

        .custom-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .tab-link {
            padding: 8px 20px;
            border-radius: 20px;
            background-color: #e9ecef;
            color: #333;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s ease;
        }

        .tab-link:hover {
            background-color: #ffc107;
            color: #fff;
        }

        .tab-link.active {
            background-color: #FFA017;
            color: #fff;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .content {
            padding: 2rem 3rem;
            background-color: #4ED7F1;
            height: calc(100vh - 70px);
            overflow-y: auto;
        }
        .logo {
            width: 60px;
            height: 60px;
            margin: 20px auto; /* center horizontally */
            border-radius: 50%;
            overflow: hidden;
            background-color: #fff; /* fallback if image fails */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <div class="app-container">
        <aside class="sidebar">
            <div class="logo">
                <img src="{{ asset('images/admin/ilustrasi_login.png') }}" alt="Logo WaveSkill">
            </div>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
            </a>
            <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
            </a>
            <a href="{{ route('admin.course.index') }}" class="{{ request()->routeIs('admin.course.*') ? 'active' : '' }}">
                <i class="fas fa-chalkboard-teacher"></i>
            </a>
            <a href="{{ route('admin.enrollments.index') }}" class="{{ request()->routeIs('admin.enrollments.*') ? 'active' : '' }}">
                <i class="fas fa-receipt"></i>
            </a>
            <a href="{{ route('admin.pengaturan.index') }}" class="{{ request()->routeIs('admin.pengaturan.index') ? 'active' : '' }}">
                <i class="fas fa-user-cog"></i>
            </a>
        </aside>

        <div class="main-content-wrapper">
            <header class="topbar">
                <div class="user-info">
                    <i class="fas fa-bell"></i>
                    <img src="{{ asset(Auth::user()->foto ?? 'images/avatar-default.png') }}" alt="Avatar" class="rounded-circle" width="40" height="40">
                    <span>{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</span>
                </div>
            </header>

            <main class="content">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>