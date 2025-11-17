@extends('layouts.main')

@section('title', 'Jalan Lingkungan')

@section('content')

<section class="py-5 mt-5">
    <div class="container col-lg-9 mx-auto">

        <div class="my-5">
            <h1 class="fw-bold">Jalan Lingkungan</h1>
            <p class="text-muted">
                Deskripsi singkat lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum ipsum lorem ipsum lorem ipsum lorem ipsum ipsum lorem ipsum lorem ipsum lorem ipsum.
                <a href="#" class="text-success text-decoration-underline fw-medium" data-bs-toggle="modal" data-bs-target="#modalJalanLingkungan">
                    <br>Pelajari selengkapnya.
                </a>
            </p>
        </div>

        <div class="mb-4 d-flex align-items-center flex-wrap info-program">
            <div class="me-5">
                <p class="h4 text-success mb-0">Jumlah Pekerjaan</p>
                <p class="h2 text-success mb-0">3</p>
            </div>
            <div class="ms-5">
                <p class="h4 text-success mb-0">Total Perkecamatan</p>
                <p class="h2 text-success mb-0">30</p>
            </div>
        </div>

        <hr class="mb-4">

        {{-- Filter Bar --}}
        <div class="row g-2 mb-3">
            <div class="col-lg-4">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari Proyek..." aria-label="Cari Proyek">
                    <button class="btn btn-success" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <div class="dropdown flex-fill col-lg-2 col-md-4">
                <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                Status
                </button>
                <ul class="dropdown-menu p-2 mt-3" style="width: 180px;">
                <label class="form-label fw-bold ms-2 text-dark">Status</label>
                <li><div class="form-check"><input class="form-check-input" type="checkbox" id=""><label class="form-check-label" for="">Sedang Berjalan</label></div></li>
                <li><div class="form-check"><input class="form-check-input" type="checkbox" id=""><label class="form-check-label" for="">Ditunda</label></div></li>
                <li><div class="form-check"><input class="form-check-input" type="checkbox" id=""><label class="form-check-label" for="">Tuntas</label></div></li>
                <li><div class="form-check"><input class="form-check-input" type="checkbox" id=""><label class="form-check-label" for="">Dihentikan</label></div></li>
                </ul>
            </div>

            <div class="dropdown flex-fill col-lg-3 col-md-4">
                <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                Tahun Anggaran
                </button>
                <ul class="dropdown-menu p-2 mt-3" style="width: 270px;">
                <label class="form-label fw-bold ms-2 text-dark">Tahun Anggaran</label>
                <li><input type="search" class="form-control form-control-sm mb-2 ms-2" style="max-width: 230px;" placeholder="Cari Tahun Anggaran"></li>
                <li><div class="form-check"><input class="form-check-input" type="checkbox" id=""><label class="form-check-label" for="">2027</label></div></li>
                <li><div class="form-check"><input class="form-check-input" type="checkbox" id=""><label class="form-check-label" for="">2026</label></div></li>
                <li><div class="form-check"><input class="form-check-input" type="checkbox" id=""><label class="form-check-label" for="">2025</label></div></li>
                </ul>
            </div>

            <div class="dropdown flex-fill col-lg-3 col-md-4">
                <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                Lokasi
                </button>
                <ul class="dropdown-menu p-2 mt-3" style="width: 270px;">
                <label class="form-label fw-bold ms-2 text-dark">Lokasi</label>
                <li><input type="search" class="form-control form-control-sm mb-2 ms-2" style="max-width: 230px;" placeholder="Cari Lokasi"></li>
                <li><div class="form-check"><input class="form-check-input" type="checkbox" id=""><label class="form-check-label" for="">Kecamatan a</label></div></li>
                <li><div class="form-check"><input class="form-check-input" type="checkbox" id=""><label class="form-check-label" for="">Kecamatan b</label></div></li>
                <li><div class="form-check"><input class="form-check-input" type="checkbox" id=""><label class="form-check-label" for="">Kecamatan c</label></div></li>
                </ul>
            </div>
        </div>

        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
            <div class="text-dark mb-2 mb-md-0" id="data-ditemukan">
                0 data ditemukan
            </div>
            <div class="d-flex align-items-center" style="min-width: 200px;">
                <label for="sortFilter" class="form-label mb-0 me-2 text-muted text-dark">Urut Berdasarkan:</label>
                <div class="dropdown flex-grow-1">
                <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                    Urut Berdasarkan
                </button>
                <ul class="dropdown-menu p-2 mt-3" style="width: 210px;">
                    <label class="form-label fw-bold ms-2 text-dark">Urutkan</label>
                    <li><button class="dropdown-item small">Terbaru</button></li>
                    <li><button class="dropdown-item small">Terlama</button></li>
                    <li><button class="dropdown-item small">Paling Relevan</button></li>
                </ul>
                </div>
            </div>
        </div>

        {{-- cek empty state--}}
        @php
            $isEmpty = false;
        @endphp

        <div class="project-list">

            @if ($isEmpty)
                <div class="text-center py-5 my-5">
                    <span class="material-symbols-outlined d-block mb-3 mt-5 text-secondary" style="font-size: 120px;">hourglass_empty</span>
                    <p class="text-muted fs-6 mb-5">Belum terdapat data di halaman ini.</p>
                </div>
            @else

            <div class="card mb-3 shadow-sm border-0">
                <div class="row g-0">
                    <div class="col-md-2">
                        <img src="{{ asset('assets/images/proyek_jalan.png') }}" class="img-fluid rounded-start project-card-image" alt="Gambar Proyek">
                    </div>
                    <div class="col-md-10">
                        <div class="card-body p-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title fw-bold mb-1">Nama Proyek 1</h5>
                                <div class="card-text text-muted small mb-3">
                                    <span class="me-3 d-inline-block"><i class="fas fa-calendar-alt me-1 text-secondary"></i> Waktu Pelaksanaan</span>
                                    <span class="me-3 d-inline-block"><i class="fas fa-calendar-check me-1 text-secondary"></i> Tahun Anggaran</span>
                                    <span class="d-inline-block"><i class="fas fa-map-marker-alt me-1 text-secondary"></i> Lokasi</span>
                                </div>
                                <div style="max-width: 150px">
                                    <span class="badge d-flex align-items-center bg-primary text-light rounded-1 px-2 py-1 fw-medium">
                                        <span class="material-symbols-outlined me-2">manufacturing</span> Sedang Berjalan
                                    </span>
                                </div>
                            </div>
                            <div class="ms-3 flex-shrink-0 d-flex align-items-center">
                                <a href="{{ route('program.detail') }}" class="btn btn-outline-success rounded-pill px-3 py-2">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3 shadow-sm border-0">
                <div class="row g-0">
                    <div class="col-md-2">
                        <img src="{{ asset('assets/images/proyek_jalan.png') }}" class="img-fluid rounded-start project-card-image" alt="Gambar Proyek">
                    </div>
                    <div class="col-md-10">
                        <div class="card-body p-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title fw-bold mb-1">Nama Proyek 2</h5>
                                <div class="card-text text-muted small mb-3">
                                    <span class="me-3 d-inline-block"><i class="fas fa-calendar-alt me-1 text-secondary"></i> Waktu Pelaksanaan</span>
                                    <span class="me-3 d-inline-block"><i class="fas fa-calendar-check me-1 text-secondary"></i> Tahun Anggaran</span>
                                    <span class="d-inline-block"><i class="fas fa-map-marker-alt me-1 text-secondary"></i> Lokasi</span>
                                </div>
                                <div style="max-width: 110px">
                                    <span class="badge d-flex align-items-center bg-danger text-light rounded-1 px-2 py-1 fw-medium">
                                        <span class="material-symbols-outlined me-2">cancel</span> Dihentikan
                                    </span>
                                </div>
                            </div>
                            <div class="ms-3 flex-shrink-0 d-flex align-items-center">
                                <a href="{{ route('program.detail') }}" class="btn btn-outline-success rounded-pill px-3 py-2">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3 shadow-sm border-0">
                <div class="row g-0">
                    <div class="col-md-2">
                        <img src="{{ asset('assets/images/proyek_jalan.png') }}" class="img-fluid rounded-start project-card-image" alt="Gambar Proyek">
                    </div>
                    <div class="col-md-10">
                        <div class="card-body p-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title fw-bold mb-1">Nama Proyek 3</h5>
                                <div class="card-text text-muted small mb-3">
                                    <span class="me-3 d-inline-block"><i class="fas fa-calendar-alt me-1 text-secondary"></i> Waktu Pelaksanaan</span>
                                    <span class="me-3 d-inline-block"><i class="fas fa-calendar-check me-1 text-secondary"></i> Tahun Anggaran</span>
                                    <span class="d-inline-block"><i class="fas fa-map-marker-alt me-1 text-secondary"></i> Lokasi</span>
                                </div>
                                <div style="max-width: 100px">
                                    <span class="badge d-flex align-items-center bg-success text-light rounded-1 px-2 py-1 fw-medium">
                                        <span class="material-symbols-outlined me-2">check_circle</span> Tuntas
                                    </span>
                                </div>
                            </div>
                            <div class="ms-3 flex-shrink-0 d-flex align-items-center">
                                <a href="{{ route('program.detail') }}" class="btn btn-outline-success rounded-pill px-3 py-2">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3 shadow-sm border-0">
                <div class="row g-0">
                    <div class="col-md-2">
                        <img src="{{ asset('assets/images/proyek_jalan.png') }}" class="img-fluid rounded-start project-card-image" alt="Gambar Proyek">
                    </div>
                    <div class="col-md-10">
                        <div class="card-body p-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title fw-bold mb-1">Nama Proyek 4</h5>
                                <div class="card-text text-muted small mb-3">
                                    <span class="me-3 d-inline-block"><i class="fas fa-calendar-alt me-1 text-secondary"></i> Waktu Pelaksanaan</span>
                                    <span class="me-3 d-inline-block"><i class="fas fa-calendar-check me-1 text-secondary"></i> Tahun Anggaran</span>
                                    <span class="d-inline-block"><i class="fas fa-map-marker-alt me-1 text-secondary"></i> Lokasi</span>
                                </div>
                                <div style="max-width: 150px">
                                    <span class="badge d-flex align-items-center bg-primary text-light rounded-1 px-2 py-1 fw-medium">
                                        <span class="material-symbols-outlined me-2">manufacturing</span> Sedang Berjalan
                                    </span>
                                </div>
                            </div>
                            <div class="ms-3 flex-shrink-0 d-flex align-items-center">
                                <a href="{{ route('program.detail') }}" class="btn btn-outline-success rounded-pill px-3 py-2">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3 shadow-sm border-0">
                <div class="row g-0">
                    <div class="col-md-2">
                        <img src="{{ asset('assets/images/proyek_jalan.png') }}" class="img-fluid rounded-start project-card-image" alt="Gambar Proyek">
                    </div>
                    <div class="col-md-10">
                        <div class="card-body p-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title fw-bold mb-1">Nama Proyek 5</h5>
                                <div class="card-text text-muted small mb-3">
                                    <span class="me-3 d-inline-block"><i class="fas fa-calendar-alt me-1 text-secondary"></i> Waktu Pelaksanaan</span>
                                    <span class="me-3 d-inline-block"><i class="fas fa-calendar-check me-1 text-secondary"></i> Tahun Anggaran</span>
                                    <span class="d-inline-block"><i class="fas fa-map-marker-alt me-1 text-secondary"></i> Lokasi</span>
                                </div>
                                <div style="max-width: 100px">
                                    <span class="badge d-flex align-items-center  text-light rounded-1 px-2 py-1 fw-medium" style="background-color: #CEAB41">
                                        <span class="material-symbols-outlined me-2">pause_circle</span> Ditunda
                                    </span>
                                </div>
                            </div>
                            <div class="ms-3 flex-shrink-0 d-flex align-items-center">
                                <a href="{{ route('program.detail') }}" class="btn btn-outline-success rounded-pill px-3 py-2">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3 shadow-sm border-0">
                <div class="row g-0">
                    <div class="col-md-2">
                        <img src="{{ asset('assets/images/proyek_jalan.png') }}" class="img-fluid rounded-start project-card-image" alt="Gambar Proyek">
                    </div>
                    <div class="col-md-10">
                        <div class="card-body p-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title fw-bold mb-1">Nama Proyek 6</h5>
                                <div class="card-text text-muted small mb-3">
                                    <span class="me-3 d-inline-block"><i class="fas fa-calendar-alt me-1 text-secondary"></i> Waktu Pelaksanaan</span>
                                    <span class="me-3 d-inline-block"><i class="fas fa-calendar-check me-1 text-secondary"></i> Tahun Anggaran</span>
                                    <span class="d-inline-block"><i class="fas fa-map-marker-alt me-1 text-secondary"></i> Lokasi</span>
                                </div>
                                <div style="max-width: 100px">
                                    <span class="badge d-flex align-items-center bg-success text-light rounded-1 px-2 py-1 fw-medium">
                                        <span class="material-symbols-outlined me-2">check_circle</span> Tuntas
                                    </span>
                                </div>
                            </div>
                            <div class="ms-3 flex-shrink-0 d-flex align-items-center">
                                <a href="{{ route('program.detail') }}" class="btn btn-outline-success rounded-pill px-3 py-2">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3 shadow-sm border-0">
                <div class="row g-0">
                    <div class="col-md-2">
                        <img src="{{ asset('assets/images/proyek_jalan.png') }}" class="img-fluid rounded-start project-card-image" alt="Gambar Proyek">
                    </div>
                    <div class="col-md-10">
                        <div class="card-body p-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title fw-bold mb-1">Nama Proyek 7</h5>
                                <div class="card-text text-muted small mb-3">
                                    <span class="me-3 d-inline-block"><i class="fas fa-calendar-alt me-1 text-secondary"></i> Waktu Pelaksanaan</span>
                                    <span class="me-3 d-inline-block"><i class="fas fa-calendar-check me-1 text-secondary"></i> Tahun Anggaran</span>
                                    <span class="d-inline-block"><i class="fas fa-map-marker-alt me-1 text-secondary"></i> Lokasi</span>
                                </div>
                                <div style="max-width: 100px">
                                    <span class="badge d-flex align-items-center bg-success text-light rounded-1 px-2 py-1 fw-medium">
                                        <span class="material-symbols-outlined me-2">check_circle</span> Tuntas
                                    </span>
                                </div>
                            </div>
                            <div class="ms-3 flex-shrink-0 d-flex align-items-center">
                                <a href="{{ route('program.detail') }}" class="btn btn-outline-success rounded-pill px-3 py-2">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        {{-- Pagination --}}
        <nav aria-label="Page navigation" class="mt-4" id="pagination-nav">
            <ul class="pagination justify-content-center">
            </ul>
        </nav>

    </div>
</section>

{{-- modal informasi === --}}
<div class="modal fade" id="modalJalanLingkungan" tabindex="-1" aria-labelledby="modalJalanLingkunganLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header text-white">
                <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p>
                    Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum.
                </p>

                <h6 class="fw-bold mt-4 mb-2">Tujuan & Manfaat</h6>
                <ul>
                    <li>lorem ipsum lorem ipsum lorem ipsum</li>
                    <li>lorem ipsum lorem ipsum lorem ipsum</li>
                    <li>lorem ipsum lorem ipsum lorem ipsum</li>
                    <li>lorem ipsum lorem ipsum lorem ipsum</li>
                    <li>lorem ipsum lorem ipsum lorem ipsum</li>
                </ul>
                <p>
                    lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum.
                </p>

                <h6 class="fw-bold mt-4 mb-2"></i>Contoh Program</h6>
                <ul>
                    <li>lorem ipsum lorem ipsum lorem ipsum</li>
                    <li>lorem ipsum lorem ipsum lorem ipsum</li>
                    <li>lorem ipsum lorem ipsum lorem ipsum</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
