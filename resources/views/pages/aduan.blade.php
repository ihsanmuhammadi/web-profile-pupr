@extends('layouts.main')

@section('title', 'Aduan Masyarakat')

@section('content')

<section class="py-5 mt-5">
    <div class="container col-lg-6 col-md-8 col-sm-10 mx-auto">

        <div class="text-center mb-5 mt-5">
            <h1 class="fw-bold">Aduan Masyarakat</h1>
            <p class="text-dark-50 mx-auto fs-5">
                Sampaikan aduan, keluhan, atau masukan Anda untuk <br>meningkatkan kualitas layanan publik.
            </p>
        </div>

        <form action="{{ route('complaints.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="nama" class="form-label fw-medium text-dark fs-5">Nama Lengkap</label>
                <input type="text"
                       name="nama"
                       class="form-control form-control-lg custom-input-field"
                       id="nama"
                       placeholder="Masukkan Nama Lengkap Anda"
                       required>
            </div>

            <div class="mb-4">
                <label for="email" class="form-label fw-medium text-dark fs-5">Email</label>
                <input type="email"
                       name="email"
                       class="form-control form-control-lg custom-input-field"
                       id="email"
                       placeholder="Masukkan Email Anda"
                       required>
            </div>

            <div class="mb-5">
                <label for="pesan" class="form-label fw-medium text-dark fs-5">Pesan</label>
                <textarea class="form-control custom-textarea-field"
                          name="pesan"
                          id="pesan"
                          rows="8"
                          placeholder="Masukkan Pesan yang Akan Anda Kirim..."
                          required></textarea>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-outline-success rounded-pill px-4 py-2 fw-medium">
                    Kirim
                </button>
            </div>
        </form>
    </div>
</section>
@endsection

<div id="successOverlay" class="success-overlay d-none">
  <div class="success-card bg-white rounded-4 p-5 text-center shadow-lg position-relative">
    <button id="closeSuccess" class="btn-close position-absolute top-0 end-0 m-3" aria-label="Close"></button>
    <p class="text-dark mb-0">Aduan berhasil disimpan! Kami menghargai partisipasi anda dan akan menindaklanjuti sesuai prosedur.</p>
    <div class="icon-wrapper mb-3 mt-5">
      <span class="material-symbols-outlined shine-icon text-success">star_shine</span>
    </div>
  </div>
</div>

@if (session('success'))
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('successOverlay').classList.remove('d-none');
});

document.getElementById('closeSuccess')?.addEventListener('click', function () {
    document.getElementById('successOverlay').classList.add('d-none');
});

</script>
@endif
