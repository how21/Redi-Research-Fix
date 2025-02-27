@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center mt-6">
        <ul class="flex flex-wrap justify-center items-center space-x-2 p-2 rounded-lg">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="px-4 py-2 text-gray-400 bg-gray-200 rounded-md cursor-not-allowed">
                    &laquo;
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" 
                        class="px-4 py-2 bg-gradient-to-r from-[#313989] to-[#6370E9] text-white rounded-md shadow-md
                        hover:from-[#232963] hover:to-[#2C347D] transition duration-300">
                        &laquo;
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="px-4 py-2 text-gray-500">{{ $element }}</li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="px-4 py-2 bg-[#6370E9] text-white font-bold rounded-md shadow-md">
                                {{ $page }}
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}" 
                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-[#313989] hover:text-white transition duration-300">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" 
                        class="px-4 py-2 bg-gradient-to-r from-[#313989] to-[#6370E9] text-white rounded-md shadow-md
                        hover:from-[#232963] hover:to-[#2C347D] transition duration-300">
                        &raquo;
                    </a>
                </li>
            @else
                <li class="px-4 py-2 text-gray-400 bg-gray-200 rounded-md cursor-not-allowed">
                    &raquo;
                </li>
            @endif
        </ul>
    </nav>
@endif
