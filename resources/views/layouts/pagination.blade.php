@if ($paginator->hasPages())
    <ul class="pagination pagination-info">
        <!-- prev -->
        @if ($paginator->onFirstPage())
            <li class="page-item">
                <a class="page-link" aria-label="Previous">
                    <span aria-hidden="true"><i class="ni ni-bold-left" aria-hidden="true"></i></span>
                </a>
            </li>
        @else
            <li class="page-item" wire:click="previousPage">
                <a class="page-link" aria-label="Previous">
                    <span aria-hidden="true"><i class="ni ni-bold-left" aria-hidden="true"></i></span>
                </a>
            </li>
        @endif
        <!-- prev end -->

        <!-- numbers -->
        @foreach ($elements as $element)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" wire:click="gotoPage({{ $page }})">
                            <a class="page-link" href="#link">{{ $page }}</a>
                        </li>
                    @else
                        <li class="page-item" wire:click="gotoPage({{ $page }})">
                            <a class="page-link" href="#link">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach
        <!-- end numbers -->


        <!-- next  -->
        @if ($paginator->hasMorePages())
            <li class="page-item" wire:click="nextPage">
                <a class="page-link" aria-label="Next">
                    <span aria-hidden="true"><i class="ni ni-bold-right" aria-hidden="true"></i></span>
                </a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" aria-label="Next">
                    <span aria-hidden="true"><i class="ni ni-bold-right" aria-hidden="true"></i></span>
                </a>
            </li>
        @endif
        <!-- next end -->
    </ul>
@endif
