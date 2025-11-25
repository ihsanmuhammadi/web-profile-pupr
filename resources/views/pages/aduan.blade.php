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
