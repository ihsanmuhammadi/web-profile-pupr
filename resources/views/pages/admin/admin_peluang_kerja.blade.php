@extends('layouts.admin')

@section('title', 'Admin Peluang Kerja & Magang')

@section('content')

<section class="py-3 px-4">
    <div class="container-fluid">
        <div class="align-items-center mb-4 mt-2">
            <h2 class="fw-bold" style="color:#4A7097;">Peluang Kerja & Magang</h2>
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
                    placeholder="Cari Peluang Kerja & Magang..." value="{{ request('search') }}">
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
                        <th>Posisi</th>
                        <th>Proyek</th>
                        <th>Level Pendidikan</th>
                        <th class="text-center" style="width:150px;">Action</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse ($works as $w)
                        <tr>
                            <td class="text-center">{{ $works->firstItem() + $loop->index }}</td>
                            <td class="text-truncate" style="max-width:250px;">
                                {{ e($w->posisi) }}
                            </td>
                            <td style="max-width:250px;">
                                {{ e($w->dataProgram->judul) }}
                            </td>
                            <td style="max-width:250px;">
                                {{ e($w->kualifikasi) }}
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-see btn-primary rounded-2 me-1" data-id="{{ $w->id }}">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-edit-pedoman btn-warning rounded-2 me-1" data-id="{{ $w->id }}" data-posisi="{{ $w->posisi }}" data-data_program_id="{{ $w->data_program_id }}" data-kualifikasi="{{ $w->kualifikasi }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="{{ route('works.destroy', $w->id) }}" method="POST" style="display: inline-block;">
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
                            <td colspan="5">No works entries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
            <p class="text-muted mb-0">
                Menampilkan {{ $works->firstItem() }} - {{ $works->lastItem() }} dari {{ $works->total() }} entri
            </p>
            <div class="mt-3">
                {{ $works->links('pagination.custom') }}
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
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header" style="background-color: #4A7097;">
                <h5 class="modal-title text-white fw-semibold" id="tambahModalLabel">Tambah Peluang Kerja & Magang</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <form id="formTambahKategori">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Posisi</label>
                        <input type="text" class="form-control rounded-3" placeholder="Masukkan Posisi...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Proyek</label>
                        <select class="form-select rounded-3">
                            <option selected disabled>Tambah Proyek</option>
                            <option value="a">Proyek A</option>
                            <option value="b">Proyek A</option>
                            <option value="c">Proyek A</option>
                            <option value="d">Proyek A</option>
                            <option value="e">Proyek A</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Jenis Pekerjaan</label>
                        <select class="form-select rounded-3">
                            <option selected disabled>Tambah Jenis Pekerjaan</option>
                            <option value="fulltime">Full Time</option>
                            <option value="parttime">Part Time</option>
                            <option value="kontrak">Kontrak</option>
                            <option value="magang">Magang</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Tipe Pekerjaan</label>
                        <select class="form-select rounded-3">
                            <option selected disabled>Tambah Tipe Pekerjaan</option>
                            <option value="wfo">WFO</option>
                            <option value="wfh">WFH</option>
                            <option value="remote">Remote</option>
                        </select>
                    </div>
                    <div class="row g-3 mb-3 align-items-end">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-dark">Lokasi</label>
                            <input type="text" class="form-control rounded-3" placeholder="Masukkan Lokasi...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-dark">Gaji</label>
                            <input type="text" class="form-control rounded-3" placeholder="Masukkan Gaji...">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Deskripsi</label>
                        <textarea class="form-control rounded-3" placeholder="Masukkan Deskripsi..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Kualifikasi</label>
                        <textarea class="form-control rounded-3" placeholder="Masukkan Kualifikasi..."></textarea>
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
            <!-- Header -->
            <div class="modal-header" style="background-color: #4A7097;">
                <h5 class="modal-title text-white fw-semibold" id="detailModalLabel">Detail Peluang Kerja & Magang</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body p-4">
                <div class="row align-items-start p-2">
                    <!-- Posisi -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark mb-1">Posisi</label>
                        <input type="text" class="form-control rounded-3" id="detailPosisi" value="Lorem ipsum lorem ipsum lorem ipsum" readonly>
                    </div>

                    <!-- Proyek -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark mb-1">Proyek</label>
                        <input type="text" class="form-control rounded-3" id="detailProyek" value="Lorem ipsum lorem ipsum lorem ipsum" readonly>
                    </div>

                    <!-- Jenis Pekerjaan -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark mb-1">Jenis Pekerjaan</label>
                        <input type="text" class="form-control rounded-3" id="detailJenis" value="Lorem ipsum lorem ipsum lorem ipsum" readonly>
                    </div>

                    <!-- Tipe Pekerjaan -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark mb-1">Tipe Pekerjaan</label>
                        <input type="text" class="form-control rounded-3" id="detailTipe" value="Lorem ipsum lorem ipsum lorem ipsum" readonly>
                    </div>

                    <!-- Lokasi dan Gaji -->
                    <div class="row mb-3 align-items-end">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-dark mb-1">Lokasi</label>
                            <input type="text" class="form-control rounded-3" id="detailLokasi" value="Lorem ipsum lorem ipsum lorem ipsum" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-dark mb-1">Gaji</label>
                            <input type="text" class="form-control rounded-3" id="detailGaji" value="Lorem ipsum lorem ipsum lorem ipsum" readonly>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark mb-1">Deskripsi</label>
                        <textarea class="form-control rounded-3" id="detailDeskripsi" rows="2" readonly>Lorem ipsum lorem ipsum lorem ipsum</textarea>
                    </div>

                    <!-- Kualifikasi -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark mb-1">Kualifikasi</label>
                        <textarea class="form-control rounded-3" id="detailKualifikasi" rows="2" readonly>Lorem ipsum lorem ipsum lorem ipsum</textarea>
                    </div>
                </div>

                <!-- Tombol Tutup -->
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

            <!-- Header -->
            <div class="modal-header" style="background-color: #4A7097;">
                <h5 class="modal-title text-white fw-semibold" id="editModalLabel">Edit Peluang Kerja & Magang</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body p-4">
                <form id="editBannerForm">

                    <!-- Posisi -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Posisi</label>
                        <input type="text" id="editPosisi" class="form-control rounded-3" placeholder="Masukkan Posisi...">
                    </div>

                    <!-- Proyek -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Proyek</label>
                        <select id="editProyek" class="form-select rounded-3">
                            <option selected disabled>Tambah Proyek</option>
                            <option value="proyek-a">Proyek A</option>
                            <option value="proyek-b">Proyek B</option>
                            <option value="proyek-c">Proyek C</option>
                        </select>
                    </div>

                    <!-- Jenis Pekerjaan -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Jenis Pekerjaan</label>
                        <select id="editJenis" class="form-select rounded-3">
                            <option selected disabled>Tambah Jenis Pekerjaan</option>
                            <option value="fulltime">Full Time</option>
                            <option value="parttime">Part Time</option>
                            <option value="kontrak">Kontrak</option>
                            <option value="magang">Magang</option>
                        </select>
                    </div>

                    <!-- Tipe Pekerjaan -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Tipe Pekerjaan</label>
                        <select id="editTipe" class="form-select rounded-3">
                            <option selected disabled>Tambah Tipe Pekerjaan</option>
                            <option value="wfo">WFO</option>
                            <option value="wfh">WFH</option>
                            <option value="remote">Remote</option>
                        </select>
                    </div>

                    <!-- Lokasi & Gaji -->
                    <div class="row g-3 mb-3 align-items-end">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-dark">Lokasi</label>
                            <input type="text" id="editLokasi" class="form-control rounded-3" placeholder="Masukkan Lokasi...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-dark">Gaji</label>
                            <input type="text" id="editGaji" class="form-control rounded-3" placeholder="Masukkan Gaji...">
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Deskripsi</label>
                        <textarea id="editDeskripsi" class="form-control rounded-3" placeholder="Masukkan Deskripsi..."></textarea>
                    </div>

                    <!-- Kualifikasi -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Kualifikasi</label>
                        <textarea id="editKualifikasi" class="form-control rounded-3" placeholder="Masukkan Kualifikasi..."></textarea>
                    </div>

                    <!-- Tombol -->
                    <div class="d-flex justify-content-end mt-4 gap-2">
                        <button type="button" class="btn btn-outline-danger rounded-pill px-4 fw-semibold" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-outline-primary rounded-pill px-4 fw-semibold">
                            Ubah
                        </button>
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

            <h5 class="fw-bold mb-2">Hapus Peluang Kerja & Magang?</h5>
            <p class="text-muted small mb-4">Apakah kamu yakin akan menghapus peluang kerja <br>dan magang ini?<br>Aksi ini tidak dapat dibatalkan.</p>

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
