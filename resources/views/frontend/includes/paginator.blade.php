<ul class="pagination">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <li class="disabled">
            <a href="#">
                <i class="las la-angle-right"></i>
            </a>
        </li>
    @else
        <li>
            <a href="{{ $paginator->previousPageUrl() }}">
                <i class="las la-angle-right"></i>
            </a>
        </li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
        <li>
            <a href="{{ $url }}" class="{{ $page == $paginator->currentPage() ? 'active' : '' }}">
                {{ $page }}
            </a>
        </li>
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <li>
            <a href="{{ $paginator->nextPageUrl() }}">
                <i class="las la-angle-left"></i>
            </a>
        </li>
    @else
        <li class="disabled">
            <a href="#">
                <i class="las la-angle-left"></i>
            </a>
        </li>
    @endif
</ul>
