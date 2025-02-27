<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Journal') }}
        </h2>
    </x-slot>

    <div x-data="{ EditpublikasiModals: false }" x-init="if({{ $errors->any() ? 'true' : 'false' }}) EditpublikasiModals = true" >
        <div class="py-6 px-4 sm:px-6 lg:px-8">
            <div class="max-w-full mx-auto rounded-lg p-6 grid grid-cols-1 md:grid-cols-5  gap-6">
                <!-- Detail Journal Container (60%) -->
                <div class="md:col-span-3 mb-6 bg-gray-50 shadow-2xl p-6 rounded-lg flex flex-col justify-between min-h-[400px]"> 
                    <div>
                        <h3 class="text-2xl font-bold mb-4">{{ $journals->title }}</h3>
                        <p class="text-gray-600 mb-2"><strong>Authors:</strong> {{ $journals->authors }}</p>
                        <p class="text-gray-600 mb-2"><strong>Publication Year:</strong> {{ $journals->publication_year }}</p>
                        <p class="text-gray-600 mb-2"><strong>Publisher:</strong> {{ $journals->publisher }}</p>
                        <div class="flex justify-between">
                            <p class="text-gray-600 mb-2"><strong>DOI:</strong> 
                                <a href="{{ $journals->doi }}" class="text-blue-500" target="_blank">{{ $journals->doi }}</a>
                            </p> 
                            @if($journals->file_path)
                                <a href="{{ asset('storage/' . $journals->file_path) }}" target="_blank" class="px-4 py-2 bg-green-500 text-white rounded">View PDF</a>
                            @endif
                        </div>
                        <hr class="my-4">
                        <p class="text-gray-700 mt-2"><strong>Abstract:</strong></p>
                        <p class="text-gray-900 mt-4 text-justify">{{ $journals->abstract }}</p>
                        <hr class="my-4">
                        <div class="flex flex-wrap gap-2 mt-2">
                            <p class="text-gray-600 mb-2"><strong>Keywords :</strong></p>
                            @php
                                // Memastikan $journal->keyword ada dan terkonversi dengan benar
                                $keywords = is_array($journals->keyword) ? $journals->keyword : json_decode($journals->keyword, true);
                            @endphp
                            @foreach($keywords ?? [] as $tag)
                                <span class="bg-blue-500 text-white px-2 py-1 rounded text-sm">{{ trim($tag) }}</span>
                            @endforeach                                        
                        </div> 
                    </div>
                
                    <!-- Tombol tetap di bawah -->
                    <div class="mt-6 flex items-center justify-end">
                        <div class="flex space-x-2">
                            <button @click="EditpublikasiModals = true" class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg">Edit</button>
                            <a href="{{ route('journal.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Back</a>
                        </div>
                    </div>                
                </div>                

                <!-- Random Journal List Container (40%) -->
                <div class="md:col-span-2 mb-6 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold mb-4">Other Journals</h3>
                    <div class="grid grid-cols-1 gap-6">
                        @foreach($randomJournals as $randomJournal)
                            @if($randomJournal->id !== $journals->id)
                                <div class="bg-white p-6 rounded-lg shadow-lg transform transition-all hover:scale-105 hover:shadow-xl group border border-gray-300">
                                    <div class="grid grid-cols-3 gap-4">
                                        <!-- Kolom Kiri (Lebih Besar): Title, Authors, Publisher -->
                                        <div class="col-span-2 border-r border-gray-300 pr-4">
                                            <h4 class="text-lg font-semibold text-gray-900 group-hover:text-blue-500 transition line-clamp-2 leading-tight break-words">{{ $randomJournal->title }}</h4>
                                            <p class="text-xs text-gray-600 pt-2 truncate">{{ $randomJournal->authors }}</p>
                                            <p class="text-xs text-gray-600">Publisher: {{ $randomJournal->publisher }}</p>
                                        </div>
                                        
                                        <!-- Kolom Kanan (Lebih Kecil): Publication Year, License -->
                                        <div class="col-span-1 pl-4">
                                            <p class="text-xs pb-2 text-gray-600">Published: {{ $randomJournal->publication_year }}</p>
                                            @php
                                                $keywords = is_array($randomJournal->keyword) ? $randomJournal->keyword : json_decode($randomJournal->keyword, true);
                                                $tagCount = count($keywords);
                                            @endphp
                                            @foreach($keywords as $index => $tag)
                                                @if($index < 2) <!-- Tampilkan hanya 6 tag pertama -->
                                                    <span class="bg-blue-600 text-white flex flex-row w-fit mt-2 px-2 py-1 rounded text-sm">{{ trim($tag) }}</span>
                                                @endif
                                            @endforeach   
                                            
                                            @if($tagCount > 2) <!-- Jika ada lebih dari 6 tag, tampilkan 'X more' -->
                                                <span class="text-gray-600 text-xs">+ {{ $tagCount - 2 }} more</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="flex justify-between items-center mt-4">
                                        <a href="{{ route('journal.show', $randomJournal->id) }}" class="text-blue-500 text-xs group-hover:text-blue-700 transition">Read More</a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL EDIT JOURNAL -->
        <div x-show="EditpublikasiModals" x-cloak class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center" x-transition @click.away="EditpublikasiModals = false">
            <div class="bg-white w-full max-w-6xl p-6 rounded-lg shadow-lg relative max-h-[90vh] overflow-y-auto" @click.stop>
                <h3 class="text-lg font-semibold mb-4">Edit Journal</h3>
                <form action="{{ route('journal.update', $journals->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700">Title</label>
                            <input type="text" name="title" value="{{ $journals->title }}" class="w-full border p-2 rounded" required>
                            @error('title')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700">Authors</label>
                            <input type="text" name="authors" value="{{ $journals->authors }}" class="w-full border p-2 rounded" required>
                        </div>
                        <div>
                            <label class="block text-gray-700">Publication Year</label>
                            <input type="number" name="publication_year" value="{{ $journals->publication_year }}" class="w-full border p-2 rounded" required>
                        </div>
                        <div>
                            <label class="block text-gray-700">Publisher</label>
                            <input type="text" name="publisher" value="{{ $journals->publisher }}" class="w-full border p-2 rounded">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-gray-700">Abstract</label>
                            <textarea name="abstract" class="w-full border p-2 rounded" rows="5" required>{{ $journals->abstract }}</textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700">File (PDF)</label>
                            <input type="file" name="file" accept=".pdf" class="w-full border p-2 rounded">
                        </div>
                        <div>
                            <label class="block text-gray-700">DOI</label>
                            <input type="text" name="doi" value="{{ $journals->doi }}" class="w-full border p-2 rounded">
                        </div>
                        <div x-data="{ tags: [] }" class="col-span-2">
                            <label class="block text-gray-700">Tags</label>
                            <div class="flex items-center border p-2 rounded w-full">
                                <input type="text" x-ref="tagInput" class="flex-1 border-none outline-none" 
                                    placeholder="Enter a tag and press Enter"
                                    @keydown.enter.prevent="
                                        if ($refs.tagInput.value.trim() !== '') { 
                                            tags.push($refs.tagInput.value.trim()); 
                                            $refs.tagInput.value = ''; 
                                        }
                                    ">
                            </div>
                            <div class="flex flex-wrap gap-2 mt-2">
                                <template x-for="(tag, index) in tags" :key="index">
                                    <span class="bg-blue-500 text-white px-2 py-1 rounded text-sm flex items-center">
                                        <span x-text="tag"></span>
                                        <button type="button" class="ml-2" @click="tags.splice(index, 1)">✕</button>
                                    </span>
                                </template>
                            </div>
                            <input type="hidden" name="keyword" :value="JSON.stringify(tags)">
                            <!-- Pesan kesalahan jika tidak ada tag -->
                            <p class="text-sm text-red-500 mt-2" x-show="tags.length === 0">
                                * Masukan kembali tag.
                            </p>
                        </div> 
                    </div>                       
                    <div class="flex justify-end mt-4">
                        <button type="button" @click="EditpublikasiModals = false" class="px-4 py-2 bg-gray-400 text-white rounded mr-2">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
