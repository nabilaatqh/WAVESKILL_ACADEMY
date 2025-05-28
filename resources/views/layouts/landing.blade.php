<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'WaveSkill Academy')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Google Fonts & Bootstrap --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        /* Reset & Font */
        body {
            font-family: 'Poppins', sans-serif;
            background: #fff;
            margin: 0;
            padding: 0;
        }
        /* Topbar ala layout student */
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 72px;
            background-color: #ffb347;
            padding: 0 2rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        /* Brand */
        .brand {
            display: flex;
            align-items: center;
            color: #fff;
            text-decoration: none;
            padding: 60px;
        }
        .brand img {
            height: 44px;
            margin-right: 10px;
        }
        .brand-text {
            font-weight: 700;
            font-size: 1.5rem;
            color: #ffffff;
            line-height: 1;
            margin-bottom: 0;
        }
        /* Notifikasi */
        .notif-icon {
            position: relative;
            cursor: pointer;
            color: #fff;
            font-size: 1.5rem;
        }
        .notif-icon .badge {
            position: absolute;
            top: -4px;
            right: -6px;
            background: #dc3545;
            color: #fff;
            font-size: 0.6rem;
            padding: 2px 5px;
            border-radius: 50%;
        }
        /* Avatar & Name */
        .profile-container {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-top: 4px; 
            padding: 70px;
        }
        .profile-name {
            color: #fff;
            font-weight: 600;
            font-size: 1rem;
            line-height: 1.2;
            margin: 0;
            padding-top: 3px;
        }
        .nav-icon {
          width: 44px;
          height: 44px;
          border-radius: 50%;
          object-fit: cover;
          border: 2px solid white;
        }
    </style>
</head>
<body>

    {{-- ============= TOPBAR ============= --}}
    <header class="topbar">
        {{-- Brand / Logo --}}
        <a href="{{ url('/') }}" class="brand">
            <img src="{{ asset('image/logo_umkt.png') }}" alt="Logo WaveSkill">
            <h1 class="brand-text">WaveSkill Academy</h1>
        </a>

        <div class="d-flex align-items-center gap-3">
            {{-- Avatar dan Nama --}}
            <div class="profile-container">
                <p class="profile-name">{{ $student->first_name }} {{ $student->last_name }}</p>
                <button class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#profileModal">
                    <img
                        src="{{ isset($student) && $student->photo
                                ? asset('storage/' . ltrim(str_replace('public/', '', $student->photo), '/'))
                                : asset('images/avatar-placeholder.png') }}"
                        alt="Avatar"
                        class="nav-icon">
                </button>
            </div>
        </div>
    </header>

    {{-- ============= MODAL PROFIL ============= --}}
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title" id="profileModalLabel">Profil Saya</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body text-center">
            @if(!isset($student) || empty($student->first_name))
              <img src="{{ asset('images/id-card-clip-alt.png') }}"
                   style="width:100px;height:100px;opacity:.5;margin-bottom:10px"
                   alt="No profile">
              <p class="text-muted mb-3">Profilmu belum lengkap.</p>
              <a href="{{ route('student.profile.edit') }}" class="btn btn-primary">Isi Profil Sekarang</a>
            @else
              <img src="{{ $student->photo
                         ? asset('storage/' . ltrim(str_replace('public/', '', $student->photo), '/'))
                         : asset('images/avatar-placeholder.png') }}"
                   class="rounded-circle mb-3"
                   style="width:100px;height:100px;object-fit:cover;"
                   alt="Avatar">
              <h5>{{ $student->first_name }} {{ $student->last_name }}</h5>
              <p class="text-muted">{{ $student->email }}</p>
              <p class="text-muted">{{ $student->phone }}</p>
              <div class="modal-footer">
                  <form method="POST" action="{{ route('student.logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                  </form>
              </div>
                @endif
          </div>
        </div>
      </div>
    </div>

    {{-- ============= KONTEN HALAMAN ============= --}}
    <main>
        @yield('content')
    </main>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      tooltipTriggerList.forEach(function (el) {
        new bootstrap.Tooltip(el)
      })
    </script>
</body>
</html>
