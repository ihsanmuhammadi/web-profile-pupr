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
        <h6 class="footer-heading">Data & Diagram</h6>
        <ul class="list-unstyled">
          <li><a href="{{ route('jalan.lingkungan') }}">Jalan Lingkungan</a></li>
          <li><a href="{{ route('drainase.lingkungan') }}">Drainase Lingkungan</a></li>
          <li><a href="{{ route('jembatan.lingkungan') }}">Jembatan Lingkungan</a></li>
          <li><a href="{{ route('rumah.taklayak') }}">Rumah Tidak Layak Huni</a></li>
          <li><a href="{{ route('perumahan') }}">Perumahan</a></li>
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
