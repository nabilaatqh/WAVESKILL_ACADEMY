@extends('layouts.student')

@section('title', 'Daftar Grup Kelas')

@section('content')
<div class="container">
    <h2 class="mb-4 text-white">Daftar Grup Kelas</h2>

    @if ($groups->isEmpty())
        <div class="alert alert-info text-center text-white bg-transparent border-0">
            Belum ada grup yang bisa kamu ikuti saat ini.<br>
            Silakan tunggu verifikasi pembayaran oleh admin.
        </div>
    @else
        <div class="row g-4">
            @foreach ($groups as $group)
                <div class="col-md-6">
                    <div class="card bg-warning text-dark p-3 shadow-sm rounded">
                        @if ($group->course && $group->course->banner_image)
                            <img src="{{ asset('storage/' . $group->course->banner_image) }}"
                                alt="{{ $group->course->nama_course }}"
                                class="img-fluid rounded mb-3"
                                style="max-height: 150px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/default-course.png') }}"
                                alt="Default Image"
                                class="img-fluid rounded mb-3"
                                style="max-height: 150px; object-fit: cover;">
                        @endif

                        <h5 class="mb-2">{{ $group->course->nama_course }}</h5>

                        <p class="text-dark" style="font-size: 0.9rem;">
                            {{ Str::limit($group->course->deskripsi ?? 'Tidak ada deskripsi.', 150) }}
                        </p>

                        @if ($group->course->whatsapp_link)
                            <a href="{{ $group->course->whatsapp_link }}" target="_blank" class="btn btn-danger w-100 mt-3">Join Grup Whatsapp</a>
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
