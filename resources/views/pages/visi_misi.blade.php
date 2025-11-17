@extends('layouts.main')

@section('title', 'Visi & Misi')

@section('content')

<section class="visi-misi-header position-relative text-center text-white">
  <div class="header-bg">
    <img src="{{ asset('assets/images/header_visi_misi.png') }}" class="w-100" alt="Header Visi Misi">
  </div>
  <div class="header-overlay"></div>
  <div class="header-text position-absolute top-50 start-50 translate-middle text-uppercase" data-aos="zoom-in">
    <h1 class="fw-bold mb-1">Visi & Misi</h1>
    <h1 class="fw-bold ">Dinas Kubu Raya</h1>
  </div>
</section>

<section class="visi-misi-content">
  <div class="text-center py-5 px-3 bg-gray-light" data-aos="fade-right">
    <h2 class="fw-bold mb-4">Visi Dinas Kubu Raya</h2>
    <div class="divider mx-auto mb-5"></div>
    <p class="fw-bold text-uppercase text-dark mx-auto mb-4" style="max-width: 900px; font-size: 1.5rem;">
      “TERWUJUDNYA KABUPATEN KUBU RAYA YANG BAHAGIA, BERMARTABAT, TERDEPAN, BERKUALITAS, DAN RELIGIUS”
    </p>
  </div>

  <div class="text-center py-5 px-3 bg-white mt-4" data-aos="fade-left">
    <h2 class="fw-bold mb-4">Misi Dinas Kubu Raya</h2>
    <div class="divider mx-auto mb-5"></div>
    <div class="text-start mx-auto mb-5" style="max-width: 1000px; font-size: 1rem;">
      <ol class="lh-lg text-dark">
        <li>Meningkatkan budaya kerja dan tata kelola pemerintahan yang bersih dan berwibawa (good and clean governance).</li>
        <li>Meningkatkan pelayanan publik yang mendasar dan perbaikan kualitas hidup masyarakat.</li>
        <li>Meningkatkan kemampuan otonomi daerah untuk pembangunan yang berkeadilan dan berdasarkan pada nilai-nilai kearifan lokal.</li>
        <li>Meningkatkan penguatan aktivitas dan kelembagaan bernuansa religius di seluruh lapisan masyarakat.</li>
        <li>Meningkatkan penguatan peran perempuan untuk peningkatan kualitas dan kemandirian ekonomi.</li>
      </ol>
    </div>
  </div>
</section>

@endsection
