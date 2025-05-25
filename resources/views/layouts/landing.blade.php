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
        body            {font-family:'Poppins',sans-serif;background:#fff;margin:0;padding:0;}
        .navbar         {background:#ffb347;padding:1rem 2rem;}
        .navbar-brand   {font-weight:700;font-size:1.4rem;color:#fff;}
        .nav-icon       {width:32px;height:32px;cursor:pointer;}
    </style>
</head>
<body>

{{-- ================= NAVBAR ================= --}}
<nav class="navbar d-flex justify-content-between align-items-center">
    {{-- Brand --}}
    <div class="navbar-brand d-flex align-items-center">
        <img src="{{ asset('image/logo_umkt.png') }}" style="height:40px;margin-right:8px">
        WaveSkill
    </div>

    {{-- Right side: Notif & Avatar --}}
    <div class="d-flex align-items-center">

        {{-- NOTIF (link ke halaman notifikasi) --}}
        {{-- <a href="{{ route('student.notifications.index') }}" 
           class="btn btn-link p-0 me-3 position-relative" style="color:#fff;">--}}
            <i class="fa-regular fa-bell fa-lg"></i>
            @php($unread = 3) {{-- contoh statis, nanti bisa dinamis --}}
            @if($unread > 0)    
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ $unread }}
                <span class="visually-hidden">unread notifications</span>
            </span>
            @endif
        </a>

        {{-- AVATAR (trigger modal profil) --}}
        <button class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#profileModal">
           <img src="{{ $student && $student->photo
              ? asset('storage/' . ltrim(str_replace('public/', '', $student->photo), '/'))
              : asset('images/avatar-placeholder.png') }}"
          class="nav-icon rounded-circle object-fit-cover" alt="User">
        </button>
    </div>
</nav>

{{-- ================= MODAL PROFIL ================= --}}
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="profileModalLabel">Profil Saya</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body text-center">
        @if(!$student || empty($student->first_name))
            {{-- PROFIL BELUM LENGKAP --}}
            <img src="{{ asset('images/id-card-clip-alt.png') }}"
                 style="width:100px;height:100px;opacity:.5;margin-bottom:10px" alt="No profile">
            <p class="text-muted mb-3">Profilmu belum lengkap.</p>
            <a href="{{ route('student.dashboard') }}" class="btn btn-primary">Isi Profil Sekarang</a>
        @else
            {{-- PROFIL LENGKAP --}}
            <img src="{{ $student->photo ? asset('storage/'.$student->photo) : asset('images/avatar-placeholder.png') }}"
                 class="rounded-circle mb-3"
                 style="width:110px;height:110px;object-fit:cover" alt="Foto">
            <h5>{{ $student->first_name }} {{ $student->last_name }}</h5>
            <p class="mb-1">{{ $student->email }}</p>
            <p class="mb-1">{{ $student->phone }}</p>
            <p class="mb-1">{{ $student->city }}</p>
            <p class="mb-1">{{ $student->about }}</p>
            <p class="mb-0">{{ $student->birth_place }}, {{ $student->birth_date }}</p>
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

{{-- ================ KONTEN HALAMAN ================ --}}
<main>
    @yield('content')
</main>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
