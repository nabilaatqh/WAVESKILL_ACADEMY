@extends('layouts.instruktur')

@section('title', 'Edit Materi')

@section('content')
<div class="center-container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card" style="
        background: white;
        padding: 40px 40px 80px 40px;
        border-radius: 20px;
        max-width: 800px;
        min-height: 500px;
        width: 100%;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    ">
        <h3 class="text-center mb-4" style="font-size: 28px; margin-bottom: 40px;">Edit Materi</h3>



        <form action="{{ route('instruktur.materi.update', $materi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-3" style="margin-bottom: 20px;">
                <label class="form-label fw-semibold">Judul</label>
                <input type="text" name="judul" class="form-control" value="{{ $materi->judul }}" required>
            </div>

            <div class="form-group mb-3" style="margin-bottom: 20px;>
                <label class="form-label fw-semibold">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4" required>{{ $materi->deskripsi }}</textarea>
            </div>

            <div class="form-group mb-3" style="margin-bottom: 20px;>
                <label class="form-label fw-semibold">File Materi (opsional)</label>
                <input type="file" name="file" class="form-control">
            </div>

            <div class="form-group mb-4" style="margin-bottom: 20px;>
                <label class="form-label fw-semibold">Pilih Course</label>
                <select name="course_id" class="form-control" required>
                    @foreach($course as $c)
                        <option value="{{ $c->id }}" {{ $materi->course_id == $c->id ? 'selected' : '' }}>
                            {{ $c->nama_course }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-danger">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
