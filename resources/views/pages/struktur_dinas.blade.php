@extends('layouts.main')

@section('title', 'Struktur Organisasi Dinas')

@section('content')

<section class="struktur-header position-relative text-center text-white">
  <div class="header-bg">
    <img src="{{ asset('assets/images/header_visi_misi.png') }}" class="w-100" alt="Header Visi Misi">
  </div>

  <div class="header-text-struktur position-absolute top-50 start-50 translate-middle text-uppercase" data-aos="zoom-in">
    <h1 class="fw-bold mb-1">Struktur Organisasi Dinas Kubu Raya</h1>
  </div>
</section>

<section class="struktur-content py-5 text-center">
  <div class="container">
    <h4 class="struktur-title fw-bold mb-4" data-aos="fade-right">
        Bagan Struktur Organisasi Dinas Pekerjaan Umum dan Penataan Ruang, Perumahan Rakyat dan Kawasan Permukiman Kabupaten Kubu Raya
    </h4>
    <p class="struktur-description text-muted mb-5" data-aos="fade-left">
        Struktur organisasi ini menggambarkan peran dan tanggung jawab setiap bagian di lingkungan Dinas Kubu Raya untuk mendukung visi dan misi serta meningkatkan kualitas pelayanan kepada masyarakat.
    </p>
    <div class="struktur-image" data-aos="zoom-in-up">
      <img src="{{ asset('assets/images/struktur_dinas.png') }}" alt="Struktur Organisasi Dinas" class="img-fluid">
    </div>
  </div>
</section>

@endsection
