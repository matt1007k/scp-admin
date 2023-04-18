@if ($paginator->hasPages())

<nav role="navigation" aria-label="Pagination Navigation" class="flex  items-center justify-between">

    <div class="flex items-center justify-between flex-1 sm:hidden">
        @if ($paginator->onFirstPage())
        <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-500 bg-white border border-gray-300 rounded-md cursor-default">
            @lang('pagination.previous')

        </span>
        @else
        <button type="button" wire:click="previousPage" class="relative inline-flex  items-center px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md hover:border-theme-1 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700">
            @lang('pagination.previous')
        </button>
        @endif

        @if ($paginator->hasMorePages())
        <button type="button" wire:click="nextPage" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md hover:border-theme-1  focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700">
            @lang('pagination.next')
        </button>
        @else
        <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium leading-5 text-gray-500 bg-white border border-gray-300 rounded-md cursor-default">
            @lang('pagination.next')
        </span>
        @endif
    </div>

    <div class="hidden  justify-between flex-1  sm:flex-1 sm:flex sm:items-center sm:justify-between">

        <div>
            <p class="text-sm leading-5 text-gray-700 dark:text-slate-500">
                Mostrando
                <span class="font-medium dark:text-gray-100">{{ $paginator->firstItem() }}</span>
                al
                <span class="font-medium dark:text-gray-100">{{ $paginator->lastItem() }}</span>
                de
                <span class="font-medium dark:text-gray-100">{{ $paginator->total() }}</span>
                resultados.
            </p>
        </div>

        <div class="intro-y col-span-12 flex  flex-wrap sm:flex-row sm:flex-no-wrap items-center  ml-auto  ">
            <ul class="pagination">
                @if (!$paginator->onFirstPage())
                {{-- First Page Link --}}
                <li class="page-item">
                    <span class="page-link" wire:click="gotoPage(1)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left w-4 h-4">
                            <polyline points="11 17 6 12 11 7"></polyline>
                            <polyline points="18 17 13 12 18 7"></polyline>
                        </svg>
                    </span>
                </li>
                @if ($paginator->currentPage() > 2)
                {{-- Previous Page Link --}}

                <li class="page-item">
                    <span class="page-link" wire:click="previousPage">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left w-4 h-4">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </span>
                </li>
                @endif
                @endif

                <!-- Pagination Elements -->
                @foreach ($elements as $element)
                <!-- Array Of Links -->
                @if (is_array($element))
                @foreach ($element as $page => $url)
                <!--  Use three dots when current page is greater than 3.  -->
                @if ($paginator->currentPage() > 3 && $page === 2)
                <li class="page-item">
                    <a class="page-link">...</a>
                </li>
                @endif

                <!--  Show active page two pages before and after it.  -->
                @if ($page == $paginator->currentPage())
                <li class="page-item active">
                    <a class="page-link">{{ $page }}</a>
                </li>
                @elseif ($page === $paginator->currentPage() + 1 || $page === $paginator->currentPage() + 2 || $page === $paginator->currentPage() - 1 || $page === $paginator->currentPage() - 2)
                <li class="page-item">
                    <span class="page-link " wire:click="gotoPage({{ $page }})">{{ $page }}</span>
                </li>
                @endif

                <!--  Use three dots when current page is away from end.  -->
                @if ($paginator->currentPage() < $paginator->lastPage() - 2 && $page === $paginator->lastPage() - 1)
                    <li class="page-item">
                        <a class="page-link">...</a>
                    </li>
                    @endif
                    @endforeach
                    @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                    @if ($paginator->lastPage() - $paginator->currentPage() >= 2)
                    <li class="page-item">
                        <a class="page-link" wire:click="nextPage" rel="next">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right w-4 h-4">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </a>
                    </li>
                    @endif

                    <li class="page-item">
                        <a class="page-link" wire:click="gotoPage({{ $paginator->lastPage() }})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-right w-4 h-4">
                                <polyline points="13 17 18 12 13 7"></polyline>
                                <polyline points="6 17 11 12 6 7"></polyline>
                            </svg> </a>
                    </li>

                    @endif
            </ul>



        </div>
    </div>



</nav>
@endif
