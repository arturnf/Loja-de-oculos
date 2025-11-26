

@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Paginação de Resultados" class="pagination-container">
        {{-- Link Anterior --}}
        @if ($paginator->onFirstPage())
            <span class="pagination-link disabled" aria-disabled="true">
                &laquo; Anterior
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-link" rel="prev">
                &laquo; Anterior
            </a>
        @endif

        <h4>Página {{ $paginator->currentPage() }}</h4>

        {{-- Link Próximo --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-link" rel="next">
                Próximo &raquo;
            </a>
        @else
            <span class="pagination-link disabled" aria-disabled="true">
                Próximo &raquo;
            </span>
        @endif
    </nav>
@endif