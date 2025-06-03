@extends('layouts.landing')

@section('title', 'Pembayaran Kursus')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">💳 Pembayaran Kursus: {{ $course->nama_course ?? $course->title }}</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="text-center mb-4">
        <p>Silakan scan QRIS berikut untuk melakukan pembayaran:</p>
        <img src="{{ $qrisImageUrl }}" alt="QR QRIS" class="img-fluid" style="max-width: 300px;">
    </div>

    <form id="payment-form" method="POST" action="{{ route('student.enroll.process', $course->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="bukti_transfer" class="form-label">Upload Bukti Pembayaran</label>
            <input type="file" name="bukti_transfer" id="bukti_transfer" class="form-control" required>
            @error('bukti_transfer')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tombol Kirim diubah type="button" dan diberi id --}}
        <button type="button" id="submit-payment-button" class="btn btn-primary">Kirim Bukti Pembayaran</button>
    </form>

    <p class="mt-3 text-muted"><small>Catatan: Tunggu verifikasi admin maksimal 1x24 jam.</small></p>
</div>
@endsection

@push('scripts')
    {{-- 1) Pemuatan SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil tombol dan form
        const submitBtn = document.getElementById('submit-payment-button');
        const paymentForm = document.getElementById('payment-form');

        if (submitBtn && paymentForm) {
            submitBtn.addEventListener('click', function(e) {
                e.preventDefault(); // cegah langsung submit

                // 2) Tampilkan SweetAlert konfirmasi
                Swal.fire({
                    title: 'Yakin lakukan pembayaran?',
                    text: 'Pastikan bukti transfer sudah benar sebelum mengirim.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, kirim',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika user memilih “Ya, kirim”, submit form
                        paymentForm.submit();
                    }
                    // Jika memilih “Batal”, tidak terjadi apa‐apa
                });
            });
        }
    });
    </script>
@endpush
