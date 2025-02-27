@if ($paginator->hasPages())
    <div class="text-center mb-4">
        <p class="text-gray-700">Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results</p>
    </div>
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center mt-6">
        <ul class="flex flex-wrap justify-center items-center space-x-2 p-2 rounded-lg">
            {{-- First Page Link --}}
            <li>
                <a href="{{ $paginator->url(1) }}" 
                    class="px-4 py-2 bg-gradient-to-r from-[#313989] to-[#6370E9] text-white rounded-md shadow-md
                    hover:from-[#232963] hover:to-[#2C347D] transition duration-300">
                    &laquo;&laquo;
                </a>
            </li>
            
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="px-4 py-2 text-gray-400 bg-gray-200 rounded-md cursor-not-allowed">
                    Prev
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" 
                        class="px-4 py-2 bg-gradient-to-r from-[#313989] to-[#6370E9] text-white rounded-md shadow-md
                        hover:from-[#232963] hover:to-[#2C347D] transition duration-300">
                        Prev
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @php
                $start = max($paginator->currentPage() - 1, 1);
                $end = min($paginator->currentPage() + 1, $paginator->lastPage());
            @endphp

            @if ($start > 1)
                <li>
                    <a href="{{ $paginator->url(1) }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-[#313989] hover:text-white transition duration-300">1</a>
                </li>
                @if ($start > 2)
                    <li class="px-4 py-2 text-gray-500">...</li>
                @endif
            @endif

            @for ($page = $start; $page <= $end; $page++)
                @if ($page == $paginator->currentPage())
                    <li class="px-4 py-2 bg-[#6370E9] text-white font-bold rounded-md shadow-md">{{ $page }}</li>
                @else
                    <li>
                        <a href="{{ $paginator->url($page) }}" 
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-[#313989] hover:text-white transition duration-300">
                            {{ $page }}
                        </a>
                    </li>
                @endif
            @endfor

            @if ($end < $paginator->lastPage())
                @if ($end < $paginator->lastPage() - 1)
                    <li class="px-4 py-2 text-gray-500">...</li>
                @endif
                <li>
                    <a href="{{ $paginator->url($paginator->lastPage()) }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-[#313989] hover:text-white transition duration-300">{{ $paginator->lastPage() }}</a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" 
                        class="px-4 py-2 bg-gradient-to-r from-[#313989] to-[#6370E9] text-white rounded-md shadow-md
                        hover:from-[#232963] hover:to-[#2C347D] transition duration-300">
                        Next
                    </a>
                </li>
            @else
                <li class="px-4 py-2 text-gray-400 bg-gray-200 rounded-md cursor-not-allowed">
                    Next
                </li>
            @endif
            
            {{-- Last Page Link --}}
            <li>
                <a href="{{ $paginator->url($paginator->lastPage()) }}" 
                    class="px-4 py-2 bg-gradient-to-r from-[#313989] to-[#6370E9] text-white rounded-md shadow-md
                    hover:from-[#232963] hover:to-[#2C347D] transition duration-300">
                    &raquo;&raquo;
                </a>
            </li>
        </ul>
    </nav>
@endif