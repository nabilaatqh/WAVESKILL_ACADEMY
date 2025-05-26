@extends('layouts.admin')

@section('title', 'Dashboard Admin - WaveSkill Academy')

@section('content')
<style>
    /* === Statistik Cards === */
    .stats-cards {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }
    .card-stat {
        background: linear-gradient(135deg, #FFA017, #FF7B38);
        color: white;
        flex: 1 1 200px;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 6px 16px rgba(0,0,0,0.1);
        text-align: center;
        font-size: 1.2rem;
        font-weight: bold;
        position: relative;
        animation: fadeIn 0.8s ease-out forwards;
        opacity: 0;
        transform: translateY(20px);
    }
    .card-stat .number {
        font-size: 2rem;
        margin-top: 0.5rem;
        font-weight: 800;
    }
    .card-stat:nth-child(1) { animation-delay: 0.2s; }
    .card-stat:nth-child(2) { animation-delay: 0.4s; }
    .card-stat:nth-child(3) { animation-delay: 0.6s; }

    @keyframes fadeIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* === Aktivitas Terbaru === */
    .activity-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        padding: 2rem;
        margin-top: 2rem;
    }
    .activity-card .badge {
        padding: 6px 12px;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 12px;
    }
    .activity-card h5 {
        font-weight: 700;
        color: #FFA017;
        margin-bottom: 1.5rem;
    }
    .activity-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.8rem 0;
        border-bottom: 1px solid #eee;
    }
    .activity-name {
        font-weight: 600;
        color: #333;
    }

    .badge-role, .badge-status {
        font-size: 0.75rem;
        padding: 6px 12px;
        border-radius: 12px;
        font-weight: 600;
        display: inline-block;
    }
    .badge-role.admin { background-color: #007bff; color: white; }
    .badge-role.instructor { background-color: #ffc107; color: black; }
    .badge-role.student { background-color: #dc3545; color: white; }
    .badge-status.active { background-color: #28a745; color: white; }
    .badge-status.nonactive { background-color: #6c757d; color: white; }
</style>

<div class="container py-4">
    <h3 class="text-white mb-4">
        Halo Selamat Datang,<br>
        <strong>Admin : {{ Auth::guard('admin')->user()->name ?? '' }}</strong>
    </h3>

    <div class="stats-cards">
        <div class="card-stat">
            Admin
            <div class="number">{{ $countAdmin ?? 0 }}</div>
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

    <div class="activity-card">
        <h5>📌 Aktivitas Terbaru</h5>

        @forelse($latestActivities as $activity)
            <div class="activity-item">
                <span class="activity-name">{{ $activity->name }}</span>
                <span class="badge 
                    @if($activity->role === 'admin') bg-primary
                    @elseif($activity->role === 'instructor') bg-success
                    @elseif($activity->role === 'student') bg-danger
                    @else bg-secondary
                    @endif">
                    {{ ucfirst($activity->role) }}
                </span>
            </div>
        @empty
            <p class="text-center text-muted mb-0">Tidak ada aktivitas terbaru.</p>
        @endforelse
    </div>
</div>
@endsection
