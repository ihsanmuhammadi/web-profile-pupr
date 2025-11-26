<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dinas PUPR Kabupaten Kubu Raya</title>
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>
<body>
    <nav class="navbar navbar-expand-lg bg-white shadow-sm fixed-top py-2" data-aos="fade-down">
  <div class="container-fluid px-4 px-lg-5">
    <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
      <img src="{{ asset('assets/images/logo_kuburaya.png') }}" alt="Logo" height="55" class="me-2 logo-navbar">
      <span class="fw-bold text-uppercase lh-sm title-navbar">
        DINAS PEKERJAAN UMUM DAN PENATAAN RUANG, PERUMAHAN <br>
        RAKYAT DAN KAWASAN PERMUKIMAN KABUPATEN KUBU RAYA
      </span>
    </a>

    <!-- Button toggle -->
    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end mt-3 mt-lg-0" id="navbarNav">
      <ul class="navbar-nav">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="profilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Profil
          </a>
          <ul class="dropdown-menu h1" >
            <li><a class="dropdown-item" href="{{ route('visi.misi') }}">Visi & Misi Dinas Kubu Raya</a></li>
            <li><a class="dropdown-item" href="{{ route('struktur.dinas') }}">Struktur Organisasi Dinas</a></li>
            <li><a class="dropdown-item" href="{{ route('struktur.bidang') }}">Struktur Organisasi Bidang Perumahan & Kawasan Pemukiman</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dataDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Data & Program
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('dataprogram.category', ['categoryName' => 'jalan-lingkungan']) }}">Jalan Lingkungan</a></li>
            <li><a class="dropdown-item" href="{{ route('dataprogram.category', ['categoryName' => 'drainase-lingkungan']) }}">Drainase Lingkungan</a></li>
            <li><a class="dropdown-item" href="{{ route('dataprogram.category', ['categoryName' => 'jembatan-lingkungan']) }}">Jembatan Lingkungan</a></li>
            <li><a class="dropdown-item" href="{{ route('dataprogram.category', ['categoryName' => 'rumah-tidak-layak-huni']) }}">Rumah Tidak Layak Huni</a></li>
            <li><a class="dropdown-item" href="{{ route('dataprogram.category', ['categoryName' => 'perumahan']) }}">Perumahan</a></li>
            <li><a class="dropdown-item" href="#">Satu Peta</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pedomanDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Pedoman
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('pedoman.teknis') }}">Pedoman Spesifikasi Teknis</a></li>
            <li><a class="dropdown-item" href="{{ route('pedoman.daerah') }}">Pedoman Spesifikasi Daerah</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="layananDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Layanan Publik
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('kerja.magang') }}">Peluang Kerja & Magang</a></li>
            <li><a class="dropdown-item" href="{{ route('aduan') }}">Aduan Masyarakat</a></li>
            <li><a class="dropdown-item" href="{{ route('feedback') }}">Formulir Feedback</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>


    <main>
        <section class="pedoman-header position-relative text-center text-white mt-5">
    <img src="{{ asset('assets/images/header_pedoman.png') }}" class="w-100 header-bg" alt="Header Pedoman Daerah">
    <div class="header-overlay"></div>
    <div class="header-text-pedoman position-absolute top-50 start-50 translate-middle text-uppercase" data-aos="zoom-in">
    <h1 class="fw-bold mb-1">Pedoman <br>Spesifikasi <br>Daerah</h1>
    </div>
</section>

<section class="pedoman-content py-5">
    <div class="container col-lg-9 mx-auto">
        {{-- Navigation --}}
        <div class="d-flex gap-3 mb-4 navigasi" data-aos="fade-right">
            <a href="{{ route('pedoman.teknis') }}" class="btn btn-outline-secondary">Pedoman Spesifikasi Teknis</a>
            <a href="{{ route('pedoman.daerah') }}" class="btn active-btn">Pedoman Spesifikasi Daerah</a>
        </div>

        <h2 class="fw-bold mt-5 mb-5 text-center" data-aos="zoom-in">
            Pedoman Spesifikasi Daerah Dinas PUPR Kubu Raya
        </h2>

        {{-- YouTube Video --}}
        @if ($videoData && isset($videoData['videoId']))
            <div class="ratio ratio-16x9 mb-3" data-aos="zoom-in-up">
                <iframe
                    src="https://www.youtube.com/embed/{{ $videoData['videoId'] }}"
                    title="{{ $videoData['title'] ?? 'YouTube Video' }}"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>

            {{-- Video Info --}}
            <div class="video-info mt-4">
                <h4 class="fw-semibold mb-2">
                    {{ $videoData['title'] ?? 'Video YouTube' }}
                </h4>

                @if(!isset($videoData['api_failed']))
                    <p class="text-muted mb-2 small">
                        YouTube |
                        {{ $videoData['channel'] ?? '-' }} |
                        {{ number_format($videoData['views'] ?? 0) }} kali dilihat |
                        @if(isset($videoData['published_at']))
                            {{ \Carbon\Carbon::parse($videoData['published_at'])->translatedFormat('d F Y') }}
                        @endif
                    </p>
                @endif

                <div class="d-flex align-items-center gap-2 mt-3">
                    <h6 class="mb-0">Link YouTube:</h6>
                    <a id="youtubeLink" href="{{ $videoData['original_url'] }}" target="_blank" class="text-break">
                        {{ $videoData['original_url'] }}
                    </a>
                    <i class="bi bi-clipboard ms-1" id="copyBtn" style="cursor: pointer;" title="Salin link"></i>
                </div>

                @if(isset($videoData['api_failed']))
                    <div class="alert alert-warning mt-3">
                        <i class="bi bi-exclamation-triangle"></i>
                        Tidak dapat memuat informasi lengkap dari YouTube API. Video tetap dapat diputar.
                    </div>
                @endif
            </div>
        @else
            {{-- No Video Available --}}
            <div class="alert alert-warning text-center py-5">
                <i class="bi bi-exclamation-triangle fs-1 d-block mb-3"></i>
                <h5>Video Pedoman Spesifikasi Daerah belum tersedia</h5>
                <p class="mb-0 text-muted">Silakan hubungi administrator untuk menambahkan video pedoman.</p>
            </div>
        @endif
    </div>
</section>
    </main>

    <footer class="footer-section">
  <div class="container py-5">

    <div class="footer-header d-flex align-items-start mb-5">
      <img src="{{ asset('assets/images/logo_kuburaya.png') }}" alt="Logo" class="footer-logo me-3">
      <div>
        <h6 class="footer-title">
          DINAS PEKERJAAN UMUM DAN PENATAAN RUANG, PERUMAHAN RAKYAT DAN<br>
          KAWASAN PERMUKIMAN KABUPATEN KUBU RAYA
        </h6>
      </div>
    </div>

    <div class="row gy-4">
      <div class="col-lg-2 col-md-4 col-6">
        <h6 class="footer-heading">Profil</h6>
        <ul class="list-unstyled">
          <li><a href="{{ route('visi.misi') }}">Visi & Misi Dinas Kubu Raya</a></li>
          <li><a href="{{ route('struktur.dinas') }}">Struktur Organisasi Dinas</a></li>
          <li><a href="{{ route('struktur.bidang') }}">Struktur Organisasi Bidang Perumahan & Kawasan Permukiman</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-md-4 col-6">
        <h6 class="footer-heading">Data & Program</h6>
        <ul class="list-unstyled">
          <li><a href="{{ route('dataprogram.category', ['categoryName' => 'jalan-lingkungan']) }}">Jalan Lingkungan</a></li>
          <li><a href="{{ route('dataprogram.category', ['categoryName' => 'drainase-lingkungan']) }}">Drainase Lingkungan</a></li>
          <li><a href="{{ route('dataprogram.category', ['categoryName' => 'jembatan-lingkungan']) }}">Jembatan Lingkungan</a></li>
          <li><a href="{{ route('dataprogram.category', ['categoryName' => 'rumah-tidak-layak-huni']) }}">Rumah Tidak Layak Huni</a></li>
          <li><a href="{{ route('dataprogram.category', ['categoryName' => 'perumahan']) }}">Perumahan</a></li>
          <li><a href="#">Satu Peta</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-md-4 col-6">
        <h6 class="footer-heading">Pedoman</h6>
        <ul class="list-unstyled">
          <li><a href="{{ route('pedoman.teknis') }}">Pedoman Spesifikasi Teknis</a></li>
          <li><a href="{{ route('pedoman.daerah') }}">Pedoman Spesifikasi Daerah</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-md-4 col-6">
        <h6 class="footer-heading">Layanan Publik</h6>
        <ul class="list-unstyled">
          <li><a href="{{ route('kerja.magang') }}">Peluang Kerja & Magang</a></li>
          <li><a href="{{ route('aduan') }}">Aduan Masyarakat</a></li>
          <li><a href="{{ route('feedback') }}">Formulir Feedback</a></li>
        </ul>
      </div>

      <div class="col-lg-4 col-md-6">
        <h6 class="footer-heading">Kontak</h6>
        <ul class="list-unstyled footer-contact">
          <li><i class="bi bi-whatsapp"></i> 081229878891</li>
          <li><i class="bi bi-envelope"></i> kuburaya@gmail.com</li>
          <li><i class="bi bi-geo-alt"></i>
            YGRC+PVF, Jl. Angkasa Pura 2, Tlk. Kapuas, Kec. Sungai Raya,
            Kabupaten Kubu Raya, Kalimantan Barat
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="footer-bottom text-center py-3">
    © 2025 Karya Profesional Nusantara. All rights reserved.
  </div>
</footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
        });
    </script>

</body>
</html>


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

<!-- Toast notification -->
<div class="toast-container position-fixed top-50 start-50 translate-middle p-3">
    <div id="copyToast" class="toast align-items-center text-bg-success border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                Link berhasil disalin ke clipboard!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const copyBtn = document.getElementById('copyBtn');
    const youtubeLink = document.getElementById('youtubeLink');
    const copyToastEl = document.getElementById('copyToast');
    const copyToast = new bootstrap.Toast(copyToastEl);

    copyBtn.addEventListener('click', function() {
        const link = youtubeLink.href;
        navigator.clipboard.writeText(link).then(() => {
            // Ganti icon sementara
            copyBtn.classList.remove('bi-clipboard');
            copyBtn.classList.add('bi-clipboard-check');
            copyBtn.title = "Link berhasil disalin!";

            // Tampilkan toast
            copyToast.show();

            // Balikkan icon setelah 2 detik
            setTimeout(() => {
                copyBtn.classList.remove('bi-clipboard-check');
                copyBtn.classList.add('bi-clipboard');
                copyBtn.title = "Salin link";
            }, 2000);
        });
    });
});
</script>
