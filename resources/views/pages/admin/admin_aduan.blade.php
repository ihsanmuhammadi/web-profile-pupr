@extends('layouts.admin')

@section('title', 'Admin Aduan Masyarakat')

@section('content')

<section class="py-3 px-4">
    <div class="container-fluid">
        <div class="align-items-center mb-4 mt-2">
            <h2 class="fw-bold" style="color:#4A7097;">Aduan Masyarakat</h2>
        </div>

        {{-- <div class="mb-4">
            <button class="btn btn-outline-primary rounded-pill px-4 py-2 d-flex align-items-center gap-2"
                    data-bs-toggle="modal" data-bs-target="#tambahBannerModal">
                <i class="bi bi-plus-circle"></i>
                <span>Tambah Banner</span>
            </button>
        </div> --}}

        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
            <div class="display-data d-flex align-items-center gap-2 mb-2">
                <label class="form-label mb-0 text-muted small">Tampilkan</label>
                <select class="form-select form-select-sm rounded-4 shadow-sm" style="width:70px;"
                        onchange="window.location.href='?per_page='+this.value">
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                </select>
                <span class="small text-muted">entri</span>
            </div>

            <div class="input-group" style="width:280px;">
                <input type="text" id="searchInput" class="form-control form-control-sm rounded-start-4 shadow-sm"
                    placeholder="Cari Banner Berita..." value="{{ request('search') }}">
                <button class="btn btn-light border text-light rounded-end-4"
                        id="searchBtn" style="background-color: #49769B">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>

        {{-- Tabel Banner --}}
        <div class="table-responsive shadow-sm rounded-4">
            <table class="table align-middle">
                <thead class="table-white border-bottom">
                    <tr class="text-muted">
                        <th class="text-center">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aduan</th>
                        <th class="text-center" style="width:150px;">Action</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse ($complaints as $c)
                        <tr>
                            <td class="text-center">{{ $complaints->firstItem() + $loop->index }}</td>
                            <td class="text-truncate" style="max-width:120px;">
                                {{ e($c->nama) }}
                            <td style="max-width:120px;">
                                {{ e($c->email) }}
                            </td>
                            <td style="max-width:250px;">
                                {{ e($c->pesan) }}
                            </td>

                            <td class="text-center">
                                <button class="btn btn-sm btn-see btn-primary rounded-2 me-1" data-id="{{ $c->id }}">
                                    <i class="bi bi-eye"></i>
                                </button>

                                <form action="{{ route('complaints.destroy', $c->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-delete btn-danger rounded-2" onclick="return confirm('Are you sure?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No complaints entries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
           <p class="text-muted mb-0">
                Menampilkan {{ $complaints->firstItem() }} - {{ $complaints->lastItem() }} dari {{ $complaints->total() }} entri
            </p>
            <div class="mt-3">
                {{ $complaints->links('pagination.custom') }}
            </div>
        </div>
    </div>
</section>

{{-- Search function --}}
<form id="searchForm" method="GET" class="d-none">
    <input type="hidden" name="search" value="{{ request('search') }}">
    <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">
</form>

<script>
    document.getElementById('searchBtn').addEventListener('click', function () {
        let value = document.getElementById('searchInput').value;
        let form = document.getElementById('searchForm');

        form.querySelector('input[name="search"]').value = value;
        form.submit();
    });
</script>

{{-- MODAL TAMBAH BANNER --}}
{{-- <div class="modal fade" id="tambahBannerModal" tabindex="-1" aria-labelledby="tambahBannerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header rounded-top-4" style="background-color: #4A7097;">
                <h5 class="modal-title text-white fw-semibold" id="tambahBannerModalLabel">Tambah Banner</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <form>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Judul Banner</label>
                        <input type="text" class="form-control rounded-3" placeholder="Masukkan Judul Banner...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Gambar Banner</label>
                        <div id="dropArea"
                             class="border rounded-4 d-flex flex-column align-items-center justify-content-center py-5 position-relative"
                             style="border: 1px solid #ccc; background-color: #fafafa;">
                            <i class="bi bi-plus fs-3 text-muted mb-2"></i>
                            <p class="text-muted small mb-1" id="fileText">Tambahkan atau seret dan lepas gambar</p>
                            <p class="text-secondary small fw-semibold mb-0" id="fileName"></p>
                            <input id="fileInput" type="file"
                                   class="position-absolute top-0 start-0 w-100 h-100"
                                   style="cursor: pointer; opacity: 0;">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4 gap-2">
                        <button type="button" class="btn btn-outline-danger rounded-pill px-4 fw-semibold" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-outline-primary rounded-pill px-4 fw-semibold">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}

{{--MODAL DETAIL BANNER--}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header" style="background-color: #4A7097;">
                <h5 class="modal-title text-white fw-semibold" id="detailModalLabel">Detail Banner</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <div class="row g-2 align-items-start">
                    <div class="mb-1">
                        <label class="form-label fw-semibold small text-dark mb-1">Nama</label>
                        <input type="text" class="form-control rounded-3" id="detailNama" value="Lorem ipsum lorem ipsum lorem ipsum" readonly>
                    </div>
                    <div class="mb-1">
                        <label class="form-label fw-semibold small text-dark mb-1">Email</label>
                        <input type="text" class="form-control rounded-3" id="detailPosisi" value="Lorem ipsum lorem ipsum lorem ipsum" readonly>
                    </div>
                    <div class="mb-1">
                        <label class="form-label fw-semibold small text-dark mb-1">Aduan</label>
                        <textarea class="form-control rounded-3" id="detailDeskripsi" rows="5" readonly>Lorem ipsum lorem ipsum lorem ipsum ipsum lorem ipsum lorem ipsum ipsum lorem ipsum lorem ipsum</textarea>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <button type="button" class="btn btn-outline-primary rounded-pill px-4 fw-semibold" data-bs-dismiss="modal">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL EDIT BANNER --}}
{{-- <div class="modal fade" id="editBannerModal" tabindex="-1" aria-labelledby="editBannerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header rounded-top-4" style="background-color: #4A7097;">
                <h5 class="modal-title text-white fw-semibold" id="editBannerModalLabel">Edit Banner</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <form id="editBannerForm">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Judul Banner</label>
                        <input type="text" id="editJudul" class="form-control rounded-3" placeholder="Masukkan Judul Banner...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Gambar Banner</label>
                        <div id="editDropArea"
                             class="border rounded-4 d-flex flex-column align-items-center justify-content-center py-5 position-relative"
                             style="border: 1px solid #ccc; background-color: #fafafa;">
                            <i class="bi bi-plus fs-3 text-muted mb-2"></i>
                            <p class="text-muted small mb-1" id="editFileText">Tambahkan atau seret dan lepas gambar</p>
                            <p class="text-secondary small fw-semibold mb-0" id="editFileName"></p>
                            <input id="editFileInput" type="file"
                                   class="position-absolute top-0 start-0 w-100 h-100"
                                   style="cursor: pointer; opacity: 0;">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4 gap-2">
                        <button type="button" class="btn btn-outline-danger rounded-pill px-4 fw-semibold" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-outline-primary rounded-pill px-4 fw-semibold">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}

{{-- MODAL HAPUS --}}
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg text-center p-4 mt-5">

            <div class="text-danger mb-3 mt-4">
                <i class="bi bi-trash-fill fs-1"></i>
            </div>

            <h5 class="fw-bold mb-2">Hapus Aduan Masyarakat?</h5>
            <p class="text-muted small mb-4">Apakah kamu yakin akan menghapus aduan masyarakat ini?<br>Aksi ini tidak dapat dibatalkan.</p>

            <div class="d-flex justify-content-center gap-3 mb-4">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-4 fw-semibold" data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="button" id="confirmDeleteBtn" class="btn btn-outline-danger rounded-pill px-4 fw-semibold">
                    Hapus
                </button>
            </div>
        </div>
    </div>
</div>

@endsection
