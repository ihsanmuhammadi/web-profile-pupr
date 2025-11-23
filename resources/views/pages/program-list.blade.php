@extends('layouts.main')

@section('title', $categoryName)

@section('content')

<section class="py-5 mt-5">
    <div class="container col-lg-9 mx-auto">

        <div class="my-5">
            <h1 class="fw-bold">{{ $categoryName }}</h1>
            <p class="text-muted">
                Deskripsi singkat lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum ipsum lorem ipsum lorem ipsum lorem ipsum ipsum lorem ipsum lorem ipsum lorem ipsum.
                <a href="#" class="text-success text-decoration-underline fw-medium" data-bs-toggle="modal" data-bs-target="#modalInfo">
                    <br>Pelajari selengkapnya.
                </a>
            </p>
        </div>

        <div class="mb-4 d-flex align-items-center flex-wrap info-program">
            <div class="me-5">
                <p class="h4 text-success mb-0">Jumlah Pekerjaan</p>
                <p class="h2 text-success mb-0" id="total-projects">{{ $dataPrograms->total() }}</p>
            </div>
            <div class="ms-5">
                <p class="h4 text-success mb-0">Total Perkecamatan</p>
                <p class="h2 text-success mb-0" id="total-districts">{{ $dataPrograms->unique('lokasi')->count() }}</p>
            </div>
        </div>

        <hr class="mb-4">

        {{-- Filter Bar --}}
        <div class="row g-2 mb-3">
            <div class="col-lg-4">
                <div class="input-group">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari Proyek..." aria-label="Cari Proyek">
                    <button class="btn btn-success" type="button" id="searchButton">
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
                    <li><div class="form-check"><input class="form-check-input filter-status" type="checkbox" value="Sedang Berjalan"><label class="form-check-label">Sedang Berjalan</label></div></li>
                    <li><div class="form-check"><input class="form-check-input filter-status" type="checkbox" value="Ditunda"><label class="form-check-label">Ditunda</label></div></li>
                    <li><div class="form-check"><input class="form-check-input filter-status" type="checkbox" value="Tuntas"><label class="form-check-label">Tuntas</label></div></li>
                    <li><div class="form-check"><input class="form-check-input filter-status" type="checkbox" value="Dihentikan"><label class="form-check-label">Dihentikan</label></div></li>
                </ul>
            </div>

            <div class="dropdown flex-fill col-lg-3 col-md-4">
                <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                Tahun Anggaran
                </button>
                <ul class="dropdown-menu p-2 mt-3" style="width: 270px;">
                    <label class="form-label fw-bold ms-2 text-dark">Tahun Anggaran</label>
                    <li><input type="search" id="searchYear" class="form-control form-control-sm mb-2 ms-2" style="max-width: 230px;" placeholder="Cari Tahun Anggaran"></li>
                    <div id="yearCheckboxes">
                        @php
                            $years = \App\Models\DataProgram::whereHas('category', function($q) use ($categoryName) {
                                $q->where('name', $categoryName);
                            })->distinct()->pluck('tahun_anggaran')->sort()->reverse();
                        @endphp
                        @foreach($years as $year)
                            <li><div class="form-check"><input class="form-check-input filter-year" type="checkbox" value="{{ $year }}"><label class="form-check-label">{{ $year }}</label></div></li>
                        @endforeach
                    </div>
                </ul>
            </div>

            <div class="dropdown flex-fill col-lg-3 col-md-4">
                <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                Lokasi
                </button>
                <ul class="dropdown-menu p-2 mt-3" style="width: 270px;">
                    <label class="form-label fw-bold ms-2 text-dark">Lokasi</label>
                    <li><input type="search" id="searchLocation" class="form-control form-control-sm mb-2 ms-2" style="max-width: 230px;" placeholder="Cari Lokasi"></li>
                    <div id="locationCheckboxes">
                        @php
                            $locations = \App\Models\DataProgram::whereHas('category', function($q) use ($categoryName) {
                                $q->where('name', $categoryName);
                            })->distinct()->pluck('lokasi')->sort();
                        @endphp
                        @foreach($locations as $location)
                            <li><div class="form-check"><input class="form-check-input filter-location" type="checkbox" value="{{ $location }}"><label class="form-check-label">{{ $location }}</label></div></li>
                        @endforeach
                    </div>
                </ul>
            </div>
        </div>

        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
            <div class="text-dark mb-2 mb-md-0" id="data-ditemukan">
                <span id="showing-count">0</span> dari <span id="total-count">0</span> data ditemukan
            </div>
            <div class="d-flex align-items-center" style="min-width: 200px;">
                <label class="form-label mb-0 me-2 text-muted text-dark">Urut Berdasarkan:</label>
                <div class="dropdown flex-grow-1">
                    <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" id="sortButton">
                        Terbaru
                    </button>
                    <ul class="dropdown-menu p-2 mt-3" style="width: 210px;">
                        <label class="form-label fw-bold ms-2 text-dark">Urutkan</label>
                        <li><button class="dropdown-item small sort-option" data-sort="latest">Terbaru</button></li>
                        <li><button class="dropdown-item small sort-option" data-sort="oldest">Terlama</button></li>
                        <li><button class="dropdown-item small sort-option" data-sort="relevant">Paling Relevan</button></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="project-list" id="projectList">
            {{-- Projects will be loaded here --}}
        </div>

        {{-- Empty State --}}
        <div class="text-center py-5 my-5 d-none" id="empty-state">
            <span class="material-symbols-outlined d-block mb-3 mt-5 text-secondary" style="font-size: 120px;">hourglass_empty</span>
            <p class="text-muted fs-6 mb-5">Belum terdapat data di halaman ini.</p>
        </div>

        {{-- Pagination --}}
        <nav aria-label="Page navigation" class="mt-4" id="pagination-nav">
            <ul class="pagination justify-content-center">
            </ul>
        </nav>

    </div>
</section>

{{-- Modal Informasi --}}
<div class="modal fade" id="modalInfo" tabindex="-1" aria-labelledby="modalInfoLabel" aria-hidden="true">
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

                <h6 class="fw-bold mt-4 mb-2">Contoh Program</h6>
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const itemsPerPage = 7;
    let currentPage = 1;
    let allPrograms = [];
    let filteredPrograms = [];
    let currentSort = 'latest';
    const categoryName = @json($categoryName);

    // Get filter elements
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.getElementById('searchButton');
    const statusCheckboxes = document.querySelectorAll('.filter-status');
    const yearCheckboxes = document.querySelectorAll('.filter-year');
    const locationCheckboxes = document.querySelectorAll('.filter-location');
    const searchYear = document.getElementById('searchYear');
    const searchLocation = document.getElementById('searchLocation');
    const sortOptions = document.querySelectorAll('.sort-option');

    // Fetch all programs on page load
    fetchAllPrograms();

    function fetchAllPrograms() {
        const url = new URL(window.location.href);
        url.searchParams.set('per_page', '1000'); // Get all records

        fetch(url.pathname + '?' + url.searchParams.toString(), {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            allPrograms = data.data || [];
            filteredPrograms = [...allPrograms];
            updateDisplay();
        })
        .catch(error => {
            console.error('Error fetching programs:', error);
            // Fallback to server-rendered data
            allPrograms = @json($dataPrograms->items());
            filteredPrograms = [...allPrograms];
            updateDisplay();
        });
    }

    function normalizeText(text) {
        return String(text || '').toLowerCase().trim();
    }

    function filterAndSort() {
        const searchTerm = normalizeText(searchInput.value);

        const selectedStatuses = Array.from(statusCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);

        const selectedYears = Array.from(yearCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);

        const selectedLocations = Array.from(locationCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => normalizeText(cb.value));

        // Filter programs
        filteredPrograms = allPrograms.filter(program => {
            // Search filter
            if (searchTerm && !normalizeText(program.nama).includes(searchTerm)) {
                return false;
            }

            // Status filter
            if (selectedStatuses.length > 0 && !selectedStatuses.includes(program.status_proyek)) {
                return false;
            }

            // Year filter
            if (selectedYears.length > 0 && !selectedYears.includes(String(program.tahun_anggaran))) {
                return false;
            }

            // Location filter
            if (selectedLocations.length > 0 && !selectedLocations.includes(normalizeText(program.lokasi))) {
                return false;
            }

            return true;
        });

        // Sort programs
        filteredPrograms.sort((a, b) => {
            if (currentSort === 'oldest') {
                return new Date(a.created_at) - new Date(b.created_at);
            } else if (currentSort === 'latest') {
                return new Date(b.created_at) - new Date(a.created_at);
            } else { // relevant
                return normalizeText(a.nama).localeCompare(normalizeText(b.nama));
            }
        });

        currentPage = 1;
        updateDisplay();
    }

    function updateDisplay() {
        const totalItems = filteredPrograms.length;
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        const start = (currentPage - 1) * itemsPerPage;
        const end = Math.min(start + itemsPerPage, totalItems);

        // Update counts
        const showingStart = totalItems > 0 ? start + 1 : 0;
        const showingEnd = end;
        document.getElementById('showing-count').textContent = totalItems > 0 ? `${showingStart}-${showingEnd}` : '0';
        document.getElementById('total-count').textContent = totalItems;
        document.getElementById('total-projects').textContent = totalItems;

        // Show/hide empty state
        const emptyState = document.getElementById('empty-state');
        const projectList = document.getElementById('projectList');

        if (totalItems === 0) {
            emptyState.classList.remove('d-none');
            projectList.innerHTML = '';
        } else {
            emptyState.classList.add('d-none');
            renderProjects(filteredPrograms.slice(start, end));
        }

        // Update pagination
        renderPagination(totalPages);
    }

    function renderProjects(programs) {
        const projectList = document.getElementById('projectList');
        projectList.innerHTML = programs.map(program => {
            const statusConfig = {
                'Sedang Berjalan': { color: 'primary', icon: 'manufacturing' },
                'Ditunda': { color: 'CEAB41', icon: 'pause_circle', custom: true },
                'Tuntas': { color: 'success', icon: 'check_circle' },
                'Dihentikan': { color: 'danger', icon: 'cancel' }
            };
            const config = statusConfig[program.status_proyek] || { color: 'secondary', icon: 'info' };
            const bgStyle = config.custom ? `style="background-color: #${config.color} !important"` : '';
            const bgClass = config.custom ? '' : `bg-${config.color}`;

            return `
                <div class="card mb-3 shadow-sm border-0">
                    <div class="row g-0">
                        <div class="col-md-2">
                            <img src="${program.foto ? '/storage/' + program.foto : '/assets/images/proyek_jalan.png'}"
                                 class="img-fluid rounded-start project-card-image" alt="Gambar Proyek">
                        </div>
                        <div class="col-md-10">
                            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title fw-bold mb-1">${program.nama}</h5>
                                    <div class="card-text text-muted small mb-3">
                                        <span class="me-3 d-inline-block"><i class="fas fa-calendar-alt me-1 text-secondary"></i> ${program.waktu_pelaksanaan || '-'}</span>
                                        <span class="me-3 d-inline-block"><i class="fas fa-calendar-check me-1 text-secondary"></i> ${program.tahun_anggaran}</span>
                                        <span class="d-inline-block"><i class="fas fa-map-marker-alt me-1 text-secondary"></i> ${program.lokasi}</span>
                                    </div>
                                    <div style="max-width: 150px">
                                        <span class="badge d-flex align-items-center ${bgClass} text-light rounded-1 px-2 py-1 fw-medium" ${bgStyle}>
                                            <span class="material-symbols-outlined me-2">${config.icon}</span> ${program.status_proyek}
                                        </span>
                                    </div>
                                </div>
                                <div class="ms-3 flex-shrink-0 d-flex align-items-center">
                                    <a href="/program/${program.id}" class="btn btn-outline-success rounded-pill px-3 py-2">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }).join('');
    }

    function renderPagination(totalPages) {
        const paginationUl = document.querySelector('#pagination-nav .pagination');
        paginationUl.innerHTML = '';

        if (totalPages <= 1) {
            document.getElementById('pagination-nav').style.display = 'none';
            return;
        }

        document.getElementById('pagination-nav').style.display = 'block';

        // Previous button
        const prevLi = document.createElement('li');
        prevLi.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
        prevLi.innerHTML = `<a class="page-link" href="#" data-page="${currentPage - 1}">Previous</a>`;
        paginationUl.appendChild(prevLi);

        // Page numbers
        const maxVisiblePages = 5;
        let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
        let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

        if (endPage - startPage < maxVisiblePages - 1) {
            startPage = Math.max(1, endPage - maxVisiblePages + 1);
        }

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

        for (let i = startPage; i <= endPage; i++) {
            const li = document.createElement('li');
            li.className = `page-item ${i === currentPage ? 'active' : ''}`;
            li.innerHTML = `<a class="page-link" href="#" data-page="${i}">${i}</a>`;
            paginationUl.appendChild(li);
        }

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
                    currentPage = page;
                    updateDisplay();
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            });
        });
    }

    // Event listeners
    let searchTimeout;
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            filterAndSort();
        }, 300);
    });

    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            clearTimeout(searchTimeout);
            filterAndSort();
        }
    });

    searchButton.addEventListener('click', filterAndSort);

    [...statusCheckboxes, ...yearCheckboxes, ...locationCheckboxes].forEach(checkbox => {
        checkbox.addEventListener('change', filterAndSort);
    });

    sortOptions.forEach(option => {
        option.addEventListener('click', function(e) {
            e.preventDefault();
            currentSort = this.dataset.sort;
            document.getElementById('sortButton').textContent = this.textContent;
            filterAndSort();
        });
    });

    // Search within dropdowns
    searchYear.addEventListener('input', function() {
        const searchTerm = normalizeText(this.value);
        yearCheckboxes.forEach(checkbox => {
            const li = checkbox.closest('li');
            const year = normalizeText(checkbox.value);
            li.style.display = year.includes(searchTerm) ? 'block' : 'none';
        });
    });

    searchLocation.addEventListener('input', function() {
        const searchTerm = normalizeText(this.value);
        locationCheckboxes.forEach(checkbox => {
            const li = checkbox.closest('li');
            const location = normalizeText(checkbox.value);
            li.style.display = location.includes(searchTerm) ? 'block' : 'none';
        });
    });
});
</script>
@endpush
