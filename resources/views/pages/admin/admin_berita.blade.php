@extends('layouts.admin')

@section('title', 'Admin Banner Berita')

@section('content')

<section class="py-3 px-4">
    <div class="container-fluid">
        <div class="align-items-center mb-4 mt-2">
            <h2 class="fw-bold" style="color:#4A7097;">Banner Berita</h2>
        </div>

        <div class="mb-4">
            <button class="btn btn-outline-custom rounded-pill px-3 py-0 d-flex align-items-center gap-2"
                    data-bs-toggle="modal" data-bs-target="#tambahModal">
                <i class="bi bi-plus fs-3"></i>
                <span>Tambah Banner</span>
            </button>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
            <div class="display-data d-flex align-items-center gap-2 mb-2">
                <label class="form-label mb-0 text-muted small">Tampilkan</label>
                <select class="form-select form-select-sm rounded-4 shadow-sm" style="width:70px;">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                </select>
                <span class="small text-muted">entri</span>
            </div>

            <div class="input-group" style="width:280px;">
                <input type="text" class="form-control form-control-sm rounded-start-4 shadow-sm"
                       placeholder="Cari Banner Berita...">
                <button class="btn btn-light border text-light rounded-end-4" style="background-color: #49769B">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>

        {{-- Tabel --}}
        <div class="table-responsive shadow-sm rounded-4">
            <table class="table align-middle" id="dataTable">
                <thead class="table-white border-bottom">
                    <tr class="text-muted">
                        <th style="width:50px;">No</th>
                        <th>Judul Banner Berita</th>
                        <th class="text-center" style="width:120px;">Gambar</th>
                        <th class="text-center" style="width:150px;">Action</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse ($news as $n)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-truncate" style="max-width:400px;">{{ e($n->judul) }}</td>
                            <td class="text-center">
                                @if ($n->gambar)
                                    <img src="{{ asset('storage/' . $n->gambar) }}" alt="News Image" style="max-width: 100px;">
                                @else
                                    <em>No image</em>
                                @endif
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-see btn-primary rounded-2 me-1" data-id="{{ $n->id }}">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-edit-banner btn-warning rounded-2 me-1" data-id="{{ $n->id }}" data-judul="{{ $n->judul }}" data-gambar="{{ $n->gambar }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="{{ route('news.destroy', $n->id) }}" method="POST" style="display: inline-block;">
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
                            <td colspan="4">No news entries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
            <p class="text-muted mb-0 info-pages"></p>
            <nav>
                <ul class="pagination pagination-sm mb-0" id="paginationContainer">
                    <li class="page-item"><a class="page-link border-0" href="#"><i class="bi bi-chevron-left h1"></i></a></li>
                    <li class="page-item active"><a class="page-link border-0 bg-transparent text-dark fw-semibold" href="#"></a></li>
                    <li class="page-item"><a class="page-link border-0 text-secondary" href="#"></a></li>
                    <li class="page-item"><a class="page-link border-0 text-secondary" href="#"></a></li>
                    <li class="page-item"><a class="page-link border-0" href="#"><i class="bi bi-chevron-right"></i></a></li>
                </ul>
            </nav>
        </div>
    </div>
</section>

{{-- MODAL TAMBAH BANNER --}}
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header" style="background-color: #4A7097;">
                <h5 class="modal-title text-white fw-semibold" id="tambahModalLabel">Tambah Banner</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Judul Banner --}}
                    <div class="mb-3">
                        <label for="judul" class="form-label fw-semibold small text-dark">Judul Banner</label>
                        <input type="text" name="judul" id="judul"
                               class="form-control rounded-3"
                               value="{{ old('judul') }}"
                               placeholder="Masukkan Judul Banner...">
                    </div>

                    <div class="mb-3">
                        <label for="gambar" class="form-label fw-semibold small text-dark">Gambar Banner</label>
                        <div id="dropArea"
                             class="border rounded-4 d-flex flex-column align-items-center justify-content-center py-5 position-relative"
                             style="border: 1px solid #ccc; background-color: #fafafa;">
                            <i class="bi bi-plus fs-3 text-muted mb-2"></i>
                            <p class="text-muted small mb-1" id="fileText">Tambahkan atau seret dan lepas gambar</p>
                            <p class="text-secondary small fw-semibold mb-0" id="fileName"></p>
                            <input id="fileInput" type="file" name="gambar" accept="image/*"
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
</div>

{{--MODAL DETAIL BANNER--}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header" style="background-color: #4A7097;">
                <h5 class="modal-title text-white fw-semibold" id="detailModalLabel">Detail Banner</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <div class="row g-4 align-items-start">
                    <div class="col-md-4 text-center">
                        <div class="border rounded-4 overflow-hidden mx-auto" style="width:100%; max-width:220px; height:220px;">
                            <img id="detailImage" src="{{ asset('assets/images/jalan.png') }}"
                                 alt="Gambar Banner" class="img-fluid w-100 h-100 object-fit-cover">
                        </div>
                        <p id="detailImageName" class="text-muted small mt-2 mb-0">gambarbanner.jpg</p>
                    </div>
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-dark mb-1">Judul Banner</label>
                            <input type="text" class="form-control rounded-3" id="detailJudul"
                                   value="Lorem ipsum lorem ipsum lorem ipsum" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-dark mb-1">Waktu Dibuat</label>
                            <input type="text" class="form-control rounded-3" id="detailCreatedAt"
                                   value="Lorem ipsum lorem ipsum lorem ipsum" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-dark mb-1">Waktu Diubah</label>
                            <input type="text" class="form-control rounded-3" id="detailUpdatedAt"
                                   value="Lorem ipsum lorem ipsum lorem ipsum" readonly>
                        </div>
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
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header" style="background-color: #4A7097;">
                <h5 class="modal-title text-white fw-semibold" id="editModalLabel">Edit Banner</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <form id="editBannerForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Judul Banner</label>
                        <input type="text" name="judul" id="editJudul" class="form-control rounded-3" placeholder="Masukkan Judul Banner...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Gambar Banner</label>
                        <div id="editDropArea"
                             class="border rounded-4 d-flex flex-column align-items-center justify-content-center py-5 position-relative"
                             style="border: 1px solid #ccc; background-color: #fafafa;">
                            <i class="bi bi-plus fs-3 text-muted mb-2"></i>
                            <p class="text-muted small mb-1" id="editFileText">Tambahkan atau seret dan lepas gambar</p>
                            <p class="text-secondary small fw-semibold mb-0" id="editFileName"></p> {{-- Nama file --}}
                            <input id="editFileInput" name="gambar" type="file" accept="image/*"
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
</div>

{{-- MODAL HAPUS --}}
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg text-center p-4 mt-5">

            <div class="text-danger mb-3 mt-4">
                <i class="bi bi-trash-fill fs-1"></i>
            </div>

            <h5 class="fw-bold mb-2">Hapus Banner?</h5>
            <p class="text-muted small mb-4">Apakah kamu yakin akan menghapus banner ini?<br>Aksi ini tidak dapat dibatalkan.</p>

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
