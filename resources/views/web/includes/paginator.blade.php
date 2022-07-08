@if ($paginator->hasPages())
    <!-- pagination -->
    <div class="col-md-12">
        <div class="post-pagination">
            @if ($paginator->onFirstPage())
                <a href="{{ $paginator->previousPageUrl() }}" class="btn disabled pagination-back pull-left">Back</a>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="pagination-back pull-left">Back</a>
            @endif
            <ul class="pages">

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span
                                class="page-link">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                            <li class="active">{{$page}}</li>
                            @else
                            <li><a href="{{$url}}">{{$page}}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </ul>
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="pagination-next pull-right">Next</a>
            @else
                <a href="{{ $paginator->nextPageUrl() }}" class="btn disabled pagination-next pull-right">Next</a>
            @endif
        </div>
    </div>
    <!-- pagination -->
@endif
