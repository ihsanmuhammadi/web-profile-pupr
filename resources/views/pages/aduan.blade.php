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
