<x-app-layout>
    <x-slot name="header">
        <div x-data="{ openCreateModal: false }" class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Album') }}
            </h2>
            <!-- Hero Slider Section (Full Page) -->
            <button @click="openCreateModal = true" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-base font-semibold shadow-md hover:bg-blue-700 transition">
                + Add Album
            </button>
            <!-- Modal Create Album -->
            <div x-show="openCreateModal" x-cloak x-transition.opacity class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
                <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg relative z-50" @click.outside="openCreateModal = false">
                    <button @click="openCreateModal = false" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">&times;</button>
                    <h3 class="text-lg font-semibold mb-4">Add New Album</h3>
                    <form action="{{ route('album.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700">Title</label>
                            <input type="text" name="title" class="w-full border p-2 rounded" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Category</label>
                            <select name="categories_id" class="w-full border p-2 rounded" required>
                                @forelse($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @empty
                                    <option value="" disabled>No categories available</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Image</label>
                            <input type="file" name="image" class="w-full border p-2 rounded" required>
                        </div>
                        <div class="flex justify-end">
                            <button type="button" @click="openCreateModal = false" class="px-4 py-2 bg-gray-400 text-white rounded mr-2">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div x-data="sliderComponent()" x-init="startAutoSlide()" class="relative w-full h-[80vh] overflow-hidden rounded-lg shadow-lg">
            <!-- Gambar Slider -->
            <template x-for="(image, index) in images" :key="index">
                <img :src="image" 
                    alt="Gallery Image" 
                    class="absolute inset-0 w-full h-full object-cover transition-opacity duration-700 ease-in-out"
                    :class="{ 'opacity-0 scale-95': index !== currentIndex, 'opacity-100 scale-100': index === currentIndex }">
            </template>

            <!-- Overlay -->
            <div class="absolute inset-0 bg-black bg-opacity-30 flex flex-col items-center justify-center text-white">
                <h1 class="text-4xl md:text-6xl font-bold drop-shadow-lg">Explore Your Memories</h1>
                <p class="text-lg mt-2 drop-shadow-lg">Capture every moment and cherish forever</p>
            </div>

            <!-- Tombol Navigasi Kiri -->
            <button @click="prev()" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-gray-900 bg-opacity-50 p-3 text-white rounded-full hover:bg-opacity-80 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <!-- Tombol Navigasi Kanan -->
            <button @click="next()" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-gray-900 bg-opacity-50 p-3 text-white rounded-full hover:bg-opacity-80 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Indicator Bubbles -->
            <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-2">
                <template x-for="(image, index) in images" :key="index">
                    <div @click="currentIndex = index" 
                        class="w-4 h-4 rounded-full bg-gray-400 cursor-pointer transition-all"
                        :class="{ 'bg-white w-5 h-5': index === currentIndex }">
                    </div>
                </template>
            </div>
        </div>

        <!-- Categories Section (Images with Overlay) -->
        <div class="mt-12">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @forelse($categories as $category)
                    <a href="{{ route('album.category', $category->id) }}" class="relative group block">
                        <img src="{{ optional($category->albums->first())->image ? asset('storage/' . $category->albums->first()->image) : 'https://via.placeholder.com/400x300' }}" 
                            alt="Category Image" class="w-full h-64 object-cover rounded-lg shadow-lg transition group-hover:brightness-50">
                        <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-70 flex items-center justify-center transition rounded-lg">
                            <h4 class="text-white text-xl font-semibold">{{ $category->name }}</h4>
                        </div>
                    </a>
                @empty
                    <p class="text-gray-500">Belum ada kategori yang tersedia.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Script Alpine.js -->
    <script>
        function sliderComponent() {
            return {
                images: @json($sliderImages->pluck('image')->map(fn($img) => asset('storage/' . $img))),
                currentIndex: 0,
                interval: null,

                next() {
                    this.currentIndex = (this.currentIndex + 1) % this.images.length;
                },

                prev() {
                    this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
                },

                startAutoSlide() {
                    this.interval = setInterval(() => this.next(), 5000);
                }
            };
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</x-app-layout>
