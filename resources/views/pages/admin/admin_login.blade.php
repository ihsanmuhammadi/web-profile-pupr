@extends('layouts.admin_auth')

@section('title', 'Admin Login')

@section('content')

<div class="login-bg">
    <div class="login-wrapper">

        <div class="top-brand">
            <img src="{{ asset('assets/images/logo_kuburaya.png') }}" alt="Logo">
            <div class="top-brand-title">Dinas PUPR</div>
        </div>

        <div class="login-card">

            <h5 class="fw-bold text-center mb-3">Masuk ke Akun Anda</h5>
            <p class="text-muted text-center" style="font-size: 13px;">
                Gunakan akun yang telah terdaftar untuk mengakses sistem.
            </p>

            <form action="" method="" class="mt-3">
                @csrf

                <div class="mb-3">
                    <label class="fw-semibold mb-1">Email</label>
                    <input type="email" name="email" class="form-control form-control-login p-2"
                           placeholder="Masukkan Email Anda" required>
                </div>

                <div class="mb-4">
                    <label class="fw-semibold mb-1">Password</label>
                    <div class="password-wrapper">
                        <input type="password" name="password" class="form-control form-control-login p-2"
                               placeholder="Masukkan Password Anda" id="password-input" required>
                        <i class="bi bi-eye-slash toggle-password" id="togglePassword"></i>
                    </div>
                </div>

                <button type="submit" class="btn btn-login">
                    Masuk
                </button>
            </form>

        </div>

    </div>
</div>

@endsection
