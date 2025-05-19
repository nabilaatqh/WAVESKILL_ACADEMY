<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Instruktur')</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
    body { background-color: #1e1e1e; }

    .sidebar {
      position: fixed; left: 0; top: 0; height: 100vh; width: 70px;
      background-color: #FF9F29; display: flex; flex-direction: column;
      align-items: center; padding-top: 20px;
    }

    .sidebar img.logo { width: 40px; margin-bottom: 20px; }

    .sidebar nav { display: flex; flex-direction: column; gap: 20px; margin-top: 40px; }
    .sidebar nav a {
      width: 30px; height: 30px; background-color: #ffffff33;
      border-radius: 8px; display: flex; align-items: center; justify-content: center;
    }

    .topbar {
      margin-left: 70px; background-color: #FFA447; padding: 16px 24px;
      color: white; display: flex; justify-content: space-between; align-items: center;
    }

    .content {
      margin-left: 70px; padding: 20px;
      background-color: #4AC9FF;
      min-height: calc(100vh - 60px);
    }

    .class-card {
      background-color: #FF9F29; border-radius: 10px; padding: 20px;
      color: white; margin-bottom: 20px;
    }

    .class-card img {
      width: 100%; border-radius: 10px; margin-bottom: 10px;
    }

    .tabs {
      display: flex; gap: 10px; margin-bottom: 20px;
    }

    .tabs button {
      border: none; border-radius: 15px; padding: 5px 15px;
      cursor: pointer; font-weight: bold;
    }

    .tabs .active { background-color: #FF9F29; color: white; }

    .search-box {
      background: white; border-radius: 10px; padding: 10px; margin-bottom: 20px;
    }

    .accordion {
      background-color: #FFF176; border: none; margin-bottom: 10px;
      border-radius: 10px; padding: 15px; cursor: pointer; width: 100%;
      font-weight: bold; text-align: left;
    }
  </style>
</head>

<body>
  <div class="sidebar">
    <img class="logo" src="{{ asset('images/logo.png') }}" alt="Logo WaveSkill" />
    <nav>
      <a href="{{ route('instruktur.dashboard') }}"><img src="{{ asset('images/icon-home.png') }}" alt="Home" /></a>
      <a href="#"><img src="{{ asset('images/icon-user.png') }}" alt="Users" /></a>
      <a href="#"><img src="{{ asset('images/icon-settings.png') }}" alt="Settings" /></a>
    </nav>
  </div>

  <div class="topbar">
    <div>Halo, <strong>{{ Auth::user()->name ?? 'Instruktur' }}</strong></div>
    <div><img src="{{ asset('images/avatar.png') }}" alt="User" style="border-radius: 50%; width: 32px;" /> {{ Auth::user()->name ?? 'Instruktur' }}</div>
  </div>

  <div class="content">
    @yield('content')
  </div>
</body>
</html>
