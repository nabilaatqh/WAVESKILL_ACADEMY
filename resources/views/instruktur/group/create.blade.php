@extends('layouts.instruktur')

@section('title', 'Tambah Group')

@section('content')
<h2>Tambah Group</h2>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('instruktur.group.store') }}" method="POST">
    @csrf

    <div>
        <label for="kelas_id">Pilih Kelas</label>
        <select name="kelas_id" id="kelas_id" required>
            <option value="">-- Pilih Kelas --</option>
            @foreach ($kelasList as $kelas)
                <option value="{{ $kelas->id }}" {{ old('kelas_id') == $kelas->id ? 'selected' : '' }}>
                    {{ $kelas->nama_kelas }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="whatsapp_link">Link WhatsApp</label>
        <input type="url" name="whatsapp_link" id="whatsapp_link" placeholder="https://chat.whatsapp.com/..." value="{{ old('whatsapp_link') }}" required>
    </div>

    <button type="submit">Simpan Group</button>
    <a href="{{ route('instruktur.group.index') }}">Batal</a>
</form>
@endsection
