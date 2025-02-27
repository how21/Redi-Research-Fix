@if ($paginator->hasPages())
    <nav class="flex justify-between items-center mt-4 text-sm">
        {{-- Informasi jumlah data yang ditampilkan (di kiri) --}}
        <div class="text-gray-700">
            Showing 
            <span class="font-bold">{{ $paginator->firstItem() }}</span> 
            to 
            <span class="font-bold">{{ $paginator->lastItem() }}</span> 
            of 
            <span class="font-bold">{{ $paginator->total() }}</span> 
            results
        </div>

        {{-- Navigasi Pagination (di kanan) --}}
        <ul class="flex space-x-1">
            {{-- Tombol First Page --}}
            <li>
                <a href="{{ $paginator->url(1) }}" 
                    class="px-2 py-1 rounded transition duration-200 ease-in-out 
                        {{ $paginator->onFirstPage() ? 'bg-gray-300 text-gray-500 cursor-not-allowed' : 'bg-blue-600 text-white hover:bg-blue-800' }}">
                    «
                </a>
            </li>

            {{-- Tombol Sebelumnya --}}
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" 
                    class="px-2 py-1 rounded transition duration-200 ease-in-out 
                        {{ $paginator->onFirstPage() ? 'bg-gray-300 text-gray-500 cursor-not-allowed' : 'bg-blue-600 text-white hover:bg-blue-800' }}">
                    Prev
                </a>
            </li>

            {{-- Nomor Halaman (hanya 5 halaman yang muncul) --}}
            @php
                $start = max($paginator->currentPage() - 2, 1);
                $end = min($start + 4, $paginator->lastPage());
                if ($end - $start < 4) {
                    $start = max($end - 4, 1);
                }
            @endphp

            @for ($page = $start; $page <= $end; $page++)
                <li>
                    <a href="{{ $paginator->url($page) }}" 
                        class="px-3 py-1 rounded transition duration-200 ease-in-out 
                            {{ $page == $paginator->currentPage() ? 'bg-blue-700 text-white font-bold' : 'bg-blue-600 text-white hover:bg-blue-800' }}">
                        {{ $page }}
                    </a>
                </li>
            @endfor

            {{-- Tombol Selanjutnya --}}
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" 
                    class="px-2 py-1 rounded transition duration-200 ease-in-out 
                        {{ $paginator->hasMorePages() ? 'bg-blue-600 text-white hover:bg-blue-800' : 'bg-gray-300 text-gray-500 cursor-not-allowed' }}">
                    Next
                </a>
            </li>

            {{-- Tombol Last Page --}}
            <li>
                <a href="{{ $paginator->url($paginator->lastPage()) }}" 
                    class="px-2 py-1 rounded transition duration-200 ease-in-out 
                        {{ $paginator->currentPage() == $paginator->lastPage() ? 'bg-gray-300 text-gray-500 cursor-not-allowed' : 'bg-blue-600 text-white hover:bg-blue-800' }}">
                    »
                </a>
            </li>
        </ul>
    </nav>
@endif
