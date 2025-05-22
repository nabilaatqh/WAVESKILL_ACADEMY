@extends('layouts.instruktur')

@section('title', 'Daftar Group')

@section('content')
    <h2>Daftar Group</h2>

    @if($groups->count())
        <div class="group-list">
            @foreach ($groups as $group)
                <div class="group-card">
                    <h4>{{ $group->kelas->nama_kelas ?? 'Kelas Tidak Diketahui' }}</h4>
                    <p>
                        Link WhatsApp: 
                        @if($group->whatsapp_link)
                            <a href="{{ $group->whatsapp_link }}" target="_blank">{{ $group->whatsapp_link }}</a>
                        @else
                            <span>Belum ada link WhatsApp</span>
                        @endif
                    </p>
                </div>
            @endforeach
        </div>
    @else
        <p>Belum ada group yang tersedia.</p>
    @endif
@endsection
