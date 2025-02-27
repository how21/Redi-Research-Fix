<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $category->name ?? 'Kategori Tidak Ditemukan' }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse($albums as $album)
                <div class="relative group bg-white rounded-lg shadow-lg overflow-hidden">
                    <!-- Gambar Album -->
                    <img src="{{ $album->image ? asset('storage/' . $album->image) : 'https://via.placeholder.com/400x300' }}" 
                        alt="Album Image" class="w-full h-64 object-cover transition duration-300 group-hover:opacity-75">

                    <!-- Overlay dengan Title -->
                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-80 opacity-0 transition duration-300 group-hover:opacity-100">
                        <h3 class="text-white px-6 text-base font-semibold">{{ $album->title }}</h3>
                    </div>

                    <!-- Tombol Delete -->
                    <form action="{{ route('album.destroy', $album->id) }}" method="POST" class="absolute top-2 right-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                            onclick="return confirm('Yakin ingin menghapus album ini?')"
                            class="bg-red-500 text-white px-3 py-1 rounded-full text-sm hover:bg-red-700">
                            Hapus
                        </button>
                    </form>
                </div>
            @empty
                <p class="text-gray-500">Belum ada album dalam kategori ini.</p>
            @endforelse
        </div>
    </div>
    <!-- Tambahin Pagination -->
    <div class="mt-6 pb-6">
        {{ $albums->links('vendor.pagination.default') }}
    </div>    
    <!-- Back to List (Floating Button) -->
    <div class="fixed bottom-6 left-6 md:bottom-8 md:left-8">
        <a href="{{ route('album.index') }}" class="px-5 py-3 bg-gradient-to-r from-[#313989] to-[#6370E9] text-white rounded-full shadow-lg hover:from-[#232963] hover:to-[#2C347D] transition duration-300 flex items-center gap-2">
            Back to List
        </a>
    </div>
</x-app-layout>
