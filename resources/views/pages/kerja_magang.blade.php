@extends('layouts.main')

@section('title', 'Peluang Kerja & Magang')

@section('content')

<section class="py-5 mt-5 job-pagination">
  <div class="container col-lg-10 mx-auto">

    <div class="text-center my-4">
      <h3 class="fw-bold">Peluang Kerja & Magang</h3>
    </div>

    {{-- Search + Filter Form --}}
    <form id="filterForm" method="GET" action="{{ route('kerja.magang') }}">

        {{-- Search Bar --}}
        <div class="row justify-content-center mb-3 mt-4">
            <div class="col-lg-12 col-md-11 px-5">
                <div class="input-group shadow-sm">
                    <input type="text" name="search" class="form-control"
                        placeholder="Cari Lowongan Kerja"
                        value="{{ request('search') }}">
                    <button class="btn btn-success" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- Filter --}}
        <div class="row justify-content-center mb-4">
            <div class="col-lg-12 col-md-11 px-5">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                    {{-- LEVEL --}}
                    <div class="dropdown flex-fill" style="min-width: 150px;">
                        <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                            Level
                        </button>
                        <ul class="dropdown-menu p-2 mt-3 ps-3" style="width: 180px;">
                            <label class="form-label fw-bold ms-2 text-dark">Level</label>

                            @foreach (['SMA/SMK','D3','S1','S2'] as $lvl)
                                <li>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input filter-check"
                                            name="level[]" value="{{ $lvl }}"
                                            {{ in_array($lvl, request()->level ?? []) ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $lvl }}</label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- JENIS --}}
                    <div class="dropdown flex-fill" style="min-width: 150px;">
                        <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                            Jenis
                        </button>
                        <ul class="dropdown-menu p-2 mt-3 ps-3" style="width: 180px;">
                            <label class="form-label fw-bold ms-2 text-dark">Jenis</label>

                            @foreach (['Full Time','Part Time','Kontrak','Magang'] as $j)
                                <li>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input filter-check"
                                            name="jenis[]" value="{{ $j }}"
                                            {{ in_array($j, request()->jenis ?? []) ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $j }}</label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- TIPE --}}
                    <div class="dropdown flex-fill" style="min-width: 150px;">
                        <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                            Tipe
                        </button>
                        <ul class="dropdown-menu p-2 mt-3 ps-3" style="width: 180px;">
                            <label class="form-label fw-bold ms-2 text-dark">Tipe</label>

                            @foreach (['WFO','WFH','Remote'] as $t)
                                <li>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input filter-check"
                                            name="tipe[]" value="{{ $t }}"
                                            {{ in_array($t, request()->tipe ?? []) ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $t }}</label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- LOKASI --}}
                    <div class="dropdown flex-fill" style="min-width: 150px;">
                        <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                            Lokasi
                        </button>
                        <ul class="dropdown-menu p-2 mt-3 ps-3" style="width: 180px;">
                            <label class="form-label fw-bold ms-2 text-dark">Lokasi</label>
                            <li><input type="search" id="searchLocation" class="form-control form-control-sm mb-2" placeholder="Cari Lokasi"></li>
                            @php
                                $locations = $works->pluck('lokasi')->unique()->sort();
                            @endphp
                            @foreach ($locations as $t)
                                <li>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input filter-check"
                                            name="tipe[]" value="{{ $t }}"
                                            {{ in_array($t, request()->lokasi ?? []) ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $t }}</label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- SORT (tetap sama seperti desain awal) --}}
                    <div class="d-flex align-items-center flex-fill" style="min-width: 200px;">
                        <label class="form-label mb-0 me-2 small text-muted">Urut Berdasarkan:</label>
                        <div class="dropdown flex-grow-1">
                            <button class="btn btn-outline-secondary dropdown-toggle w-100"
                                type="button" data-bs-toggle="dropdown">
                                {{ request('sort_by') == 'oldest' ? 'Terlama' : 'Terbaru' }}
                            </button>
                            <ul class="dropdown-menu p-2 mt-3" style="width: 210px;">
                                <label class="form-label fw-bold ms-2 text-dark">Urutkan</label>
                                <li><button class="dropdown-item" onclick="applySort('latest')">Terbaru</button></li>
                                <li><button class="dropdown-item" onclick="applySort('oldest')">Terlama</button></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <input type="hidden" name="sort_by" id="sortInput" value="{{ request('sort_by') ?? 'latest' }}">
    </form>

    {{-- Data Count --}}
    <p id="data-ditemukan" class="text-muted small mb-4">
        <span id="showing-count">0</span> dari <span id="total-count">0</span> data ditemukan
    </p>

    {{-- Daftar Pekerjaan --}}
    <div class="row g-4 project-list">
        @forelse ($works as $work)
        <div class="col-md-4 col-sm-6">
            <div class="card border-1 shadow-sm rounded-4 h-100 p-3 job-card"
                data-id="{{ $work->id }}"
                data-posisi="{{ $work->posisi }}"
                data-program="{{ $work->dataProgram->judul }}"
                data-level="{{ $work->level }}"
                data-kualifikasi="{{ $work->kualifikasi }}"
                data-jenis="{{ $work->jenis }}"
                data-bidang="{{ $work->dataProgram->kategori->name }}"
                data-tipe="{{ $work->tipe }}"
                data-lokasi="{{ $work->lokasi }}"
                data-gaji="{{ $work->gaji }}"
                data-tenggat="{{ \Carbon\Carbon::parse($work->tenggat_waktu)->format('d M Y') }}"
                data-deskripsi="{{ $work->deskripsi }}"
                data-logo="{{ $work->logo ? asset('storage/' . $work->logo) : asset('assets/images/logo_kuburaya.png') }}">

                <div class="d-flex align-items-start mb-3">
                    <img src="{{ $work->logo ? asset('storage/' . $work->logo) : asset('assets/images/logo_kuburaya.png') }}"
                        alt="Logo" height="40">

                    <div class="ms-3">
                        <h6 class="fw-bold mb-0">{{ $work->posisi }}</h6>
                        <small class="text-muted">{{ $work->dataProgram->judul }}</small>
                    </div>
                </div>

                <ul class="list-unstyled small mb-0">
                    <li class="mb-1"><i class="bi bi-mortarboard me-2"></i>{{ $work->level }}</li>
                    <li class="mb-1"><i class="bi bi-briefcase me-2"></i>{{ $work->jenis }}</li>
                    <li class="mb-1"><i class="bi bi-file-earmark-text me-2"></i>{{ $work->tipe }}</li>
                    <li class="mb-1"><i class="bi bi-geo-alt me-2"></i>{{ $work->lokasi }}</li>
                    <li><i class="bi bi-cash-stack me-2"></i>{{ $work->gaji }}</li>
                </ul>
            </div>
        </div>
        @empty
            <div class="text-center text-muted py-5">
                Tidak ada pekerjaan ditemukan.
            </div>
        @endforelse
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
        <img id="detailLogo" src="{{ asset('assets/images/logo_kuburaya.png') }}" alt="Logo" height="50" class="me-3">
        <div>
          <h5 class="fw-bold mb-0" id="detailPosisi">Posisi Pekerjaan</h5>
          <small class="text-muted" id="detailProgram">Nama Proyek</small>
        </div>
        <span class="text-danger small ms-auto" id="detailTenggat">Tenggat Waktu</span>
      </div>
      <ul class="list-unstyled text-muted mb-3 small">
        <li class="mb-2"><i class="bi bi-mortarboard me-2"></i><span id="detailLevel">Level Pekerjaan</span></li>
        <li class="mb-2"><i class="bi bi-briefcase me-2"></i><span id="detailJenis">Jenis Pekerjaan</span></li>
        <li class="mb-2"><i class="bi bi-file-earmark-text me-2"></i><span id="detailBidang">Bidang Pekerjaan</span></li>
        <li class="mb-2"><i class="bi bi-geo-alt me-2"></i><span id="detailTipe">Tipe Pekerjaan</span> • <span id="detailLokasi">Lokasi</span></li>
        <li class="mb-2"><i class="bi bi-cash-stack me-2"></i><span id="detailGaji">Range Gaji</span></li>
      </ul>
      <div class="text-center">
        <button id="openApplyForm" class="btn btn-outline-success w-75 fw-semibold rounded-pill mb-4">
            Lamar Sekarang
        </button>
      </div>

      <div class="border rounded-3 p-3 mb-3">
        <h6 class="fw-bold">Deskripsi Pekerjaan</h6>
        <div id="detailDeskripsi" class="small mb-3">
          <p>Deskripsi akan muncul di sini</p>
        </div>

        <h6 class="fw-bold">Kualifikasi Minimum</h6>
        <div id="detailKualifikasi" class="small mb-0">
          <p>Kualifikasi akan muncul di sini</p>
        </div>
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
    <h5 class="fw-bold mb-1" id="applyPosisi">Lamar Posisi</h5>
    <p class="text-muted mb-4" id="applyProgram">Nama Proyek</p>

    {{-- Show validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('applications.store') }}" method="POST" enctype="multipart/form-data" class="text-start">
      @csrf
      <input type="hidden" name="work_id" id="applyWorkId" value="{{ old('work_id') }}">

      <div class="mb-2">
        <label class="form-label fw-semibold small text-dark">Nama Lengkap</label>
        <input type="text" name="nama" value="{{ old('nama') }}" class="form-control form-control-sm bg-light border-0 rounded-3 @error('nama') is-invalid @enderror" placeholder="Masukkan Nama Lengkap Anda" required>
        @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-2">
        <label class="form-label fw-semibold small text-dark">No. Telepon</label>
        <input type="tel" name="nomor_telepon" value="{{ old('nomor_telepon') }}" class="form-control form-control-sm bg-light border-0 rounded-3 @error('nomor_telepon') is-invalid @enderror" placeholder="Masukkan Nomor Telepon" required>
        @error('nomor_telepon')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-2">
        <label class="form-label fw-semibold small text-dark">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="form-control form-control-sm bg-light border-0 rounded-3 @error('email') is-invalid @enderror" placeholder="Masukkan Email Anda" required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-2">
        <label class="form-label fw-semibold small text-dark">Lokasi</label>
        <input type="text" name="lokasi" value="{{ old('lokasi') }}" class="form-control form-control-sm bg-light border-0 rounded-3 @error('lokasi') is-invalid @enderror" placeholder="Masukkan Nama Kota/Kabupaten" required>
        @error('lokasi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-2">
        <label class="form-label fw-semibold small text-dark">Institusi Pendidikan Terakhir</label>
        <input type="text" name="pendidikan" value="{{ old('pendidikan') }}" class="form-control form-control-sm bg-light border-0 rounded-3 @error('pendidikan') is-invalid @enderror" placeholder="Cth: Universitas Indonesia" required>
        @error('pendidikan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-2">
        <label class="form-label fw-semibold small text-dark">Jurusan</label>
        <input type="text" name="jurusan" value="{{ old('jurusan') }}" class="form-control form-control-sm bg-light border-0 rounded-3 @error('jurusan') is-invalid @enderror" placeholder="Cth: Informatika, Teknik Industri" required>
        @error('jurusan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-2">
        <label class="form-label fw-semibold small text-dark">CV (PDF, max 5MB)</label>
        <input type="file" name="cv" accept="application/pdf" class="form-control form-control-sm bg-light border-0 rounded-3 @error('cv') is-invalid @enderror" required>
        @error('cv')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold small text-dark">Portofolio</label>
        <div class="input-group input-group-sm">
          <input type="url" name="portofolio" value="{{ old('portofolio') }}" class="form-control bg-light border-0 rounded-start-3 @error('portofolio') is-invalid @enderror" placeholder="https://" required>
          <button id="clearPortofolio" class="btn btn-outline-secondary rounded-end-3 py-1 px-2" type="button">
            <i class="bi bi-trash"></i>
          </button>
          @error('portofolio')
              <div class="invalid-feedback">{{ $message }}</div>
          @enderror
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

@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const itemsPerPage = 9;
    let currentPage = 1;
    let filteredCards = [];

    // Get all job cards
    const allCards = Array.from(document.querySelectorAll('.job-card'));

    // Get filter elements
    const searchInput = document.querySelector('input[name="search"]');
    const lokasiInput = document.querySelector('input[name="lokasi[]"]');
    const levelCheckboxes = document.querySelectorAll('input[name="level[]"]');
    const jenisCheckboxes = document.querySelectorAll('input[name="jenis[]"]');
    const tipeCheckboxes = document.querySelectorAll('input[name="tipe[]"]');
    const searchLocation = document.getElementById('searchLocation');
    const sortButtons = document.querySelectorAll('[onclick^="applySort"]');

    // Prevent form submission
    const filterForm = document.getElementById('filterForm');
    if (filterForm) {
        filterForm.addEventListener('submit', function(e) {
            e.preventDefault();
        });
    }

    function normalizeText(text) {
        return text.toLowerCase().trim();
    }

    function filterAndSort() {
        // Get current filter values
        const searchTerm = normalizeText(searchInput.value);
        // const lokasiTerm = normalizeText(lokasiInput.value);

        const selectedLevels = Array.from(levelCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => normalizeText(cb.value));

        const selectedJenis = Array.from(jenisCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => normalizeText(cb.value));

        const selectedTipe = Array.from(tipeCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => normalizeText(cb.value));

        const sortBy = document.getElementById('sortInput').value;

        // Filter cards
        filteredCards = allCards.filter(card => {
            // Search filter
            if (searchTerm) {
                const posisi = normalizeText(card.dataset.posisi);
                const program = normalizeText(card.dataset.program);
                const deskripsi = normalizeText(card.dataset.deskripsi || '');

                if (!posisi.includes(searchTerm) &&
                    !program.includes(searchTerm) &&
                    !deskripsi.includes(searchTerm)) {
                    return false;
                }
            }

            // Level filter
            if (selectedLevels.length > 0) {
                const cardLevel = normalizeText(card.dataset.level);
                if (!selectedLevels.includes(cardLevel)) {
                    return false;
                }
            }

            // Jenis filter
            if (selectedJenis.length > 0) {
                const cardJenis = normalizeText(card.dataset.jenis);
                if (!selectedJenis.includes(cardJenis)) {
                    return false;
                }
            }

            // Tipe filter
            if (selectedTipe.length > 0) {
                const cardTipe = normalizeText(card.dataset.tipe);
                if (!selectedTipe.includes(cardTipe)) {
                    return false;
                }
            }

            // Lokasi filter
            if (lokasiTerm) {
                const cardLokasi = normalizeText(card.dataset.lokasi);
                if (!cardLokasi.includes(lokasiTerm)) {
                    return false;
                }
            }

            return true;
        });

         // Search within location dropdown
        if (searchLocation) {
            searchLocation.addEventListener('input', function() {
                const term = normalizeText(this.value);
                locationCheckboxes.forEach(cb => {
                    const matches = normalizeText(cb.value).includes(term);
                    cb.closest('li').style.display = matches ? 'block' : 'none';
                });
            });
        }

        // Sort cards
        filteredCards.sort((a, b) => {
            const dateA = new Date(a.dataset.tenggat);
            const dateB = new Date(b.dataset.tenggat);

            if (sortBy === 'oldest') {
                return dateA - dateB;
            } else {
                return dateB - dateA;
            }
        });

        // Reset to page 1
        currentPage = 1;

        // Update display
        showPage(1);
    }

    function showPage(page) {
        currentPage = page;
        const totalItems = filteredCards.length;
        const totalPages = Math.ceil(totalItems / itemsPerPage);

        // Hide all cards first
        allCards.forEach(card => {
            card.closest('.col-md-4').style.display = 'none';
        });

        // Show "no data" message if no results
        let noDataDiv = document.querySelector('.no-data-message');
        if (totalItems === 0) {
            if (!noDataDiv) {
                noDataDiv = document.createElement('div');
                noDataDiv.className = 'col-12 no-data-message';
                // noDataDiv.innerHTML = '<div class="text-center text-muted py-5">Tidak ada pekerjaan ditemukan.</div>';
                document.querySelector('.project-list').appendChild(noDataDiv);
            }
            noDataDiv.style.display = 'block';
        } else {
            if (noDataDiv) {
                noDataDiv.style.display = 'none';
            }
        }

        // Show cards for current page
        const start = (page - 1) * itemsPerPage;
        const end = Math.min(start + itemsPerPage, totalItems);

        for (let i = start; i < end; i++) {
            filteredCards[i].closest('.col-md-4').style.display = 'block';
        }

        // Update counts
        const showingStart = totalItems > 0 ? start + 1 : 0;
        const showingEnd = end;
        document.getElementById('showing-count').textContent = totalItems > 0 ? `${showingStart}-${showingEnd}` : '0';
        document.getElementById('total-count').textContent = totalItems;

        // Update pagination
        renderPagination(totalPages);
    }

    function renderPagination(totalPages) {
        const paginationUl = document.querySelector('#pagination-nav .pagination');
        paginationUl.innerHTML = '';

        if (totalPages <= 1) {
            document.getElementById('pagination-nav').style.display = 'none';
            return;
        }

        document.getElementById('pagination-nav').style.display = 'flex';

        // Previous button
        const prevLi = document.createElement('li');
        prevLi.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
        prevLi.innerHTML = `<a class="page-link" href="#" data-page="${currentPage - 1}">Previous</a>`;
        paginationUl.appendChild(prevLi);

        // Page numbers with smart ellipsis
        const maxVisiblePages = 5;
        let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
        let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

        if (endPage - startPage < maxVisiblePages - 1) {
            startPage = Math.max(1, endPage - maxVisiblePages + 1);
        }

        // First page + ellipsis
        if (startPage > 1) {
            const firstLi = document.createElement('li');
            firstLi.className = 'page-item';
            firstLi.innerHTML = `<a class="page-link" href="#" data-page="1">1</a>`;
            paginationUl.appendChild(firstLi);

            if (startPage > 2) {
                const ellipsisLi = document.createElement('li');
                ellipsisLi.className = 'page-item disabled';
                ellipsisLi.innerHTML = `<span class="page-link">...</span>`;
                paginationUl.appendChild(ellipsisLi);
            }
        }

        // Page numbers
        for (let i = startPage; i <= endPage; i++) {
            const li = document.createElement('li');
            li.className = `page-item ${i === currentPage ? 'active' : ''}`;
            li.innerHTML = `<a class="page-link" href="#" data-page="${i}">${i}</a>`;
            paginationUl.appendChild(li);
        }

        // Ellipsis + last page
        if (endPage < totalPages) {
            if (endPage < totalPages - 1) {
                const ellipsisLi = document.createElement('li');
                ellipsisLi.className = 'page-item disabled';
                ellipsisLi.innerHTML = `<span class="page-link">...</span>`;
                paginationUl.appendChild(ellipsisLi);
            }

            const lastLi = document.createElement('li');
            lastLi.className = 'page-item';
            lastLi.innerHTML = `<a class="page-link" href="#" data-page="${totalPages}">${totalPages}</a>`;
            paginationUl.appendChild(lastLi);
        }

        // Next button
        const nextLi = document.createElement('li');
        nextLi.className = `page-item ${currentPage === totalPages ? 'disabled' : ''}`;
        nextLi.innerHTML = `<a class="page-link" href="#" data-page="${currentPage + 1}">Next</a>`;
        paginationUl.appendChild(nextLi);

        // Add click handlers
        paginationUl.querySelectorAll('a.page-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const page = parseInt(this.dataset.page);
                if (page >= 1 && page <= totalPages) {
                    showPage(page);
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            });
        });
    }

    // Event listeners for real-time filtering

    // Search input with debounce
    let searchTimeout;
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            filterAndSort();
        }, 300);
    });

    // Search on Enter
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            clearTimeout(searchTimeout);
            filterAndSort();
        }
    });

    // // Lokasi input with debounce
    // let lokasiTimeout;
    // lokasiInput.addEventListener('input', function() {
    //     clearTimeout(lokasiTimeout);
    //     lokasiTimeout = setTimeout(() => {
    //         filterAndSort();
    //     }, 300);
    // });

    // // Lokasi on Enter
    // lokasiInput.addEventListener('keypress', function(e) {
    //     if (e.key === 'Enter') {
    //         e.preventDefault();
    //         clearTimeout(lokasiTimeout);
    //         filterAndSort();
    //     }
    // });

    // Checkbox filters - instant
    [...levelCheckboxes, ...jenisCheckboxes, ...tipeCheckboxes, ...lokasiInput].forEach(checkbox => {
        checkbox.addEventListener('change', filterAndSort);
    });

    // Initialize
    filteredCards = [...allCards];
    showPage(1);
});

// Replace applySort function
function applySort(value) {
    document.getElementById('sortInput').value = value;

    // Update button text
    const sortButton = document.querySelector('[data-bs-toggle="dropdown"]');
    const buttonParent = sortButton.closest('.d-flex.align-items-center');
    if (buttonParent) {
        const btn = buttonParent.querySelector('.dropdown-toggle');
        btn.textContent = value === 'oldest' ? 'Terlama' : 'Terbaru';
    }

    // Trigger filter
    const event = new Event('change');
    document.getElementById('sortInput').dispatchEvent(event);

    // Re-filter and sort
    const filterEvent = new CustomEvent('filterchange');
    document.dispatchEvent(filterEvent);

    // Manual trigger
    setTimeout(() => {
        const searchInput = document.querySelector('input[name="search"]');
        searchInput.dispatchEvent(new Event('input'));
    }, 50);
}
</script>
