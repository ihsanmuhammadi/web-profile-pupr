@extends('layouts.main')

@section('title', 'Pedoman Spesifikasi Daerah')

@section('content')

<section class="pedoman-header position-relative text-center text-white mt-5">
    <img src="{{ asset('assets/images/header_pedoman.png') }}" class="w-100 header-bg" alt="Header Pedoman Daerah">
    <div class="header-overlay"></div>
    <div class="header-text-pedoman position-absolute top-50 start-50 translate-middle text-uppercase" data-aos="zoom-in">
    <h1 class="fw-bold mb-1">Pedoman <br>Spesifikasi <br>Daerah</h1>
    </div>
</section>

<section class="pedoman-content py-5">
    <div class="container col-lg-9 mx-auto">
        {{-- Navigation --}}
        <div class="d-flex gap-3 mb-4 navigasi" data-aos="fade-right">
            <a href="{{ route('pedoman.teknis') }}" class="btn btn-outline-secondary">Pedoman Spesifikasi Teknis</a>
            <a href="{{ route('pedoman.daerah') }}" class="btn active-btn">Pedoman Spesifikasi Daerah</a>
        </div>

        <h2 class="fw-bold mt-5 mb-5 text-center" data-aos="zoom-in">
            Pedoman Spesifikasi Daerah Dinas PUPR Kubu Raya
        </h2>

        {{-- YouTube Video --}}
        @if ($videoData && isset($videoData['videoId']))
            <div class="ratio ratio-16x9 mb-3" data-aos="zoom-in-up">
                <iframe
                    src="https://www.youtube.com/embed/{{ $videoData['videoId'] }}"
                    title="{{ $videoData['title'] ?? 'YouTube Video' }}"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>

            {{-- Video Info --}}
            <div class="video-info mt-4">
                <h4 class="fw-semibold mb-2">
                    {{ $videoData['title'] ?? 'Video YouTube' }}
                </h4>

                @if(!isset($videoData['api_failed']))
                    <p class="text-muted mb-2 small">
                        YouTube |
                        {{ $videoData['channel'] ?? '-' }} |
                        {{ number_format($videoData['views'] ?? 0) }} kali dilihat |
                        @if(isset($videoData['published_at']))
                            {{ \Carbon\Carbon::parse($videoData['published_at'])->translatedFormat('d F Y') }}
                        @endif
                    </p>
                @endif

                <div class="d-flex align-items-center gap-2 mt-3">
                    <h6 class="mb-0">Link YouTube:</h6>
                    <a id="youtubeLink" href="{{ $videoData['original_url'] }}" target="_blank" class="text-break">
                        {{ $videoData['original_url'] }}
                    </a>
                    <i class="bi bi-clipboard ms-1" id="copyBtn" style="cursor: pointer;" title="Salin link"></i>
                </div>

                @if(isset($videoData['api_failed']))
                    <div class="alert alert-warning mt-3">
                        <i class="bi bi-exclamation-triangle"></i>
                        Tidak dapat memuat informasi lengkap dari YouTube API. Video tetap dapat diputar.
                    </div>
                @endif
            </div>
        @else
            {{-- No Video Available --}}
            <div class="alert alert-warning text-center py-5">
                <i class="bi bi-exclamation-triangle fs-1 d-block mb-3"></i>
                <h5>Video belum tersedia</h5>
                <p class="mb-0 text-muted">Silakan hubungi administrator untuk menambahkan video pedoman.</p>
            </div>
        @endif
    </div>
</section>

@endsection

<!-- Toast notification -->
<div class="toast-container position-fixed top-50 start-50 translate-middle p-3">
    <div id="copyToast" class="toast align-items-center text-bg-success border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                ✅ Link berhasil disalin ke clipboard!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const copyBtn = document.getElementById('copyBtn');
    const youtubeLink = document.getElementById('youtubeLink');
    const copyToastEl = document.getElementById('copyToast');
    const copyToast = new bootstrap.Toast(copyToastEl);

    copyBtn.addEventListener('click', function() {
        const link = youtubeLink.href;
        navigator.clipboard.writeText(link).then(() => {
            // Ganti icon sementara
            copyBtn.classList.remove('bi-clipboard');
            copyBtn.classList.add('bi-clipboard-check');
            copyBtn.title = "Link berhasil disalin!";

            // Tampilkan toast
            copyToast.show();

            // Balikkan icon setelah 2 detik
            setTimeout(() => {
                copyBtn.classList.remove('bi-clipboard-check');
                copyBtn.classList.add('bi-clipboard');
                copyBtn.title = "Salin link";
            }, 2000);
        });
    });
});
</script>

{{-- @push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Copy to clipboard functionality
    const copyBtn = document.getElementById('copyBtn');
    const youtubeLink = document.getElementById('youtubeLink');

    if (copyBtn && youtubeLink) {
        copyBtn.addEventListener('click', function(e) {
            e.preventDefault();

            const linkText = youtubeLink.href;

            // Modern way (for most browsers)
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(linkText).then(function() {
                    // Success feedback
                    const originalIcon = copyBtn.innerHTML;
                    copyBtn.innerHTML = '<i class="bi bi-check-lg text-success"></i>';
                    copyBtn.classList.add('btn-success');
                    copyBtn.classList.remove('btn-outline-secondary');

                    setTimeout(function() {
                        copyBtn.innerHTML = originalIcon;
                        copyBtn.classList.remove('btn-success');
                        copyBtn.classList.add('btn-outline-secondary');
                    }, 2000);
                }).catch(function(err) {
                    console.error('Failed to copy:', err);
                    alert('Gagal menyalin link');
                });
            }
            // Fallback for older browsers
            else {
                const textArea = document.createElement('textarea');
                textArea.value = linkText;
                textArea.style.position = 'fixed';
                textArea.style.left = '-9999px';
                document.body.appendChild(textArea);
                textArea.select();

                try {
                    document.execCommand('copy');
                    alert('Link berhasil disalin!');
                } catch (err) {
                    console.error('Failed to copy:', err);
                    alert('Gagal menyalin link');
                }

                document.body.removeChild(textArea);
            }
        });
    }
});
</script>
@endpush --}}
