@extends('layouts.main')

@section('title', $categoryName)

@section('content')

<section class="py-5 mt-5">
    <div class="container col-lg-9 mx-auto">

        <div class="my-5">
            <h1 class="fw-bold">{{ $categoryData->name }}</h1>
            <p class="text-muted">
                {{ $categoryData->description ?? '' }}
                <a href="#" class="text-success text-decoration-underline fw-medium" data-bs-toggle="modal" data-bs-target="#modalInfo">
                    <br>Pelajari selengkapnya.
                </a>
            </p>
        </div>

        <div class="mb-4 d-flex align-items-center flex-wrap info-program">
            <div class="me-5">
                <p class="h4 text-success mb-0">Jumlah Program</p>
                <p class="h2 text-success mb-0">{{ $jumlahProgram }}</p>
            </div>
            {{-- Tampilkan jumlah kecamatan jika kategorinya tertentu --}}
            @if ($categoryData->name === 'Perumahan' || $categoryData->name === 'Rumah Tidak Layak Huni')
                <div class="me-5">
                    <p class="h4 text-success mb-0">Jumlah Kecamatan</p>
                    <p class="h2 text-success mb-0">{{ $jumlahKecamatan }}</p>
                </div>
            @endif
        </div>

        <hr class="mb-4">

        {{-- Filter Bar --}}
        <div id="filterForm">
            <div class="row g-2 mb-3">
                <div class="col-lg-4">
                    <div class="input-group">
                        <input type="text" name="search" id="searchInput" class="form-control" placeholder="Cari Proyek...">
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
                        @foreach (['Sedang Berjalan','Perencanaan','Ditunda','Tuntas','Dihentikan'] as $status)
                            <li>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input filter-status" value="{{ $status }}" id="status-{{ $loop->index }}">
                                    <label class="form-check-label" for="status-{{ $loop->index }}">{{ $status }}</label>
                                </div>
                            </li>
                        @endforeach
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
                                $years = $dataPrograms->pluck('tahun_anggaran')->unique()->sort()->reverse();
                            @endphp
                            @foreach($years as $year)
                                <li>
                                    <div class="form-check ms-2">
                                        <input class="form-check-input filter-year" type="checkbox" value="{{ $year }}" id="year-{{ $year }}">
                                        <label class="form-check-label" for="year-{{ $year }}">{{ $year }}</label>
                                    </div>
                                </li>
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
                                $locations = $dataPrograms->pluck('lokasi')->unique()->sort();
                            @endphp
                            @foreach($locations as $location)
                                <li>
                                    <div class="form-check ms-2">
                                        <input class="form-check-input filter-location" type="checkbox" value="{{ $location }}" id="loc-{{ $loop->index }}">
                                        <label class="form-check-label" for="loc-{{ $loop->index }}">{{ $location }}</label>
                                    </div>
                                </li>
                            @endforeach
                        </div>
                    </ul>
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                <div class="text-dark mb-2 mb-md-0">
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
                            <li><button class="dropdown-item small sort-option" type="button" data-sort="latest">Terbaru</button></li>
                            <li><button class="dropdown-item small sort-option" type="button" data-sort="oldest">Terlama</button></li>
                            <li><button class="dropdown-item small sort-option" type="button" data-sort="relevant">Paling Relevan</button></li>
                        </ul>
                    </div>
                </div>
            </div>

            <input type="hidden" name="sort_by" id="sortInput" value="latest">
        </div>

        {{-- Project List --}}
        {{-- Project List --}}
        <div class="row g-3 project-list" id="projectList">
            @foreach($dataPrograms as $program)
            <div class="col-12 project-item"
                data-judul="{{ strtolower($program->judul) }}"
                data-status="{{ $program->status_proyek }}"
                data-tahun="{{ $program->tahun_anggaran }}"
                data-lokasi="{{ strtolower($program->lokasi) }}"
                data-created="{{ $program->created_at->format('Y-m-d H:i:s') }}">

                <div class="card mb-3 shadow-sm border-0">
                    <div class="row g-0">
                        <div class="col-md-2">
                            <img src="{{ $program->foto ?? asset('assets/images/' . $categoryName . '.png') }}"
                                class="img-fluid rounded-start"
                                alt="{{ $program->judul }}"
                                style="height: 200px; width: 100%; object-fit: cover;">
                        </div>
                        <div class="col-md-10">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title fw-bold mb-2">{{ $program->judul }}</h5>
                                        <div class="card-text text-muted small mb-3">
                                            <span class="me-3 d-inline-block">
                                                <i class="fas fa-calendar-alt me-1 text-secondary"></i>
                                                {{ \Carbon\Carbon::parse($program->waktu_mulai)->format('d M Y') }} -
                                                {{ \Carbon\Carbon::parse($program->waktu_selesai)->format('d M Y') }}
                                            </span>
                                            <span class="me-3 d-inline-block">
                                                <i class="fas fa-calendar-check me-1 text-secondary"></i>
                                                {{ $program->tahun_anggaran }}
                                            </span>
                                            <span class="d-inline-block">
                                                <i class="fas fa-map-marker-alt me-1 text-secondary"></i>
                                                {{ $program->lokasi }}
                                            </span>
                                        </div>
                                        <div style="max-width: 160px">
                                            @php
                                                $statusConfig = [
                                                    'Sedang Berjalan' => ['color' => 'primary', 'icon' => 'manufacturing'],
                                                    'Perencanaan' => ['color' => 'info', 'icon' => 'schedule'],
                                                    'Ditunda' => ['color' => 'warning', 'icon' => 'pause_circle'],
                                                    'Tuntas' => ['color' => 'success', 'icon' => 'check_circle'],
                                                    'Dihentikan' => ['color' => 'danger', 'icon' => 'cancel']
                                                ];
                                                $config = $statusConfig[$program->status_proyek] ?? ['color' => 'secondary', 'icon' => 'info'];
                                            @endphp
                                            <span class="badge d-flex align-items-center bg-{{ $config['color'] }} text-light rounded-1 px-2 py-1 fw-medium">
                                                <span class="material-symbols-outlined me-2" style="font-size: 18px;">{{ $config['icon'] }}</span>
                                                {{ $program->status_proyek }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ms-3 flex-shrink-0">
                                        <a href="/data-programs/{{ $categoryName }}/{{ $program->id }}" class="btn btn-outline-success rounded-pill px-4 py-2">
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Empty State --}}
        <div class="text-center py-5 my-5 d-none no-data-message">
            <span class="material-symbols-outlined d-block mb-3 mt-5 text-secondary" style="font-size: 120px;">hourglass_empty</span>
            <p class="text-muted fs-6 mb-5">Belum terdapat data di halaman ini.</p>
        </div>

        {{-- Pagination --}}
        <nav aria-label="Page navigation" class="mt-4" id="pagination-nav">
            <ul class="pagination justify-content-center"></ul>
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
            <div class="modal-body p-4 modal-info-size">
                <h5 class="fw-bold mb-2">{{ $categoryData->name ?? '' }}</h5>
                <p>{!! nl2br(e($categoryData->description ?? '')) !!}</p>
                <h6 class="fw-bold mt-4 mb-2">Tujuan & Manfaat</h6>
                <h7 class="mt-4 mb-2">{{ $categoryData->tujuan ?? '' }}</h6>
                <h6 class="fw-bold mt-4 mb-2">Contoh Program</h6>
                <ul>
                    <li>{{ $categoryData->contoh_program_1 ?? '' }}</li>
                    <li>{{ $categoryData->contoh_program_2 ?? '' }}</li>
                    <li>{{ $categoryData->contoh_program_3 ?? '' }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('=== FILTER SCRIPT STARTING ===');

    const itemsPerPage = 5;
    let currentPage = 1;
    let filteredItems = [];

    // Get all project items
    const allItems = Array.from(document.querySelectorAll('.project-item'));
    const projectListContainer = document.getElementById('projectList');
    console.log('Total project items found:', allItems.length);

    if (allItems.length > 0) {
        console.log('First item data:', {
            judul: allItems[0].dataset.judul,
            status: allItems[0].dataset.status,
            tahun: allItems[0].dataset.tahun,
            lokasi: allItems[0].dataset.lokasi,
            created: allItems[0].dataset.created
        });
    }

    // Get filter elements
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.getElementById('searchButton');
    const statusCheckboxes = document.querySelectorAll('.filter-status');
    const yearCheckboxes = document.querySelectorAll('.filter-year');
    const locationCheckboxes = document.querySelectorAll('.filter-location');
    const searchYear = document.getElementById('searchYear');
    const searchLocation = document.getElementById('searchLocation');
    const sortOptions = document.querySelectorAll('.sort-option');

    function normalizeText(text) {
        return String(text || '').toLowerCase().trim();
    }

    function filterAndSort() {
        console.log('=== FILTERING START ===');

        // Get current filter values
        const searchTerm = normalizeText(searchInput.value);
        console.log('Search term:', searchTerm);

        const selectedStatuses = Array.from(statusCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);
        console.log('Selected statuses:', selectedStatuses);

        const selectedYears = Array.from(yearCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);
        console.log('Selected years:', selectedYears);

        const selectedLocations = Array.from(locationCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => normalizeText(cb.value));
        console.log('Selected locations:', selectedLocations);

        const sortBy = document.getElementById('sortInput').value;
        console.log('Sort by:', sortBy);

        // Filter items
        filteredItems = allItems.filter(item => {
            // Search filter
            if (searchTerm) {
                const judul = normalizeText(item.dataset.judul);
                if (!judul.includes(searchTerm)) {
                    return false;
                }
            }

            // Status filter
            if (selectedStatuses.length > 0) {
                const itemStatus = item.dataset.status;
                if (!selectedStatuses.includes(itemStatus)) {
                    return false;
                }
            }

            // Year filter
            if (selectedYears.length > 0) {
                const itemYear = String(item.dataset.tahun);
                if (!selectedYears.includes(itemYear)) {
                    return false;
                }
            }

            // Location filter
            if (selectedLocations.length > 0) {
                const itemLokasi = normalizeText(item.dataset.lokasi);
                if (!selectedLocations.includes(itemLokasi)) {
                    return false;
                }
            }

            return true;
        });

        console.log('Filtered items count:', filteredItems.length);

        // Sort items
        filteredItems.sort((a, b) => {
            if (sortBy === 'oldest') {
                // Oldest first - ascending by date
                const dateA = new Date(a.dataset.created);
                const dateB = new Date(b.dataset.created);
                return dateA - dateB;
            } else if (sortBy === 'latest') {
                // Latest first - descending by date
                const dateA = new Date(a.dataset.created);
                const dateB = new Date(b.dataset.created);
                return dateB - dateA;
            } else if (sortBy === 'relevant') {
                // Relevant - alphabetical by title
                const judulA = normalizeText(a.dataset.judul);
                const judulB = normalizeText(b.dataset.judul);
                return judulA.localeCompare(judulB);
            }
            return 0;
        });

        console.log('After sorting, first 3 items:', filteredItems.slice(0, 3).map(item => ({
            judul: item.dataset.judul,
            created: item.dataset.created
        })));

        // IMPORTANT: Reorder DOM elements to match sorted array
        reorderDOMElements();

        // Reset to page 1
        currentPage = 1;

        // Update display
        showPage(1);
        console.log('=== FILTERING END ===');
    }

    function reorderDOMElements() {
        console.log('=== REORDERING DOM ===');

        // Remove all items from DOM
        allItems.forEach(item => {
            item.remove();
        });

        // Append sorted items back to container
        filteredItems.forEach(item => {
            projectListContainer.appendChild(item);
        });

        console.log('DOM reordered successfully');
    }

    function showPage(page) {
        currentPage = page;
        const totalItems = filteredItems.length;
        const totalPages = Math.ceil(totalItems / itemsPerPage);

        console.log('Showing page:', page, '| Total items:', totalItems, '| Total pages:', totalPages);

        // Hide all items first
        allItems.forEach(item => {
            item.style.display = 'none';
        });

        // Show "no data" message if no results
        const noDataDiv = document.querySelector('.no-data-message');
        if (totalItems === 0) {
            noDataDiv.classList.remove('d-none');
        } else {
            noDataDiv.classList.add('d-none');
        }

        // Show items for current page
        const start = (page - 1) * itemsPerPage;
        const end = Math.min(start + itemsPerPage, totalItems);

        for (let i = start; i < end; i++) {
            filteredItems[i].style.display = 'block';
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

        document.getElementById('pagination-nav').style.display = 'block';

        // Previous button
        const prevLi = document.createElement('li');
        prevLi.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
        prevLi.innerHTML = `<a class="page-link" href="#" data-page="${currentPage - 1}"><</a>`;
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
        nextLi.innerHTML = `<a class="page-link" href="#" data-page="${currentPage + 1}">></a>`;
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

    // Event Listeners

    // Search button click
    if (searchButton) {
        searchButton.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Search button clicked');
            filterAndSort();
        });
    }

    // Search input with debounce
    let searchTimeout;
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                console.log('Search input changed:', this.value);
                filterAndSort();
            }, 300);
        });

        // Search on Enter
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                console.log('Enter pressed in search');
                clearTimeout(searchTimeout);
                filterAndSort();
            }
        });
    }

    // Checkbox filters - instant
    statusCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            console.log('Status checkbox changed:', this.value, this.checked);
            filterAndSort();
        });
    });

    yearCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            console.log('Year checkbox changed:', this.value, this.checked);
            filterAndSort();
        });
    });

    locationCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            console.log('Location checkbox changed:', this.value, this.checked);
            filterAndSort();
        });
    });

    // Sort options
    sortOptions.forEach(option => {
        option.addEventListener('click', function(e) {
            e.preventDefault();
            const sortValue = this.dataset.sort;
            console.log('Sort option clicked:', sortValue);

            // Update hidden input
            document.getElementById('sortInput').value = sortValue;

            // Update button text
            const sortLabels = {
                'latest': 'Terbaru',
                'oldest': 'Terlama',
                'relevant': 'Paling Relevan'
            };

            document.getElementById('sortButton').textContent = sortLabels[sortValue] || 'Terbaru';

            // Trigger filter and sort
            filterAndSort();
        });
    });

    // Search within year dropdown
    if (searchYear) {
        searchYear.addEventListener('input', function() {
            const term = normalizeText(this.value);
            yearCheckboxes.forEach(cb => {
                const matches = normalizeText(cb.value).includes(term);
                cb.closest('li').style.display = matches ? 'block' : 'none';
            });
        });
    }

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

    // Initialize - show all items sorted by latest
    filteredItems = [...allItems];
    filterAndSort();

    console.log('=== FILTER SYSTEM INITIALIZED ===');
});
</script>
