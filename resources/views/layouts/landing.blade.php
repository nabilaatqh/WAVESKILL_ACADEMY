@php
    use Illuminate\Support\Facades\Auth;
    $student = Auth::guard('student')->user();
@endphp

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
    <link rel="stylesheet" href="{{ asset('frontsite/student/landing.css') }}">

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
                <p class="profile-name">{{ $student->first_name ?? '' }} {{ $student->last_name ?? '' }}</p>
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
                  {{-- Form Logout: tombol diubah menjadi type="button" dan diberi id --}}
                  <form id="logout-form" method="POST" action="{{ route('student.logout') }}">
                    @csrf
                    <button type="button" id="logout-button" class="btn btn-danger">Logout</button>
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

    {{-- Bootstrap JS & SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Script konfirmasi Logout dengan SweetAlert2 --}}
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1) Ambil tombol logout dan form logout
        const logoutButton = document.getElementById('logout-button');
        const logoutForm   = document.getElementById('logout-form');

        if (logoutButton && logoutForm) {
            logoutButton.addEventListener('click', function(e) {
                e.preventDefault(); // cegah form submit otomatis

                // 2) Tampilkan SweetAlert konfirmasi
                Swal.fire({
                    title: 'Yakin ingin logout?',
                    text: 'Anda akan keluar dari sesi ini.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, logout',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // 3) Jika dikonfirmasi, submit form logout
                        logoutForm.submit();
                    }
                    // Jika dibatalkan, tidak ada aksi
                });
            });
        }
    });
    </script>

    @stack('scripts')
</body>
</html>
