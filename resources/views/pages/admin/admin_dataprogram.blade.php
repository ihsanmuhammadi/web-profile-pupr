@extends('layouts.admin')

@section('title', 'Admin Data & Program')

@section('content')

<section class="py-3 px-4">
    <div class="container-fluid">
        <div class="align-items-center mb-4 mt-2">
            <h2 class="fw-bold" style="color:#4A7097;">Data dan Program</h2>
        </div>

        <div class="mb-4">
            <button class="btn btn-outline-custom rounded-pill px-3 py-0 d-flex align-items-center gap-2"
                    data-bs-toggle="modal" data-bs-target="#tambahModal">
                <i class="bi bi-plus fs-3"></i>
                <span>Tambah Data</span>
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
                    placeholder="Cari Data Program..." value="{{ request('search') }}">
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
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Lokasi</th>
                        <th class="text-center" style="width:150px;">Action</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse ($dataPrograms as $d)
                        <tr>
                            <td class="text-center">{{ $dataPrograms->firstItem() + $loop->index }}</td>
                            <td class="text-truncate" style="max-width:250px;">
                                {{ e($d->judul) }}
                            </td>
                            <td style="max-width:150px;">
                                {{ e($d->kategori->name) }}
                            </td>
                            <td style="max-width:150px;">
                                {{ e($d->status_proyek) }}
                            </td>
                            <td style="max-width:250px;">
                                {{ e($d->lokasi) }}
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-see btn-primary rounded-2 me-1" data-id="{{ $d->id }}">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-edit-pedoman btn-warning rounded-2 me-1" data-id="{{ $d->id }}" data-judul="{{ $d->judul }}" data-kategori_id="{{ $d->kategori_id }}" data-status_proyek="{{ $d->status_proyek }}" data-lokasi="{{ $d->lokasi }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="{{ route('data-programs.destroy', $d->id) }}" method="POST" style="display: inline-block;">
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
                            <td colspan="6">No data & program entries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
            <p class="text-muted mb-0">
                Menampilkan {{ $dataPrograms->firstItem() }} - {{ $dataPrograms->lastItem() }} dari {{ $dataPrograms->total() }} entri
            </p>
            <div class="mt-3">
                {{ $dataPrograms->links('pagination.custom') }}
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

{{-- MODAL TAMBAH TENAGA KERJA --}}
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header" style="background-color: #4A7097;">
                <h5 class="modal-title text-white fw-semibold" id="tambahKategoriModalLabel">Tambah Data & Program</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="formTambahKategori">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Judul</label>
                        <input type="text" class="form-control rounded-3" placeholder="Masukkan Judul Data & Program...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Kategori</label>
                        <select class="form-select rounded-3">
                            <option selected disabled>Pilih Kategori Data & Program</option>
                            <option value="jalan-lingkungan">Jalan Lingkungan</option>
                            <option value="drainase-lingkungan">Drainase Lingkungan</option>
                            <option value="jembatan-lingkungan">Jembatan Lingkungan</option>
                            <option value="rumah-taklayak">Rumah Tidak Layak Huni</option>
                            <option value="perumahan">Perumahan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Sub Judul</label>
                        <input type="text" class="form-control rounded-3" placeholder="Masukkan Sub Judul Data & Program...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Deskripsi Kategori Program</label>
                        <textarea class="form-control rounded-3" placeholder="Masukkan Deskripsi..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Status</label>
                        <select class="form-select rounded-3">
                            <option selected disabled>Pilih Status Data & Program</option>
                            <option value="tuntas">Tuntas</option>
                            <option value="berjalan">Sedang Berjalan</option>
                            <option value="dihentikan">Dihentikan</option>
                        </select>
                    </div>
                    <div class="row g-3 mb-3 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small text-dark">Waktu Mulai</label>
                            <input type="date" class="form-control rounded-3" id="waktuMulai">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small text-dark">Waktu Selesai</label>
                            <input type="date" class="form-control rounded-3" id="waktuSelesai">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small text-dark">Tahun Anggaran</label>
                            <input type="text" class="form-control rounded-3" id="tahunAnggaran" placeholder="Tambah Tahun Anggaran" inputmode="numeric" pattern="[0-9]*" maxlength="4">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Kecamatan</label>
                        <input type="text" class="form-control rounded-3" placeholder="Masukkan Kecamatan Data & Program...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Lokasi</label>
                        <input type="text" class="form-control rounded-3" placeholder="Masukkan Lokasi Data & Program...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Dokumentasi</label>
                        <input type="text" class="form-control rounded-3" placeholder="Masukkan Link Dokumentasi Data & Program...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Tenaga Kerja</label>
                        <div class="tenaga-container">
                            <div class="input-group mb-2 program-item">
                                <input type="text" class="form-control rounded-3" placeholder="Masukkan Nama...">
                                <input type="text" class="form-control rounded-3 ms-2" placeholder="Masukkan Posisi...">
                                <button type="button" class="btn btn-outline-secondary rounded-3 ms-2 remove-program-btn d-none">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                        </div>

                        <button type="button" class="btn btn-outline-secondary rounded-3 px-3 mt-2 add-tenaga-btn">
                            <i class="bi bi-plus me-1"></i>Tambah Tenaga Kerja
                        </button>
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
                <h5 class="modal-title text-white fw-semibold" id="detailModalLabel">Detail Data & Program</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <form id="formDetailKategori">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Judul</label>
                        <input type="text" class="form-control rounded-3" id="detailJudul" value="Lorem ipsum lorem ipsum lorem ipsum" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Kategori</label>
                        <input type="text" class="form-control rounded-3" id="detailKategori" value="Lorem ipsum lorem ipsum lorem ipsum" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Sub Judul</label>
                        <input type="text" class="form-control rounded-3" id="detailSubJudul" value="Lorem ipsum lorem ipsum lorem ipsum" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Deskripsi Kategori Program</label>
                        <input type="text" class="form-control rounded-3" id="detailDeskripsi" value="Lorem ipsum lorem ipsum lorem ipsum" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Status</label>
                        <input type="text" class="form-control rounded-3" id="detailStatus" value="Lorem ipsum lorem ipsum lorem ipsum" readonly>
                    </div>

                    <div class="row g-3 mb-3 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small text-dark">Waktu Mulai</label>
                            <input type="text" class="form-control rounded-3" id="detailWaktuMulai" value="11-11-2025" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small text-dark">Waktu Selesai</label>
                            <input type="text" class="form-control rounded-3" id="detailWaktuSelesai" value="13-11-2025" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small text-dark">Tahun Anggaran</label>
                            <input type="text" class="form-control rounded-3" id="detailTahunAnggaran" value="2025" readonly>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Kecamatan</label>
                        <input type="text" class="form-control rounded-3" id="detailKecamatan" value="Lorem ipsum lorem ipsum lorem ipsum" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Lokasi</label>
                        <input type="text" class="form-control rounded-3" id="detailLokasi" value="Lorem ipsum lorem ipsum lorem ipsum" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Dokumentasi</label>
                        <input type="text" class="form-control rounded-3" id="detailDokumentasi" value="Lorem ipsum lorem ipsum lorem ipsum" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Tenaga Kerja</label>
                        <div id="detailTenagaKerjaContainer">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control rounded-3" id="detailTenagaNama1" value="Lorem Ipsum" readonly>
                                <input type="text" class="form-control rounded-3 ms-2" id="detailTenagaPosisi1" value="Arsitek" readonly>
                            </div>
                            <div class="input-group mb-2">
                                <input type="text" class="form-control rounded-3" id="detailTenagaNama2" value="Lorem Ipsum" readonly>
                                <input type="text" class="form-control rounded-3 ms-2" id="detailTenagaPosisi2" value="Interior" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-outline-primary rounded-pill px-4 fw-semibold" data-bs-dismiss="modal">
                            Tutup
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- MODAL EDIT BANNER --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header" style="background-color: #4A7097;">
                <h5 class="modal-title text-white fw-semibold" id="editModalLabel">Edit Data & Program</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <form id="editBannerForm">

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Judul</label>
                        <input type="text" id="editJudul" class="form-control rounded-3" placeholder="Masukkan Judul Data & Program...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Kategori</label>
                        <select id="editKategori" class="form-select rounded-3">
                            <option selected disabled>Pilih Kategori Data & Program</option>
                            <option value="jalan-lingkungan">Jalan Lingkungan</option>
                            <option value="drainase-lingkungan">Drainase Lingkungan</option>
                            <option value="jembatan-lingkungan">Jembatan Lingkungan</option>
                            <option value="rumah-taklayak">Rumah Tidak Layak Huni</option>
                            <option value="perumahan">Perumahan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Sub Judul</label>
                        <input type="text" id="editSubJudul" class="form-control rounded-3" placeholder="Masukkan Sub Judul Data & Program...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Deskripsi Kategori Program</label>
                        <input type="text" id="editDeskripsi" class="form-control rounded-3" placeholder="Masukkan Deskripsi Kategori Program...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Status</label>
                        <select id="editStatus" class="form-select rounded-3">
                            <option selected disabled>Pilih Status Data & Program</option>
                            <option value="tuntas">Tuntas</option>
                            <option value="berjalan">Sedang Berjalan</option>
                            <option value="dihentikan">Dihentikan</option>
                        </select>
                    </div>

                    <div class="row g-3 mb-3 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small text-dark">Waktu Mulai</label>
                            <input type="date" id="editWaktuMulai" class="form-control rounded-3">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small text-dark">Waktu Selesai</label>
                            <input type="date" id="editWaktuSelesai" class="form-control rounded-3">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small text-dark">Tahun Anggaran</label>
                            <input type="text" id="editTahunAnggaran" class="form-control rounded-3" placeholder="Tambah Tahun Anggaran" inputmode="numeric" pattern="[0-9]*" maxlength="4">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Kecamatan</label>
                        <input type="text" id="editKecamatan" class="form-control rounded-3" placeholder="Masukkan Kecamatan Data & Program...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Lokasi</label>
                        <input type="text" id="editLokasi" class="form-control rounded-3" placeholder="Masukkan Lokasi Data & Program...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Dokumentasi</label>
                        <input type="text" id="editDokumentasi" class="form-control rounded-3" placeholder="Masukkan Link Dokumentasi Data & Program...">
                    </div>

                    <div class="mb-3">
    <label class="form-label fw-semibold small text-dark">Tenaga Kerja</label>

    <div class="tenaga-container">
        <div class="input-group mb-2 program-item">

            <!-- Nama -->
            <input type="text"
                   class="form-control rounded-3"
                   placeholder="Masukkan Nama..."
                   id="editTenagaNama1">

            <!-- Posisi -->
            <input type="text"
                   class="form-control rounded-3 ms-2"
                   placeholder="Masukkan Posisi..."
                   id="editTenagaPosisi1">

            <!-- Tombol hapus -->
            <button type="button" class="btn btn-outline-secondary rounded-3 ms-2 remove-program-btn d-none">
                <i class="bi bi-x"></i>
            </button>
        </div>
    </div>

    <button type="button" class="btn btn-outline-secondary rounded-3 px-3 mt-2 add-tenaga-btn">
        <i class="bi bi-plus me-1"></i>Tambah Tenaga Kerja
    </button>
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

            <h5 class="fw-bold mb-2">Hapus Data & Program?</h5>
            <p class="text-muted small mb-4">Apakah kamu yakin akan menghapus data & program ini?<br>Aksi ini tidak dapat dibatalkan.</p>

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
