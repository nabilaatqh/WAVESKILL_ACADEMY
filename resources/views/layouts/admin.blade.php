<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f6f8fa;
        }
        .sidebar {
            width: 220px;
            background-color: #008080;
            color: white;
            height: 100vh;
            padding: 1rem;
        }
        .sidebar a {
            color: white;
            display: block;
            margin: 0.5rem 0;
            text-decoration: none;
        }
        .sidebar a:hover {
            text-decoration: underline;
        }
        .content {
            padding: 2rem;
        }
    </style>
</head>
<body>
<div class="d-flex">
    <div class="sidebar">
        <h4>Admin Panel</h4>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.users.index') }}">Kelola User</a>
        {{-- Tambahkan menu lain di sini --}}
    </div>
    <div class="flex-grow-1 content">
        @yield('content')
    </div>
</div>
</body>
</html>