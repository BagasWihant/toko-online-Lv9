@if ($paginator->hasPages())
    <ul class="pagination pagination-info">
        <!-- prev -->
        @if ($paginator->onFirstPage())
            <li class="page-item">
                <a class="page-link">
                    <span >
                        <i class="ni ni-bold-left" ></i>
                    </span>
                </a>
            </li>
        @else
            <li class="page-item" >
                <button wire:click="previousPage" class="page-link">
                    <span ><i class="ni ni-bold-left" ></i></span>
                </button>
            </li>
        @endif
        <!-- prev end -->

        <!-- numbers -->
        @foreach ($elements as $element)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" wire:click="gotoPage({{ $page }})">
                            <a class="page-link" >{{ $page }}</a>
                        </li>
                    @else
                        <li class="page-item" wire:click="gotoPage({{ $page }})">
                            <a class="page-link" >{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach
        <!-- end numbers -->


        <!-- next  -->
        @if ($paginator->hasMorePages())
        <li class="page-item">
            <button wire:click="nextPage" class="page-link">
                <span ><i class="ni ni-bold-right" ></i></span>
            </button>

                {{-- <a class="page-link">
                </a> --}}
            </li>
        @else
            <li class="page-item">
                <a class="page-link">
                    <span ><i class="ni ni-bold-right" ></i></span>
                </a>
            </li>
        @endif
        <!-- next end -->
    </ul>
@endif
