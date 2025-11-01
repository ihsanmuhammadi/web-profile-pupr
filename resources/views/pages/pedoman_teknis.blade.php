@extends('layouts.main')

@section('title', 'Pedoman Spesifikasi Teknis')

@section('content')

<section class="pedoman-header position-relative text-center text-white mt-5">
  <img src="{{ asset('assets/images/header_pedoman.png') }}" class="w-100 header-bg" alt="Header Pedoman Teknis">
  <div class="header-overlay"></div>
  <div class="header-text-pedoman position-absolute top-50 start-50 translate-middle text-uppercase" data-aos="zoom-in">
    <h1 class="fw-bold mb-1">Pedoman <br>Spesifikasi <br>Teknis</h1>
  </div>
</section>

<section class="pedoman-content py-5">
  <div class="container col-lg-9 mx-auto">

    <div class="d-flex gap-3 mb-4 navigasi" data-aos="fade-right">
      <a href="{{ route('pedoman.teknis') }}" class="btn active-btn">Pedoman Spesifikasi Teknis</a>
      <a href="{{ route('pedoman.daerah') }}" class="btn btn-outline-secondary">Pedoman Spesifikasi Daerah</a>
    </div>

    <h2 class="fw-bold mt-5 mb-5 text-center" data-aos="zoom-in">Pedoman Spesifikasi Teknis Dinas PUPR Kubu Raya</h2>

    <div class="ratio ratio-16x9 mb-3" data-aos="zoom-in-up">
      <iframe width="560" height="315" src="https://www.youtube.com/embed/DgSyV_eqeFU?si=-S_5gn3LbGEJUuLU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>

    <h4 class="fw-semibold mb-1 mt-4">Pedoman Spesifikasi Teknis Dinas PUPR Kubu Raya</h4>
    <p class="text-muted mb-2 small">
      Youtube | Dinas PUPR Kubu Raya | 10,9 ribu kali dilihat | 24 Maret 2025
    </p>

    <h6 class="mb-5 mt-5">
        Link Youtube:
        <a id="youtubeLink" href="https://www.youtube.com/live/DgSyV_eqeFU?si=ojnl4qfEiaCXb0ep" target="_blank">
            https://www.youtube.com/live/DgSyV_eqeFU?si=ojnl4qfEiaCXb0ep
        </a>
        <i class="bi bi-clipboard ms-1" id="copyBtn" style="cursor: pointer;" title="Salin link"></i>
    </h6>

  </div>
</section>
@endsection
