@props(['paginator', 'queryString' => null])

@if ($paginator->lastPage > 1)
    <nav aria-label="Pagination">
        <ul class="pagination m-0 ms-auto">
            @if ($paginator->currentPage > 1)
                <li class="page-item">
                    <a class="page-link"
                        href="?page={{ $paginator->currentPage - 1 }}{{ $queryString ? '&' . $queryString : '' }}"
                        aria-label="Previous page">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" aria-hidden="true" focusable="false" class="icon">
                            <path d="M15 6l-6 6l6 6"></path>
                        </svg>
                    </a>
                </li>
            @endif
            @for ($i = 1; $i <= $paginator->lastPage; $i++)
                <li class="page-item {{ $i == $paginator->currentPage ? 'active' : '' }}">
                    <a class="page-link" href="?page={{ $i }}{{ $queryString ? '&' . $queryString : '' }}">
                        {{ $i }}
                    </a>
                </li>
            @endfor
            @if ($paginator->currentPage < $paginator->lastPage)
                <li class="page-item">
                    <a class="page-link"
                        href="?page={{ $paginator->currentPage + 1 }}{{ $queryString ? '&' . $queryString : '' }}"
                        aria-label="Next page">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" aria-hidden="true" focusable="false" class="icon">
                            <path d="M9 6l6 6l-6 6"></path>
                        </svg>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
@endif
