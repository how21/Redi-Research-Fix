<x-app-layout>
    <x-slot name="header">
        <div x-data="{ publikasiModal: false }" x-init="if({{ $errors->any() ? 'true' : 'false' }}) publikasiModal = true" class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Publikasi Journal') }}
            </h2>
            <button @click="publikasiModal = true" class="px-4 py-2 bg-blue-600 text-white rounded-lg transi duration-300 hover:scale-105">
                Create New
            </button>
            <!-- BACKDROP / OVERLAY -->
            <div x-show="publikasiModal" 
                x-cloak
                @keydown.escape.window="publikasiModal = false"
                class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 backdrop-blur-sm z-50 transition-opacity duration-300"
                @click.self="publikasiModal = false">
                
                <!-- MODAL BOX -->
                <div x-show="publikasiModal"
                    x-transition:enter="transition-all transform duration-500"
                    x-transition:enter-start="opacity-0 scale-90"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition-all transform duration-250"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-90"
                    class="bg-white w-full max-w-4xl p-6 rounded-lg shadow-lg relative z-50">
                    
                    <!-- Tombol Close -->
                    <button @click="publikasiModal = false" class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 transition">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>      

                    <h3 class="text-lg font-semibold mb-4">Create New Journal</h3>
                    <form action="{{ route('journal.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700">Title</label>
                                <input type="text" name="title" class="w-full border p-2 rounded-lg" required>
                                @error('title')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>                            
                            <div>
                                <label class="block text-gray-700">Authors</label>
                                <input type="text" name="authors" class="w-full border p-2 rounded-lg" required>
                            </div>
                            <div>
                                <label class="block text-gray-700">Publication Year</label>
                                <input type="number" name="publication_year" class="w-full border p-2 rounded-lg" required>
                            </div>
                            <div>
                                <label class="block text-gray-700">Publisher</label>
                                <input type="text" name="publisher" class="w-full border p-2 rounded-lg">
                            </div>
                            <div class="col-span-2">
                                <label class="block text-gray-700">Abstract</label>
                                <textarea name="abstract" class="w-full border p-2 rounded-lg" rows="5" required></textarea>
                            </div>
                            <div>
                                <label class="block text-gray-700">File (PDF)</label>
                                <input type="file" name="file" accept=".pdf" class="w-full border p-2 rounded-lg">
                            </div>
                            <div>
                                <label class="block text-gray-700">DOI</label>
                                <input type="text" name="doi" class="w-full border p-2 rounded-lg">
                            </div>
                            <div x-data="{ tags: [] }" class="col-span-2">
                                <label class="block text-gray-700">Tags</label>
                                <div class="flex items-center border p-2 rounded-lg w-full">
                                    <input type="text" x-ref="tagInput" class="flex-1 border-none outline-none" placeholder="Enter a tag and press Enter"
                                        @keydown.enter.prevent="if($refs.tagInput.value.trim() !== '') { tags.push($refs.tagInput.value.trim()); $refs.tagInput.value = ''; }">
                                </div>
                                <div class="flex flex-wrap gap-2 mt-2">
                                    <template x-for="(tag, index) in tags" :key="index">
                                        <span class="bg-blue-500 text-white px-2 py-1 rounded-lg text-sm flex items-center">
                                            <span x-text="tag"></span>
                                            <button type="button" class="ml-2" @click="tags.splice(index, 1)">✕</button>
                                        </span>
                                    </template>
                                </div>
                                <input type="hidden" name="keyword" :value="JSON.stringify(tags)">
                            </div>                            
                        </div>

                        <!-- Tombol Action -->
                        <div class="flex justify-end mt-4">
                            <button type="button" @click="publikasiModal = false"
                                class="px-4 py-2 bg-gray-400 text-white rounded-lg mr-2 transition hover:bg-gray-500">Cancel</button>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg transition hover:bg-blue-600">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-slot>

    <div x-data="{ deleteModal: false, deleteID: null }">
        <div class="py-6 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-3 rounded-lg p-6">
                    <form action="{{ route('journal.index') }}" method="GET" class="relative w-2xl max-w-md mb-6">
                        <div class="relative flex items-center w-full border border-gray-300 rounded-lg shadow-sm">
                            <i class="fa-solid fa-magnifying-glass text-gray-400 absolute left-3"></i>
                            <input type="text" name="search" id="searchInput" value="{{ request('search') }}" 
                            placeholder="Search title or author..."
                            class="w-full pl-10 pr-10 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500""
                            >
                            @if(request('search'))
                                <button type="button" onclick="clearSearch()"
                                    class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            @endif
                        </div>
                    </form>
        
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($journals as $journal)
                            <div class="flex flex-col bg-white p-6 rounded-lg shadow-lg transform transition-all hover:scale-105 hover:shadow-xl group border border-gray-300">
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="col-span-2 border-r border-gray-300 pr-4">
                                        <h4 class="text-xl font-semibold text-gray-900 group-hover:text-blue-500 transition line-clamp-3 break-words">{{ $journal->title }}</h4>
                                        <p class="text-sm text-gray-600 mt-2 truncate">{{ $journal->authors }}</p>
                                        <p class="text-sm text-gray-600">Publisher: {{ $journal->publisher }}</p>
                                    </div>
                                    <div class="col-span-1 pl-4">
                                        <p class="text-sm text-gray-600">Published: {{ $journal->publication_year }}</p>
                                        <div class="flex flex-wrap gap-2 mt-2">
                                            @php
                                                $keywords = is_array($journal->keyword) ? $journal->keyword : json_decode($journal->keyword, true);
                                                $tagCount = count($keywords); // Hitung jumlah tag
                                            @endphp
                                            @foreach($keywords as $index => $tag)
                                                @if($index < 4) <!-- Tampilkan hanya 6 tag pertama -->
                                                    <span class="bg-blue-600 text-white px-2 py-1 rounded text-sm">{{ trim($tag) }}</span>
                                                @endif
                                            @endforeach
                                        
                                            @if($tagCount > 4) <!-- Jika ada lebih dari 6 tag, tampilkan 'X more' -->
                                                <span class="text-gray-600 text-xs">+ {{ $tagCount - 4 }} more</span>
                                            @endif
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="flex-grow"></div>
                                <div class="flex justify-between items-center mt-4">
                                    <a href="{{ route('journal.show', $journal->id) }}" class="text-blue-500 text-sm group-hover:text-blue-700 transition">Read More</a>
                                    <button @click="deleteModal = true; deleteID = {{ $journal->id }}" class="px-2 py-1 bg-red-500 text-white rounded-lg transition duration-200 hover:bg-red-600">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-10">
                        {{ $journals->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div x-show="deleteModal" 
            x-cloak
            @keydown.escape.window="deleteModal = false"
            class="fixed inset-0 flex justify-center items-center bg-gray-900 bg-opacity-50 backdrop-blur-sm z-50 transition-opacity duration-300"
            @click.self="deleteModal = false">
            
            <div x-show="deleteModal" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-10"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-10"
                class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg relative z-50">

                <!-- Tombol Close -->
                <button @click="deleteModal = false" class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 transition">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>  

                @if(isset($journals) && $journals->isNotEmpty())
                    <h3 class="text-lg font-semibold mb-4 text-center">Are you sure?</h3>
                    <p class="text-gray-700 text-center mb-4">You won't be able to revert this action!</p>

                    <div class="flex justify-center space-x-4 mt-4">

                        <button @click="deleteModal = false" class="px-4 py-2 bg-gray-400 text-white rounded mr-2">
                            Cancel
                        </button>
                        <form action="{{ route('journal.destroy', $journal?->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">
                                Delete
                            </button>
                        </form>
                    </div>
                @else
                    <p class="text-gray-500 text-center mt-4">Tidak ada data yang bisa dihapus.</p>
                @endif
            </div>
        </div>
    </div>

    <script>
        function clearSearch() {
            // Clear the search input value
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.value = '';
            }
    
            // Redirect to the journal index page without the search query
            window.location.href = "{{ route('journal.index') }}"; // Adjust as necessary
        }
    </script>
</x-app-layout>
