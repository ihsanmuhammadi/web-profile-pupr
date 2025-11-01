@extends('layouts.main')

@section('title', 'Struktur Organisasi Bidang')

@section('content')

<section class="struktur-header position-relative text-center text-white">
  <div class="header-bg">
    <img src="{{ asset('assets/images/header_visi_misi.png') }}" class="w-100" alt="Header Visi Misi">
  </div>

  <div class="header-text-struktur position-absolute top-50 start-50 translate-middle text-uppercase" data-aos="zoom-in">
    <h1 class="fw-bold mb-1">Struktur Organisasi Bidang Perumahan & Kawasan Pemukiman </h1>
  </div>
</section>

<section class="struktur-content py-5 text-center">
  <div class="container">
    <h4 class="struktur-title fw-bold mb-4" data-aos="fade-right">
        Bagan Struktur Organisasi Dinas Pekerjaan Umum dan Penataan Ruang, Perumahan Rakyat dan Kawasan Permukiman Kabupaten Kubu Raya <br>
        <span class="highlight-text">(Bidang Perumahan & Kawasan Pemukiman)</span>
    </h4>
    <p class="struktur-description text-muted mb-5" data-aos="fade-left">
        Bidang ini mengurus pembangunan perumahan serta penataan lingkungan permukiman agar masyarakat dapat tinggal di kawasan yang lebih layak, tertata, dan nyaman.
    </p>
    <div class="struktur-image" data-aos="zoom-in-up">
      <img src="{{ asset('assets/images/struktur_bidang.png') }}" alt="Struktur Organisasi Bidang" class="img-fluid">
    </div>
  </div>
</section>

@endsection
