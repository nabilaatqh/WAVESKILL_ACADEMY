@extends('layouts.admin')

@section('title', 'Dashboard Admin - WaveSkill Academy')

@section('content')
<style>
    /* ==== Kartu Statistik ==== */
    .stats-cards {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    .card-stat {
        background-color: #FFA017;
        border-radius: 12px;
        padding: 1.5rem 2rem;
        flex: 1;
        box-shadow: 3px 3px 8px rgba(0,0,0,0.1);
        color: white;
        font-weight: 700;
        font-size: 1.2rem;
        text-align: center;
        user-select: none;
        opacity: 0;
        transform: translateY(20px);
        animation: fadeUp 0.6s forwards;
    }
    .card-stat:nth-child(1) { animation-delay: 0.1s; }
    .card-stat:nth-child(2) { animation-delay: 0.3s; }
    .card-stat:nth-child(3) { animation-delay: 0.5s; }

    @keyframes fadeUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ==== Aktivitas Terbaru ==== */
    .activity-card {
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        padding: 1rem 1.5rem;
        margin-top: 1.5rem;
        width: 100%;
    }
    .activity-card h5 {
        color: #FFA017;
        font-weight: 700;
        margin-bottom: 1rem;
    }
    .activity-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.6rem 0;
        border-bottom: 1px solid #eee;
    }
    .activity-name {
        font-weight: 600;
        color: #333;
        flex: 1;
    }
    .activity-role {
        width: 100px;
        text-align: right;
    }

    /* ==== Badge Role Kustom ==== */
    .badge-role {
        padding: 6px 12px;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 12px;
        display: inline-block;
        color: white;
    }
    .badge-role.admin {
        background-color: #007bff;
    }
    .badge-role.instructor {
        background-color: #ffc107;
        color: black;
    }
    .badge-role.student {
        background-color: #dc3545;
    }

    /* ==== Badge Status ==== */
    .badge-status {
        padding: 6px 12px;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 12px;
        color: white;
        display: inline-block;
    }
    .badge-status.active {
        background-color: #28a745;
    }
    .badge-status.nonactive {
        background-color: #6c757d;
    }

</style>

<h3 style="color: white;">
    Halo Selamat Datang,<br>
    <strong>Admin : {{ Auth::guard('admin')->user()->name ?? '' }}</strong>
</h3>

<div class="stats-cards">
    <div class="card-stat">
        Admin
        <div class="number">{{ $countAdmin?? 0 }}</div>
    </div>
    <div class="card-stat">
        Instruktur
        <div class="number">{{ $countInstruktur ?? 0 }}</div>
    </div>
    <div class="card-stat">
        Student
        <div class="number">{{ $countPelajar ?? 0 }}</div>
    </div>
</div>

<div class="activity-card p-4 mt-4">
    <h5 class="mb-4" style="color: #FFA017; font-weight: 700;">Aktivitas Terbaru</h5>

    @forelse($latestActivities as $activity)
        <div class="activity-item d-flex justify-content-between align-items-center py-2 border-bottom">
            <span class="activity-name">{{ $activity->name }}</span>
            <span class="badge 
                @if($activity->role === 'instructor') bg-success
                @elseif($activity->role === 'student') bg-danger
                @elseif($activity->role === 'admin') bg-primary
                @else bg-secondary
                @endif">
                {{ ucfirst($activity->role) }}
            </span>
        </div>
    @empty
        <p class="text-muted text-center mb-0">Tidak ada aktivitas terbaru.</p>
    @endforelse
</div>

{{-- JS untuk interaksi notifikasi dan dropdown user --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Dropdown user profil toggle
        const userInfo = document.querySelector('.topbar .user-info');
        let dropdownVisible = false;

        if(userInfo){
            userInfo.addEventListener('click', () => {
                if(dropdownVisible){
                    closeDropdown();
                } else {
                    openDropdown();
                }
            });

            // Tutup dropdown jika klik di luar
            document.addEventListener('click', (e) => {
                if(!userInfo.contains(e.target)){
                    closeDropdown();
                }
            });

            function openDropdown(){
                if(!userInfo.querySelector('.dropdown-menu')){
                    const menu = document.createElement('div');
                    menu.classList.add('dropdown-menu');
                    menu.style.position = 'absolute';
                    menu.style.top = '60px';
                    menu.style.right = '0';
                    menu.style.background = '#FFA017';
                    menu.style.borderRadius = '8px';
                    menu.style.padding = '1rem';
                    menu.style.boxShadow = '0 2px 10px rgba(0,0,0,0.15)';
                    menu.style.color = 'white';
                    menu.style.minWidth = '150px';
                    menu.innerHTML = `
                        <a href="#" style="color:white; display:block; margin-bottom:0.5rem; text-decoration:none;">Profil</a>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" style="background:none; border:none; color:white; cursor:pointer; padding:0;">Logout</button>
                        </form>
                    `;
                    userInfo.appendChild(menu);
                }
                dropdownVisible = true;
            }

            function closeDropdown(){
                const menu = userInfo.querySelector('.dropdown-menu');
                if(menu){
                    menu.remove();
                }
                dropdownVisible = false;
            }
        }

        // Notifikasi bell hover efek
        const bellIcon = document.querySelector('.topbar .icon');
        if(bellIcon){
            bellIcon.addEventListener('mouseenter', () => {
                bellIcon.style.color = '#ff7b38';
                bellIcon.style.textShadow = '0 0 8px #ff7b38';
            });
            bellIcon.addEventListener('mouseleave', () => {
                bellIcon.style.color = 'white';
                bellIcon.style.textShadow = 'none';
            });
        }
    });
</script>
@endsection
