@if ($paginator->hasPages())
    <div class="relative">
        <nav class="mt-5 bottom-0 right-0 mb-2 mr-2 flex items-center space-x-1 text-xs">

            {{-- Tombol ke awal << --}}
            <a href="{{ $paginator->url(1) }}" 
                class="px-2 py-1 border rounded 
                    {{ $paginator->onFirstPage() ? 'text-gray-400 bg-gray-100 cursor-default' : 'text-gray-700 bg-white hover:bg-gray-200' }}">
                &laquo;
            </a>

            {{-- Tombol mundur < --}}
            <a href="{{ $paginator->previousPageUrl() }}" 
                class="px-2 py-1 border rounded 
                    {{ $paginator->onFirstPage() ? 'text-gray-400 bg-gray-100 cursor-default' : 'text-gray-700 bg-white hover:bg-gray-200' }}">
                Prev
            </a>

            {{-- Pagination Numbers (Max 3 Halaman Ditampilkan) --}}
            @php
                $start = max(1, $paginator->currentPage() - 1);
                $end = min($paginator->lastPage(), $start + 2);
            @endphp

            @if ($start > 1)
                <span class="px-1 text-gray-500">...</span>
            @endif

            @for ($page = $start; $page <= $end; $page++)
                <a href="{{ $paginator->url($page) }}" 
                    class="px-2 py-1 border rounded 
                        {{ $page == $paginator->currentPage() ? 'bg-blue-500 text-white' : 'text-gray-700 bg-white hover:bg-gray-200' }}">
                    {{ $page }}
                </a>
            @endfor

            @if ($end < $paginator->lastPage())
                <span class="px-1 text-gray-500">...</span>
            @endif

            {{-- Tombol maju > --}}
            <a href="{{ $paginator->nextPageUrl() }}" 
                class="px-2 py-1 border rounded 
                    {{ $paginator->hasMorePages() ? 'text-gray-700 bg-white hover:bg-gray-200' : 'text-gray-400 bg-gray-100 cursor-default' }}">
                Next
            </a>

            {{-- Tombol ke akhir >> --}}
            <a href="{{ $paginator->url($paginator->lastPage()) }}" 
                class="px-2 py-1 border rounded 
                    {{ $paginator->currentPage() == $paginator->lastPage() ? 'text-gray-400 bg-gray-100 cursor-default' : 'text-gray-700 bg-white hover:bg-gray-200' }}">
                &raquo;
            </a>

        </nav>
    </div>
@endif
