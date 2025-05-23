@extends('layouts.student')

@section('title', 'Daftar Grup Kelas')

@section('content')
<div class="container">
    <h2 class="mb-4 text-white">Daftar Grup Kelas</h2>

    @if ($groups->isEmpty())
        <p class="text-white">Belum ada grup yang kamu ikuti.</p>
    @else
        <div class="row g-4">
            @foreach ($groups as $group)
                <div class="col-md-6">
                    <div class="card bg-warning text-dark p-3 rounded" style="border-radius: 12px;">
                        @if ($group->course->image)
                            <img src="{{ asset('images/' . $group->course->image) }}" alt="{{ $group->course->title }}" class="img-fluid rounded mb-3" style="max-height: 150px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/default-course.png') }}" alt="Default Image" class="img-fluid rounded mb-3" style="max-height: 150px; object-fit: cover;">
                        @endif

                        <h5 class="mb-2">{{ $group->course->title }}</h5>

                        <p style="font-size: 0.9rem; color: #4a4a4a;">
                            {{ Str::limit($group->course->description, 150) }}
                        </p>

                        @if ($group->whatsapp_link)
                            <a href="{{ $group->whatsapp_link }}" target="_blank" class="btn btn-danger w-100 mt-3">Join Grup Whatsapp</a>
                        @else
                            <button class="btn btn-secondary w-100 mt-3" disabled>Tidak ada link WA</button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
    .container {
        max-width: 900px;
    }
</style>
@endsection
