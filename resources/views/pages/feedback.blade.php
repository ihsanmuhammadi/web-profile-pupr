@extends('layouts.main')

@section('title', 'Formulir Feedback')

@section('content')

<section class="feedback-page d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-9 col-sm-11">
                <div class="card feedback-card border-0 shadow-lg text-center rounded-4">
                    <h2 class="fw-bold mb-3">Bagikan Pendapat Anda</h2>
                    <p class="text-muted mb-4 fs-5">
                        Ceritakan pengalaman Anda saat menggunakan website ini. <br>
                        Masukan Anda sangat berarti bagi perbaikan kami ke depan.
                    </p>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-outline-success rounded-pill px-4 py-2 fw-medium">
                            Isi Kuesioner
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
