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
