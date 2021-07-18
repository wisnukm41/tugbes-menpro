@if ($paginator->hasPages())
        <ul class="page-numbers">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li><a class="page-number-item " aria-disabled="true" style="pointer-events: none">&lsaquo;</a></li>
            @else
               <li><a href="{{ $paginator->previousPageUrl() }}" class="page-number-item " >&lsaquo;</a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                {{-- @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif --}}

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><span class="page-number-item current" >{{ $page }}</span></li>
                        @else
                            <li><a class="page-number-item" href="{{ $url }}" >{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
             <li><a href="{{ $paginator->nextPageUrl() }}" class="page-number-item" >&rsaquo;</a></li>
            @else
                <li><a class="page-number-item" aria-disabled="true" style="pointer-events: none">&rsaquo;</a></li>
            @endif
        </ul>
@endif
