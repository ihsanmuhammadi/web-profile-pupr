@extends('layouts.admin')

@section('title', 'Admin Pedoman')

@section('content')

<section class="py-3 px-4">
    <div class="container-fluid">
        <div class="align-items-center mb-4 mt-2">
            <h2 class="fw-bold" style="color:#4A7097;">Pedoman</h2>
        </div>

        <div class="mb-4">
            <button class="btn btn-outline-custom rounded-pill px-3 py-0 d-flex align-items-center gap-2"
                    data-bs-toggle="modal" data-bs-target="#tambahModal">
                <i class="bi bi-plus fs-3"></i>
                <span>Tambah Pedoman</span>
            </button>
        </div>

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
                    placeholder="Cari Pedoman..." value="{{ request('search') }}">
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
                        <th>Link Youtube Pedoman</th>
                        <th>Kategori</th>
                        <th>Waktu Dibuat</th>
                        <th class="text-center" style="width:150px;">Action</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse ($guidances as $g)
                        <tr>
                            <td class="text-center">{{ $guidances->firstItem() + $loop->index }}</td>
                            <td class="text-truncate" style="max-width:300px;">
                                {{ e($g->link) }}
                            </td>
                            <td style="max-width:250px;">
                                {{ e($g->kategori) }}
                            </td>
                            <td style="max-width:180px;">
                                {{ e($g->created_at) }}
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-see-guidance btn-primary rounded-2 me-1" data-id="{{ $g->id }}">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-edit-guidance btn-warning rounded-2 me-1" data-id="{{ $g->id }}" data-link="{{ $g->link }}" data-kategori="{{ $g->kategori }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button"
                                    class="btn btn-sm btn-delete btn-danger rounded-2"
                                    data-id="{{ $g->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>

                                <form id="delete-form-{{ $g->id }}"
                                    action="{{ route('guidances.destroy', $g->id) }}"
                                    method="POST"
                                    style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No guidance entries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
            <p class="text-muted mb-0">
                Menampilkan {{ $guidances->firstItem() }} - {{ $guidances->lastItem() }} dari {{ $guidances->total() }} entri
            </p>
            <div class="mt-3">
                {{ $guidances->links('pagination.custom') }}
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

{{-- MODAL TAMBAH PEDOMAN --}}
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header" style="background-color: #4A7097;">
                <h5 class="modal-title text-white fw-semibold" id="tambahModalLabel">Tambah Pedoman</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <form action="{{ route('guidances.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Link Youtube</label>
                        <input type="text" name="link"
                               class="form-control rounded-3"
                               value="{{ old('link') }}"
                               placeholder="Masukkan Link Pedoman...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Kategori</label>
                        <select name="kategori" class="form-select rounded-3">
                            <option selected disabled>Pilih Kategori Pedoman</option>
                            <option value="Spesifikasi Teknis">Pedoman Spesifikasi Teknis</option>
                            <option value="Spesifikasi Daerah">Pedoman Spesifikasi Daerah</option>
                        </select>
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

{{--MODAL DETAIL --}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header" style="background-color: #4A7097;">
                <h5 class="modal-title text-white fw-semibold" id="detailModalLabel">Detail Pedoman</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <div class="row align-items-start p-2">

                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-dark mb-1">Link Youtube</label>
                            <input type="text" class="form-control rounded-3" id="detailLink"
                                   value="Lorem ipsum lorem ipsum lorem ipsum" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-dark mb-1">Kategori</label>
                            <input type="text" class="form-control rounded-3" id="detailKategori"
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
                <div class="d-flex justify-content-end mt-4">
                    <button type="button" class="btn btn-outline-primary rounded-pill px-4 fw-semibold" data-bs-dismiss="modal">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL EDIT pedoman--}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header" style="background-color: #4A7097;">
                <h5 class="modal-title text-white fw-semibold" id="editModalLabel">Edit Pedoman</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <form id="editPedomanForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Link Youtube</label>
                        <input type="text" name="link" id="editLinkyt"
                               class="form-control rounded-3"
                               placeholder="Masukkan Link Youtube...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Kategori</label>
                        <select name="kategori" id="editKategori" class="form-select rounded-3">
                            <option selected disabled>Pilih Kategori Pedoman</option>
                            <option value="Spesifikasi Teknis">Spesifikasi Teknis</option>
                            <option value="Spesifikasi Daerah">Spesifikasi Daerah</option>
                        </select>
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

            <h5 class="fw-bold mb-2">Hapus Pedoman?</h5>
            <p class="text-muted small mb-4">Apakah kamu yakin akan menghapus pedoman ini?<br>Aksi ini tidak dapat dibatalkan.</p>

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
