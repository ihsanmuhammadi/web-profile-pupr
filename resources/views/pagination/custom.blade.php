@if ($paginator->hasPages())
<nav>
    <ul class="pagination pagination-sm mb-0">
        {{-- Previous --}}
        <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link border-0"
               href="{{ $paginator->onFirstPage() ? '#' : $paginator->previousPageUrl() }}"
               {{ $paginator->onFirstPage() ? 'tabindex="-1"' : '' }}>
                <i class="bi bi-chevron-left"></i>
            </a>
        </li>

        {{-- Previous Page --}}
        @if ($paginator->currentPage() > 1)
            <li class="page-item">
                <a class="page-link border-0 text-secondary"
                   href="{{ $paginator->url($paginator->currentPage() - 1) }}">
                    {{ $paginator->currentPage() - 1 }}
                </a>
            </li>
        @endif

        {{-- Current Page --}}
        <li class="page-item active">
            <a class="page-link border-0 bg-transparent text-dark fw-semibold" href="#">
                {{ $paginator->currentPage() }}
            </a>
        </li>

        {{-- Next Page --}}
        @if ($paginator->currentPage() < $paginator->lastPage())
            <li class="page-item">
                <a class="page-link border-0 text-secondary"
                   href="{{ $paginator->url($paginator->currentPage() + 1) }}">
                    {{ $paginator->currentPage() + 1 }}
                </a>
            </li>
        @endif

        {{-- Next Page + 1 --}}
        @if ($paginator->currentPage() + 1 < $paginator->lastPage())
            <li class="page-item">
                <a class="page-link border-0 text-secondary"
                   href="{{ $paginator->url($paginator->currentPage() + 2) }}">
                    {{ $paginator->currentPage() + 2 }}
                </a>
            </li>
        @endif

        {{-- Next --}}
        <li class="page-item {{ !$paginator->hasMorePages() ? 'disabled' : '' }}">
            <a class="page-link border-0"
               href="{{ $paginator->hasMorePages() ? $paginator->nextPageUrl() : '#' }}"
               {{ !$paginator->hasMorePages() ? 'tabindex="-1"' : '' }}>
                <i class="bi bi-chevron-right"></i>
            </a>
        </li>
    </ul>
</nav>
@endif
