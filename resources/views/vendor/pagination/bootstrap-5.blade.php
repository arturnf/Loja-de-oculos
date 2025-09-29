@if ($paginator->hasPages())
    <nav class="d-flex justify-items-center justify-content-between">


        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
            <div>
                <p class="small text-muted">
                    {!! __('Mostrando') !!}
                    <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                    {!! __('até') !!}
                    <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                    {!! __('de') !!}
                    <span class="fw-semibold">{{ $paginator->total() }}</span>
                    {!! __('resultados') !!}
                </p>
            </div>

            <div>
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <span class="page-link" aria-hidden="true">&lsaquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                                aria-label="@lang('pagination.previous')">&lsaquo;</a>
                        </li>
                    @endif



                    {{-- Pagination Elements --}}

                    @php
                        $current = $paginator->currentPage();
                        $last = $paginator->lastPage();
                    @endphp

                    @if ($paginator->hasPages())


                        {{-- Link para a primeira página --}}
                        @if ($current > 1)
                            <li class="page-item">
                                <a class="page-link" href="{{ $paginator->url(1) }}">1</a>
                            </li>

                            {{-- "..." antes da página atual se necessário --}}
                            @if ($current > 2)
                                <li class="page-item disabled" aria-disabled="true">
                                    <span class="page-link">...</span>
                                </li>
                            @endif
                        @endif

                        {{-- Página atual --}}
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">{{ $current }}</span>
                        </li>

                        {{-- Próxima página --}}
                        @if ($current + 1 <= $last)
                            <li class="page-item">
                                <a class="page-link" href="{{ $paginator->url($current + 1) }}">{{ $current + 1 }}</a>
                            </li>

                            {{-- "..." depois da próxima se houver mais páginas --}}
                            @if ($current + 2 < $last)
                                <li class="page-item disabled" aria-disabled="true">
                                    <span class="page-link">...</span>
                                </li>
                            @endif
                        @endif

                        {{-- Última página como atalho --}}
                        @if ($current < $last)
                            <li class="page-item">
                                <a class="page-link" href="{{ $paginator->url($last) }}">{{ $last }}</a>
                            </li>
                        @endif

                </ul>
@endif




{{-- Next Page Link --}}
@if ($paginator->hasMorePages())
    <li class="page-item">
        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
            aria-label="@lang('pagination.next')">&rsaquo;</a>
    </li>
@else
    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
        <span class="page-link" aria-hidden="true">&rsaquo;</span>
    </li>
@endif
</ul>
</div>
</div>
</nav>
@endif
