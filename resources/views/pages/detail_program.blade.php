@extends('layouts.main')

@section('title', 'Detail Program Kerja')

@section('content')
<section class="py-5 mt-5">
    <div class="container-detail-program col-lg-9 mx-auto">

        {{-- navigasi breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb small mb-0 breadcrumb-custom" style="background: none; padding: 0;">
                <li class="breadcrumb-item">
                <a id="breadcrumbPrev" href="{{ route('dataprogram.category', ['categoryName' => $categoryName]) }}" class="text-decoration-none text-muted">
                    {{$dataProgram->kategori->name}}
                </a>
                </li>
                <span class="breadcrumb-separator material-symbols-outlined mx-1">
                arrow_forward_ios
                </span>
                <li class="breadcrumb-item active fw-bold text-dark" aria-current="page">Detail</li>
            </ol>
        </nav>

        <div class="title-program text-center mb-5">
            <span class="badge program-category-badge rounded-1 px-3 py-2 fw-normal text-white mb-4" style="font-size: 1rem">
                {{$dataProgram->kategori->name}}
            </span>
            <h1 class="fw-bold display-5 mb-0">{{$dataProgram->judul}}</h1>
        </div>

        <div class="col-lg-8 mx-auto mt-4">
            <div class="ratio ratio-16x9">
                <iframe
                    src={{ $embedUrl }}
                    title="Video Program Kerja"
                    allowfullscreen
                    class="shadow-sm">
                </iframe>
            </div>
        </div>


        <div class="row" style="margin-top: 100px">
            {{-- Kiri --}}
            <div class="col-lg-8">

                <div class="d-flex flex-wrap align-items-center gap-5 mb-4 info-bar fs-5">

                    <div class="d-flex align-items-center text-dark fw-medium small">
                        <span class="material-symbols-outlined me-2">schedule</span> {{ \Carbon\Carbon::parse($dataProgram->waktu_mulai)->format('d M Y') }}
                    </div>

                    <div class="d-flex align-items-center text-dark fw-medium small">
                        <span class="material-symbols-outlined me-2">calendar_month</span> {{$dataProgram->tahun_anggaran}}
                    </div>

                    <div>
                        @if ($dataProgram->status_proyek == 'Ditunda')
                            <span class="badge d-flex align-items-center bg-warning text-light rounded-1 px-2 py-1 fw-medium">
                                <span class="material-symbols-outlined me-2">pause_circle</span>
                                Ditunda
                            </span>

                        @elseif ($dataProgram->status_proyek == 'Sedang Berjalan')
                            <span class="badge d-flex align-items-center bg-primary text-light rounded-1 px-2 py-1 fw-medium">
                                <span class="material-symbols-outlined me-2">manufacturing</span>
                                Sedang Berjalan
                            </span>

                        @elseif ($dataProgram->status_proyek == 'Dihentikan')
                            <span class="badge d-flex align-items-center bg-danger text-light rounded-1 px-2 py-1 fw-medium">
                                <span class="material-symbols-outlined me-2">cancel</span>
                                Dihentikan
                            </span>

                        @elseif ($dataProgram->status_proyek == 'Tuntas')
                            <span class="badge d-flex align-items-center bg-success text-light rounded-1 px-2 py-1 fw-medium">
                                <span class="material-symbols-outlined me-2">check_circle</span>
                                Tuntas
                            </span>

                        @else
                            <span class="badge d-flex align-items-center bg-secondary text-light rounded-1 px-2 py-1 fw-medium">
                                <span class="material-symbols-outlined me-2">help</span>
                                Tidak Diketahui
                            </span>
                        @endif
                    </div>
                </div>

                <div class="d-flex align-items-center text-dark fw-medium small mb-5 fs-5">
                    <span class="material-symbols-outlined me-2">location_on</span> {{$dataProgram->lokasi}}
                </div>

                <div class="mb-4">
                    <h2 class="h3 fw-bold mb-2">{{$dataProgram->sub_judul}}</h2>
                </div>

                <div class="mb-5">
                    <p class="text-dark fs-5">
                        {{$dataProgram->deskripsi}}
                    </p>
                </div>

                <div class="mb-4">
                    <h2 class="h3 fw-bold mb-4">Tim yang Terlibat</h2>
                    <div class="text-dark fs-5" style="line-height: 1;">
                        <p>{{$dataProgram->tenaga_kerja_1}} - {{$dataProgram->posisi_1}}</p>
                        <p>{{$dataProgram->tenaga_kerja_2}} - {{$dataProgram->posisi_2}}</p>
                        <p>{{$dataProgram->tenaga_kerja_3}} - {{$dataProgram->posisi_3}}</p>
                        <p>{{$dataProgram->tenaga_kerja_4}} - {{$dataProgram->posisi_4}}</p>
                        <p>{{$dataProgram->tenaga_kerja_5}} - {{$dataProgram->posisi_5}}</p>
                    </div>
                </div>

            </div>

            <div class="col-lg-4 d-flex justify-content-lg-end">
                <div class="mb-4 text-end action-box">
                    <a href="{{ route('kerja.magang') }}" class="btn btn-outline-success rounded-pill px-4 py-2 fw-medium text-nowrap">
                        Lihat Peluang Pekerjaan dan Magang
                    </a>
                    <p class="text-muted small mt-2 text-lg-start ms-2 fs-6">
                        Tersedia: {{ $totalWorkByKategori }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
