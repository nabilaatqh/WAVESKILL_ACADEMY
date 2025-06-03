<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'Student Panel - WaveSkill')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('frontsite/student/studentlayout.css') }}">
    
</head>
<body>
<div class="app-container">
    <aside class="sidebar">
        <div class="logo">
            <img src="{{ asset('image/logo_umkt.png') }}" alt="Logo WaveSkill">
        </div>
        <a href="{{ route('student.dashboard') }}" class="{{ request()->routeIs('student.dashboard') ? 'active' : '' }}" title="Dashboard">
            <i class="fas fa-home"></i>
        </a>
        <a href="{{ route('student.groups.index') }}" class="{{ request()->routeIs('student.groups.*') ? 'active' : '' }}" title="Grup Kelas">
            <i class="fas fa-users"></i>
        </a>
        <a href="{{ route('student.certificates.index') }}" class="{{ request()->routeIs('student.certificates.*') ? 'active' : '' }}" title="Sertifikat">
            <i class="fas fa-certificate"></i>
        </a>
        <a href="{{ route('student.profile.edit') }}" class="{{ request()->routeIs('student.profile') ? 'active' : '' }}" title="Profil">
            <i class="fas fa-user"></i>
        </a>
        <a href="{{ route('student.landingpage') }}" class="text-white" title="Kembali ke Landing">
            <i class="fas fa-arrow-left"></i>
        </a>
    </aside>

    <div class="main-content-wrapper">
        <header class="topbar">
            <div></div>
            <div class="profile-container">
                <p class="profile-name">{{ $student->first_name ?? 'Student' }} {{ $student->last_name ?? '' }}</p>
                <button class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#profileModal">
                    <img src="{{ isset($student) && $student->photo ? asset('storage/' . ltrim(str_replace('public/', '', $student->photo), '/')) : asset('images/avatar-placeholder.png') }}" alt="Avatar" class="nav-icon">
                </button>
            </div>
        </header>

        <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="profileModalLabel">Profil Saya</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        @if(!$student || empty($student->first_name))
                            <img src="{{ asset('images/id-card-clip-alt.png') }}" style="width:100px;height:100px;opacity:.5;margin-bottom:10px" alt="No profile">
                            <p class="text-muted mb-3">Profilmu belum lengkap.</p>
                            <a href="{{ route('student.profile.edit') }}" class="btn btn-primary">Isi Profil Sekarang</a>
                        @else
                            <img src="{{ $student->photo ? asset('storage/' . ltrim(str_replace('public/', '', $student->photo), '/')) : asset('images/avatar-placeholder.png') }}" class="rounded-circle mb-3" style="width:100px;height:100px;object-fit:cover;" alt="Avatar">
                            <h5>{{ $student->first_name }} {{ $student->last_name }}</h5>
                            <p class="text-muted">{{ $student->email }}</p>
                            <p class="text-muted">{{ $student->phone }}</p>
                            <p class="text-muted">{{ $student->city }}</p>
                            <p class="text-muted">{{ $student->birth_place }}, {{ $student->birth_date }}</p>
                            <p class="mb-1">Bio saya:<br>{{ $student->about }}</p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <!-- Form Logout sudah diubah: button bertipe button dan dikasih ID -->
                        <form id="logout-form" method="POST" action="{{ route('student.logout') }}">
                            @csrf
                            <button type="button" id="logout-button" class="btn btn-danger">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <main class="content">
            @yield('content')
        </main>
    </div>
</div>

<!-- Bootstrap JS dan SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Script konfirmasi Logout dengan SweetAlert2 -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const logoutButton = document.getElementById('logout-button');
    const logoutForm   = document.getElementById('logout-form');

    if (logoutButton && logoutForm) {
        logoutButton.addEventListener('click', function(e) {
            e.preventDefault(); // Mencegah langsung submit

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
                    logoutForm.submit();
                }
            });
        });
    }
});
</script>

@stack('scripts')
</body>
</html>
