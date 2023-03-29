{{-- <nav aria-label="..." class="ms-auto pe-3">
    <ul class="pagination">
    <li class="page-item disabled"><a class="page-link" href="javascript:;" tabindex="-1" aria-disabled="true">Previous</a>
    </li>
    <li class="page-item"><a class="page-link" href="javascript:;">1</a>
    </li>
    <li class="page-item active" aria-current="page"><a class="page-link" href="javascript:;">2 <span class="visually-hidden">(current)</span></a>
    </li>
    <li class="page-item"><a class="page-link" href="javascript:;">3</a>
    </li>
    <li class="page-item"><a class="page-link" href="javascript:;">Next</a>
    </li>
    </ul>
</nav> --}}

@if ($paginator->hasPages())

<div class="row">
    <div class="col-sm-12 col-md-5 ps-4">
        <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} entries
        </div>
    </div>
    <div class="col-sm-12 col-md-7">
        <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            <ul class="pagination" style="justify-content: flex-end; padding-right: 10px">

                {{-- Previous Page Link --}}

                @if ($paginator->onFirstPage())
                    <li class="paginate_button page-item previous disabled">
                        <a href="#"class="page-link">
                            Prev
                        </a>
                    </li>
                @else
                    <li class="paginate_button page-item previous">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}">
                            Prev
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}

                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                        @endif
                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="paginate_button page-item active">
                                    <a class="page-link">
                                        {{ $page }}
                                    </a>
                                </li>
                            @else
                                <li class="paginate_button page-item">
                                    <a href="{{ $url }}" class="page-link">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                 {{-- Next Page Link --}}

                @if ($paginator->hasMorePages())
                    <li class="paginate_button page-item next">
                        <a href="{{  $paginator->nextPageUrl()  }}" class="page-link">
                            Next
                        </a>
                    </li>
                @else
                    <li class="paginate_button page-item next disabled">
                        <a class="page-link">
                            Next
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>

@endif
