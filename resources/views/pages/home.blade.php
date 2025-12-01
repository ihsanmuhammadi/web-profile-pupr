@extends('layouts.main')

@section('content')
<!-- hero -->
<section class="hero text-center text-white d-flex align-items-center justify-content-center" style="background: url('{{ asset('assets/images/bg-hero.png') }}') center/cover; height: 100vh;">
  <div class="content position-relative" data-aos="zoom-in">
    <h1 class="fw-bold mb-5">Selamat Datang di Website Resmi</h1>
    <h1 class="fw-bold text-uppercase">
      DINAS PEKERJAAN UMUM DAN PENATAAN RUANG,<br>
      PERUMAHAN RAKYAT DAN KAWASAN PERMUKIMAN<br>
      KABUPATEN KUBU RAYA
    </h1>
  </div>
</section>

<!-- profile -->
<section class="profil-dinas py-5 text-center" style="margin-top: -50px;">
  <div class="container" data-aos="fade-down">
    <h2 class="fw-bold mb-4">Profil Dinas</h2>
    <div class="divider mx-auto mb-4"></div>
    <p class="text-muted mb-5">Cari informasi tentang Dinas</p>

    <img src="{{ asset('assets/images/logo_kuburaya.png') }}" alt="Logo Kubu Raya" class="logo-dinas mb-4" data-aos="flip-left">

    <h5 class="fw-bold text-uppercase mb-5" data-aos="fade-left">
      DINAS PEKERJAAN UMUM DAN PENATAAN RUANG, PERUMAHAN<br>
      RAKYAT DAN KAWASAN PERMUKIMAN KABUPATEN KUBU RAYA
    </h5>

    <div class="px-lg-5 mx-lg-5 text-muted" data-aos="fade-right">
      <p>
        Dinas Pekerjaan Umum dan Penataan Ruang, Perumahan Rakyat, dan Kawasan Permukiman Kabupaten Kubu Raya merupakan perangkat daerah yang memiliki tugas utama dalam merencanakan, melaksanakan, dan mengawasi pembangunan infrastruktur, penataan ruang, serta penyediaan perumahan dan permukiman bagi masyarakat. Dinas ini berperan penting dalam mewujudkan pembangunan yang merata, tertata, dan berkelanjutan di wilayah Kabupaten Kubu Raya.
      </p>
      <p>
        Melalui berbagai program dan kegiatan, dinas ini fokus pada pembangunan jalan, jembatan, dan drainase lingkungan, penataan tata ruang wilayah, peningkatan kualitas permukiman, serta penyediaan rumah layak huni. Dengan semangat pelayanan publik, dinas berkomitmen untuk mendukung terciptanya lingkungan yang nyaman, aman, dan sesuai dengan kebutuhan masyarakat, sekaligus mendorong pertumbuhan wilayah yang sejalan dengan visi pembangunan daerah.
      </p>
    </div>

    <a href="{{ route('visi.misi') }}" class="btn btn-outline-dark rounded-pill px-4 mt-3" data-aos="zoom-in">Selengkapnya</a>
  </div>
</section>

<!-- data & program -->
<section class="data-program py-5 text-center">
  <div class="container" data-aos="fade-up">
    <h2 class="fw-bold mb-3" data-aos="zoom-in">Data & Program</h2>
    <div class="divider mx-auto mb-3" data-aos="zoom-in"></div>
    <p class="text-muted mb-5" data-aos="zoom-in">Menyajikan data & program yang ada di Kubu Raya</p>

    <div class="border rounded-4 p-4 shadow-sm mx-auto" style="max-width: 95%;" data-aos="zoom-in">
      <div class="row justify-content-center">
        <div class="col-6 col-md-2 mb-4 mb-md-0">
          <h3 class="fw-bold data-number">{{ $total_jalan_lingkungan }}</h3>
          <p class="fw-semibold mb-0">Jalan Lingkungan</p>
        </div>
        <div class="col-6 col-md-2 mb-4 mb-md-0">
          <h3 class="fw-bold data-number">{{ $total_drainase_lingkungan }}</h3>
          <p class="fw-semibold mb-0">Drainase Lingkungan</p>
        </div>
        <div class="col-6 col-md-2 mb-4 mb-md-0">
          <h3 class="fw-bold data-number">{{ $total_jembatan_lingkungan }}</h3>
          <p class="fw-semibold mb-0">Jembatan Lingkungan</p>
        </div>
        <div class="col-6 col-md-2 mb-4 mb-md-0">
          <h3 class="fw-bold data-number">{{ $total_perumahan }}</h3>
          <p class="fw-semibold mb-0">Perumahan</p>
        </div>
         <div class="col-6 col-md-2 mb-4 mb-md-0">
          <h3 class="fw-bold data-number">{{ $total_rumah_tidak_layak }}</h3>
          <p class="fw-semibold mb-0">Rumah Tidak Layak Huni</p>
        </div>
        <div class="col-6 col-md-2">
          <h3 class="fw-bold data-number">{{ $total_kawasan_kumuh }}</h3>
          <p class="fw-semibold mb-0">Kawasan Kumuh</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="informasi-program py-5">
  <div class="container" style="max-width: 1070px;">
    <div class="row align-items-center mb-5" data-aos="fade-left">
      <div class="col-md-7">
        <h5 class="fw-bold">Jalan Lingkungan</h5>
        <p class="text-muted">
          Proyek jalan lingkungan adalah kegiatan pembangunan atau perbaikan jalan yang berada di dalam kawasan permukiman masyarakat.
          Tujuannya untuk meningkatkan aksesibilitas antar rumah, fasilitas umum, dan jalan utama, sehingga mobilitas warga menjadi lebih lancar serta kualitas lingkungan permukiman semakin baik.
        </p>
        <div class="d-flex align-items-center mt-3">
          <h4 class="fw-bold angka mb-0 me-4">{{ $total_jalan_lingkungan }}</h4>
          <div>
            <p class="text-muted mb-1">Total pekerjaan yang terdaftar</p>
            <a href="{{ route('dataprogram.category', ['categoryName' => 'jalan-lingkungan']) }}"
                class="fw-bold text-dark text-decoration-none">
                Selengkapnya →
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-5 text-center">
        <img src="{{ asset('assets/images/jalan-lingkungan.png') }}" class="img-fluid rounded-4 shadow-sm" alt="Jalan Lingkungan">
      </div>
    </div>

    <hr>

    <div class="row align-items-center mb-5 mt-5 flex-md-row-reverse" data-aos="fade-right">
      <div class="col-md-7">
        <h5 class="fw-bold">Drainase Lingkungan</h5>
        <p class="text-muted">
          Proyek drainase lingkungan adalah kegiatan pembangunan atau perbaikan saluran air di kawasan permukiman yang berfungsi
          untuk mengalirkan air hujan maupun limbah agar tidak terjadi genangan dan banjir.
        </p>
        <div class="d-flex align-items-center mt-3">
          <h4 class="fw-bold angka mb-0 me-4">{{ $total_drainase_lingkungan }}</h4>
          <div>
            <p class="text-muted mb-1">Total pekerjaan yang terdaftar</p>
            <a href="{{ route('dataprogram.category', ['categoryName' => 'drainase-lingkungan']) }}"
                class="fw-bold text-dark text-decoration-none">
                Selengkapnya →
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-5 text-center">
        <img src="{{ asset('assets/images/drainase-lingkungan.png') }}" class="img-fluid rounded-4 shadow-sm" alt="Drainase Lingkungan">
      </div>
    </div>

    <hr>

    <div class="row align-items-center mb-5 mt-5" data-aos="fade-left">
      <div class="col-md-7">
        <h5 class="fw-bold">Jembatan Lingkungan</h5>
        <p class="text-muted">
          Proyek jembatan lingkungan adalah kegiatan pembangunan atau rehabilitasi jembatan lokal yang menghubungkan antar wilayah
          dalam satu kawasan permukiman untuk memperlancar mobilitas warga dan akses ke fasilitas umum.
        </p>
        <div class="d-flex align-items-center mt-3">
          <h4 class="fw-bold angka mb-0 me-4">{{ $total_jembatan_lingkungan }}</h4>
          <div>
            <p class="text-muted mb-1">Total pekerjaan yang terdaftar</p>
            <a href="{{ route('dataprogram.category', ['categoryName' => 'jembatan-lingkungan']) }}"
                class="fw-bold text-dark text-decoration-none">
                Selengkapnya →
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-5 text-center">
        <img src="{{ asset('assets/images/jembatan-lingkungan.png') }}" class="img-fluid rounded-4 shadow-sm" alt="Jembatan Lingkungan">
      </div>
    </div>

    <hr>

    <div class="row align-items-center mb-5 mt-5 flex-md-row-reverse" data-aos="fade-right">
      <div class="col-md-7">
        <h5 class="fw-bold">Rumah Tidak Layak Huni (RTLH)</h5>
        <p class="text-muted">
          Data ini menampilkan jumlah total rumah tidak layak huni (RTLH) di Kabupaten Kubu Raya beserta persebarannya di setiap kecamatan.
          Informasi ini menjadi dasar dalam perencanaan program perbaikan dan peningkatan kualitas hunian masyarakat.
        </p>
        <div class="d-flex gap-4">
          <div>
            <h4 class="fw-bold angka">{{ $total_rumah_tidak_layak }}</h4>
            <p class="text-muted mb-0">Total Rumah Tidak Layak Huni</p>
          </div>
          <div style="margin-left: 100px">
            <h4 class="fw-bold angka">{{ $avg_rumah_tidak_layak_per_kecamatan }}</h4>
            <p class="text-muted mb-0">Rata-rata per Kecamatan</p>
          </div>
        </div>
        <a href="{{ route('dataprogram.category', ['categoryName' => 'rumah-tidak-layak-huni']) }}"
                class="fw-bold text-dark text-decoration-none">
                Selengkapnya →
            </a>
      </div>
      <div class="col-md-5 text-center">
        <img src="{{ asset('assets/images/rumah-tidak-layak-huni.png') }}" class="img-fluid rounded-4 shadow-sm" alt="RTLH">
      </div>
    </div>

    <hr>

    <div class="row align-items-center mb-5 mt-5" data-aos="fade-left">
      <div class="col-md-7">
        <h5 class="fw-bold">Perumahan</h5>
        <p class="text-muted">
          Data ini menampilkan jumlah total rumah layak huni di Kabupaten Kubu Raya serta distribusinya di setiap kecamatan.
          Informasi ini menjadi acuan dalam memantau perkembangan perumahan daerah.
        </p>
        <div class="d-flex gap-4">
          <div>
            <h4 class="fw-bold angka">{{ $total_perumahan }}</h4>
            <p class="text-muted mb-0">Total Perumahan</p>
          </div>
          <div style="margin-left: 100px">
            <h4 class="fw-bold angka">{{ $avg_perumahan_per_kecamatan }}</h4>
            <p class="text-muted mb-0">Rata-rata per Kecamatan</p>
          </div>
        </div>
        <a href="{{ route('dataprogram.category', ['categoryName' => 'perumahan']) }}"
                class="fw-bold text-dark text-decoration-none">
                Selengkapnya →
            </a>
      </div>
      <div class="col-md-5 text-center">
        <img src="{{ asset('assets/images/perumahan.png') }}" class="img-fluid rounded-4 shadow-sm" alt="Perumahan">
      </div>
    </div>

    <hr>

    <div class="row align-items-center mb-5 mt-5 flex-md-row-reverse" data-aos="fade-right">
      <div class="col-md-7">
        <h5 class="fw-bold">Kawasan Kumuh</h5>
        <p class="text-muted">
          Data ini menampilkan jumlah dan persebaran kawasan kumuh di Kabupaten Kubu Raya berdasarkan tingkat kekumuhan di setiap
          kecamatan. Informasi ini menjadi dasar penting dalam perencanaan program penataan permukiman untuk meningkatkan kualitas
           lingkungan, mengurangi risiko kesehatan, serta menciptakan ruang hidup yang lebih tertata, aman, dan layak bagi masyarakat.
        </p>
        <div class="d-flex align-items-center mt-3">
          <h4 class="fw-bold angka mb-0 me-4">{{ $total_kawasan_kumuh }}</h4>
          <div>
            <p class="text-muted mb-1">Total pekerjaan yang terdaftar</p>
            <a href="{{ route('dataprogram.category', ['categoryName' => 'kawasan-kumuh']) }}"
                class="fw-bold text-dark text-decoration-none">
                Selengkapnya →
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-5 text-center">
        <img src="{{ asset('assets/images/kawasan-kumuh.png') }}" class="img-fluid rounded-4 shadow-sm" alt="Drainase Lingkungan">
      </div>
    </div>

    <hr>

  </div>
</section>

<section class="informasi-berita py-5 bg-light position-relative" data-aos="fade-up">
  <div class="container text-center mb-5">
    <h2 class="fw-bold mb-2">Informasi Berita</h2>
    <div class="divider mx-auto mb-3"></div>
    <p class="text-muted mb-0">Informasi berita kegiatan dan program Dinas PUPRPKP Kabupaten Kubu Raya</p>
  </div>

  <div id="carouselBerita" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
       @foreach($news as $index => $item)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <div class="carousel-card">
                    <img src="{{ asset('storage/' . $item->gambar) }}"
                         class="w-100 rounded-5"
                         alt="{{ $item->judul }}">
                    <div class="carousel-overlay d-flex justify-content-center align-items-end">
                        <div class="text-center text-white carousel-text">
                            <h2 class="fw-bold mb-2">{{ $item->judul }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselBerita" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselBerita" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
</section>

@endsection
