@extends('layouts.main')

@section('title', 'Peluang Kerja & Magang')

@section('content')

<section class="py-5 mt-5 job-pagination">
  <div class="container col-lg-10 mx-auto">

    <div class="text-center my-4">
      <h3 class="fw-bold">Peluang Kerja & Magang</h3>
    </div>

    {{-- Search Bar --}}
    <div class="row justify-content-center mb-3 mt-4">
        <div class="col-lg-12 col-md-11 px-5">
            <div class="input-group shadow-sm ">
                <input type="text" class="form-control" placeholder="Cari Lowongan Kerja" aria-label="Cari Lowongan">
                <button class="btn btn-success" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Filter --}}
    <div class="row justify-content-center mb-4">
        <div class="col-lg-12 col-md-11 px-5">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                <div class="dropdown flex-fill" style="min-width: 150px;">
                    <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                    Level
                    </button>
                    <ul class="dropdown-menu p-2 mt-3 ps-3" style="width: 180px;">
                    <label class="form-label fw-bold ms-2 text-dark">Level</label>
                    <li><div class="form-check"><input class="form-check-input" type="checkbox" id=""><label class="form-check-label" for="">SMA/SMK</label></div></li>
                    <li><div class="form-check"><input class="form-check-input" type="checkbox" id=""><label class="form-check-label" for="">D3</label></div></li>
                    <li><div class="form-check"><input class="form-check-input" type="checkbox" id=""><label class="form-check-label" for="">S1</label></div></li>
                    <li><div class="form-check"><input class="form-check-input" type="checkbox" id=""><label class="form-check-label" for="">S2</label></div></li>
                    </ul>
                </div>

                <div class="dropdown flex-fill" style="min-width: 150px;">
                    <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                    Jenis
                    </button>
                    <ul class="dropdown-menu p-2 mt-3 ps-3" style="width: 180px;">
                    <label class="form-label fw-bold ms-2 text-dark">Jenis</label>
                    <li><div class="form-check"><input class="form-check-input" type="checkbox" id=""><label class="form-check-label" for="">Full Time</label></div></li>
                    <li><div class="form-check"><input class="form-check-input" type="checkbox" id=""><label class="form-check-label" for="">Part Time</label></div></li>
                    <li><div class="form-check"><input class="form-check-input" type="checkbox" id=""><label class="form-check-label" for="">Kontrak</label></div></li>
                    <li><div class="form-check"><input class="form-check-input" type="checkbox" id=""><label class="form-check-label" for="">Magang</label></div></li>
                    </ul>
                </div>

                <div class="dropdown flex-fill" style="min-width: 150px;">
                    <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                    Tipe
                    </button>
                    <ul class="dropdown-menu p-2 mt-3 ps-3" style="width: 180px;">
                    <label class="form-label fw-bold ms-2 text-dark">Tipe</label>
                    <li><div class="form-check"><input class="form-check-input" type="checkbox" id=""><label class="form-check-label" for="">WFO</label></div></li>
                    <li><div class="form-check"><input class="form-check-input" type="checkbox" id=""><label class="form-check-label" for="">WFH</label></div></li>
                    <li><div class="form-check"><input class="form-check-input" type="checkbox" id=""><label class="form-check-label" for="">Remote</label></div></li>
                    </ul>
                </div>

                <div class="dropdown flex-fill" style="min-width: 150px;">
                    <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                    Lokasi
                    </button>
                    <ul class="dropdown-menu p-2 mt-3 ps-3" style="width: 180px;">
                    <label class="form-label fw-bold ms-2 text-dark">Lokasi</label>
                    <li><input type="search" class="form-control form-control-sm mb-2" style="max-width: 150px;" placeholder="Cari lokasi"></li>
                    <li><div class="form-check"><input class="form-check-input" type="checkbox" id=""><label class="form-check-label" for="">Kota A</label></div></li>
                    <li><div class="form-check"><input class="form-check-input" type="checkbox" id=""><label class="form-check-label" for="">Kota B</label></div></li>
                    <li><div class="form-check"><input class="form-check-input" type="checkbox" id=""><label class="form-check-label" for="">Kota C</label></div></li>
                    </ul>
                </div>

                <div class="d-flex align-items-center flex-fill" style="min-width: 200px;">
                    <label for="sortFilter" class="form-label mb-0 me-2 small text-muted">Urut Berdasarkan:</label>
                    <div class="dropdown flex-grow-1">
                    <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                        Urut Berdasarkan
                    </button>
                    <ul class="dropdown-menu p-2 mt-3" style="width: 210px;">
                        <label class="form-label fw-bold ms-2 text-dark">Urutkan</label>
                        <li><button class="dropdown-item small">Paling Relevan</button></li>
                        <li><button class="dropdown-item small">Terbaru</button></li>
                        <li><button class="dropdown-item small">Terlama</button></li>
                    </ul>
                    </div>
                </div>

            </div>
        </div>
        </div>

    <p id="data-ditemukan" class="text-muted small mb-4">0 data ditemukan</p>

    {{-- Daftar Pekerjaan --}}
    <div class="row g-4 project-list">
      @for ($i = 0; $i < 35; $i++)
      <div class="col-md-4 col-sm-6">
        <div class="card border-1 shadow-sm rounded-4 h-100 p-3 job-card">
          <div class="d-flex align-items-start mb-3">
            <img src="{{ asset('assets/images/logo_kuburaya.png') }}" alt="Logo" height="40">
            <div class="ms-3">
              <h6 class="fw-bold mb-0">Posisi Pekerjaan {{ $i+1 }}</h6>
              <small class="text-muted">Nama Proyek</small>
            </div>
          </div>
          <ul class="list-unstyled small mb-0">
            <li class="mb-1"><i class="bi bi-mortarboard me-2"></i>Level Pendidikan</li>
            <li class="mb-1"><i class="bi bi-briefcase me-2"></i>Jenis Pekerjaan</li>
            <li class="mb-1"><i class="bi bi-file-earmark-text me-2"></i>Tipe Pekerjaan</li>
            <li class="mb-1"><i class="bi bi-geo-alt me-2"></i>Lokasi</li>
            <li><i class="bi bi-cash-stack me-2"></i>Range Gaji</li>
          </ul>
        </div>
      </div>
      @endfor
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4" id="pagination-nav">
      <nav>
        <ul class="pagination mb-0"></ul>
      </nav>
    </div>
  </div>
  </div>
</section>

<!-- Overlay Detail Pekerjaan -->
<div id="jobOverlay" class="job-overlay">
  <div id="jobDetailSidebar" class="job-sidebar bg-white">
    <div class="p-4 h-100 overflow-auto">
      <button class="btn-close float-end" id="closeSidebar"></button>
      <div class="d-flex align-items-center mb-3 header-detail">
        <img src="{{ asset('assets/images/logo_kuburaya.png') }}" alt="Logo" height="50" class="me-3">
        <div>
          <h5 class="fw-bold mb-0">Posisi Pekerjaan</h5>
          <small class="text-muted">Nama Proyek</small>
        </div>
        <span class="text-danger small ms-auto">Tenggat Waktu</span>
      </div>
      <ul class="list-unstyled text-muted mb-3 small">
        <li class="mb-2"><i class="bi bi-mortarboard me-2"></i>Level Pekerjaan</li>
        <li class="mb-2"><i class="bi bi-briefcase me-2"></i>Jenis Pekerjaan</li>
        <li class="mb-2"><i class="bi bi-file-earmark-text me-2"></i>Bidang Pekerjaan</li>
        <li class="mb-2"><i class="bi bi-geo-alt me-2"></i>Tipe Pekerjaan • Lokasi</li>
        <li class="mb-2"><i class="bi bi-cash-stack me-2"></i>Range Gaji</li>
      </ul>
      <div class="text-center">
        <button id="openApplyForm" class="btn btn-outline-success w-75 fw-semibold rounded-pill mb-4">
            Lamar Sekarang
        </button>
      </div>

      <div class="border rounded-3 p-3 mb-3">
        <h6 class="fw-bold">Deskripsi Pekerjaan</h6>
        <ul class="small mb-3">
          <li>Deskripsi Tanggung Jawab</li>
          <li>Deskripsi Tanggung Jawab</li>
          <li>Deskripsi Tanggung Jawab</li>
        </ul>

        <h6 class="fw-bold">Kualifikasi Minimum</h6>
        <ul class="small mb-0">
          <li>Deskripsi Kualifikasi</li>
          <li>Deskripsi Kualifikasi</li>
          <li>Deskripsi Kualifikasi</li>
          <li>Deskripsi Kualifikasi</li>
          <li>Deskripsi Kualifikasi</li>
          <li>Deskripsi Kualifikasi</li>
        </ul>
      </div>

      <div class="alert alert-warning small mb-0">
        <i class="bi bi-info-circle me-2"></i>
        <strong>Tips Melamar dengan Aman</strong>
        <p class="mb-0 mt-1">
            Ingat, lamaran kerja yang benar tidak memungut biaya atau meminta data pribadi berlebihan.
            Selalu periksa keaslian lowongan sebelum melamar.
        </p>
      </div>
    </div>
  </div>
</div>

<!-- Overlay Form Lamar -->
<div id="applyOverlay" class="apply-overlay d-none">
  <div class="apply-card bg-white rounded-4 p-4 shadow-lg">
    <h5 class="fw-bold mb-1">Lamar Posisi</h5>
    <p class="text-muted mb-4">Nama Proyek</p>

    <form id="applyForm" class="text-start">
      <div class="mb-2">
        <label class="form-label fw-semibold small text-dark">Nama Lengkap</label>
        <input type="text" id="namaLengkap" class="form-control form-control-sm bg-light border-0 rounded-3" placeholder="Masukkan Nama Lengkap Anda" required>
      </div>

      <div class="mb-2">
        <label class="form-label fw-semibold small text-dark">No. Telepon</label>
        <input type="tel" id="telepon" class="form-control form-control-sm bg-light border-0 rounded-3" placeholder="Masukkan Nomor Telepon Anda dengan Kode Negara, Cth. 62" required>
      </div>

      <div class="mb-2">
        <label class="form-label fw-semibold small text-dark">Email</label>
        <input type="email" id="email" class="form-control form-control-sm bg-light border-0 rounded-3" placeholder="Masukkan Email Anda" required>
      </div>

      <div class="mb-2">
        <label class="form-label fw-semibold small text-dark">Lokasi</label>
        <input type="text" id="lokasi" class="form-control form-control-sm bg-light border-0 rounded-3" placeholder="Masukkan Nama Kota/Kabupaten" required>
      </div>

      <div class="mb-2">
        <label class="form-label fw-semibold small text-dark">Institusi Pendidikan Terakhir</label>
        <input type="text" id="institusi" class="form-control form-control-sm bg-light border-0 rounded-3" placeholder="Cth: Universitas Indonesia" required>
      </div>

      <div class="mb-2">
        <label class="form-label fw-semibold small text-dark">Jurusan</label>
        <input type="text" id="jurusan" class="form-control form-control-sm bg-light border-0 rounded-3" placeholder="Cth: Informatika, Teknik Industri, Sastra Inggris" required>
      </div>

      <div class="mb-2">
        <label class="form-label fw-semibold small text-dark">CV</label>
        <input type="file" id="cv" class="form-control form-control-sm bg-light border-0 rounded-3" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold small text-dark">Portofolio (Opsional)</label>
        <div class="input-group input-group-sm">
          <input type="url" id="portofolio" class="form-control bg-light border-0 rounded-start-3" placeholder="https://">
          <button id="clearPortofolio" class="btn btn-outline-secondary rounded-end-3 py-1 px-2" type="button">
            <i class="bi bi-trash"></i>
          </button>
        </div>
      </div>

      <div class="d-flex justify-content-end align-items-center gap-3 mt-4">
        <button type="button" id="cancelApply" class="btn btn-outline-secondary border-0 text-muted fw-semibold small">Batal</button>
        <button type="submit" class="btn btn-outline-success fw-semibold px-3 py-1 rounded-pill small">Kirim</button>
      </div>
    </form>
  </div>
</div>

<div id="successOverlay" class="success-overlay d-none">
  <div class="success-card bg-white rounded-4 p-5 text-center shadow-lg position-relative">
    <button id="closeSuccess" class="btn-close position-absolute top-0 end-0 m-3" aria-label="Close"></button>
    <p class="text-dark mb-0">Selamat! Pendaftaranmu sudah berhasil, tunggu informasi selanjutnya dari kami.</p>
    <div class="icon-wrapper mb-3 mt-5">
      <span class="material-symbols-outlined shine-icon text-success">star_shine</span>
    </div>
  </div>
</div>

@endsection
