<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Experience') }}
            </h2>
            <button class="mt-2 bg-blue-500 text-white px-3 py-1 rounded-lg hover:scale-105 hover:bg-blue-600">
                <a href="{{ route('experience.create') }}" >
                    <i class="text-xl hover:scale-110 fa-solid fa-plus"></i>
                </a>
            </button>
        </div>
    </x-slot>

    <div x-data="{ provinceModal: false, openProvinceModal: false, deleteModal: false, deleteId: null, selectedProvince: { id: '', name: ''}, clientModal: false, openEditClientModal: false, selectedClient: { id: '', full_name: '', short_name: '' }  }">
        <div class="py-6 px-4 sm:px-6 lg:px-8">
            <div class="gap-6">

                <div class="bg-white shadow-md rounded-lg p-6">
                    <div class="sm:flex-row justify-between items-center mb-4">
                        
                        <form action="{{ route('experience.index') }}" method="GET" class="mb-4 mt-4 flex flex-col sm:flex-row justify-between items-center gap-2">
                            <!-- Search Input -->
                            <div class="relative flex items-center w-80 border border-gray-300 rounded-lg shadow-sm">
                                <i class="fa-solid fa-magnifying-glass text-gray-400 absolute left-3"></i>
                                <input 
                                    type="text" 
                                    name="searchExperience" 
                                    placeholder="Cari lainnya..." 
                                    class="w-full pl-10 pr-10 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    value="{{ request('searchExperience') }}"
                                >
                                @if(request('searchExperience'))
                                    <a href="{{ route('experience.index') }}" class="absolute right-3 text-gray-400 hover:text-gray-600">
                                        <i class="fa-solid fa-xmark"></i>
                                    </a>
                                @endif
                            </div>
                    
                            <div class="flex flex-col sm:flex-row gap-4 mb-2">
                                <!-- Filter by Client -->
                                <div>
                                    <label for="filter-client" class="block text-sm font-semibold text-gray-700">Filter by Client:</label>
                                    <div class="relative">
                                        <select name="client_id" id="filter-client" class="w-full min-w-40 border rounded-lg p-2 pl-10 bg-gray-50 focus:ring-2 focus:ring-blue-300 focus:border-blue-500 transition-all">
                                            <option value="">All Clients</option>
                                            @foreach($clients as $client)
                                                <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>
                                                    {{ $client->full_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <svg class="absolute left-3 top-3 w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                                        </svg>
                                    </div>
                                </div>

                                <!-- Filter by Province -->
                                <div>
                                    <label for="filter-province" class="block text-sm font-semibold text-gray-700">Filter by Province:</label>
                                    <div class="relative">
                                        <select name="province_id" id="filter-province" class="w-full min-w-40 border rounded-lg p-2 pl-10 bg-gray-50 focus:ring-2 focus:ring-blue-300 focus:border-blue-500 transition-all">
                                            <option value="">All Provinsi</option>
                                            @foreach($provinces as $province)
                                                <option value="{{ $province->id }}" {{ request('province_id') == $province->id ? 'selected' : '' }}>
                                                    {{ $province->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <svg class="absolute left-3 top-3 w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                                        </svg>
                                    </div>
                                </div>
                    
                                <!-- Filter by Bidangs -->
                                <div>
                                    <label for="filter-bidang" class="block text-sm font-semibold text-gray-700">Filter by Bidang:</label>
                                    <div class="relative">
                                        <select name="kategori_id" id="filter-bidang" class="w-full min-w-40 border rounded-lg p-2 pl-10 bg-gray-50 focus:ring-2 focus:ring-blue-300 focus:border-blue-500 transition-all">
                                            <option value="">All Kategori</option>
                                            @foreach($bidangs as $bidang)
                                                <option value="{{ $bidang->id }}" {{ request('kategori_id') == $bidang->id ? 'selected' : '' }}>
                                                    {{ $bidang->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <svg class="absolute left-3 top-3 w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </form> 
                    </div>

                    <!-- Section for Displaying Articles -->
                    <div>

                        <!-- Check if there are articles -->
                        @if($experiences->count() > 0)
                            <!-- Articles Grid Container -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($experiences as $experience)
                                    <div class="bg-gray-100 p-4 rounded-lg shadow-md flex flex-col justify-between h-full">
                                        <!-- Image on top -->
                                        @if($experience->image)
                                            <img src="{{ asset($experience->image) }}" 
                                                alt="Gambar Experience" 
                                                class="w-full h-48 object-cover rounded-lg">
                                        @else
                                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                                                No Image
                                            </div>
                                        @endif

                                        <!-- Title with multiple lines -->
                                        <h4 class="text-2xl font-bold text-gray-900 mt-4 mb-2 line-clamp-3 break-words" style="font-family: 'Poppins', sans-serif;">
                                            {{ $experience->title }}
                                        </h4>
                                        
                                        <!-- Content Preview -->
                                        <p class="mt-2 flex-grow text-gray-700">{{ \Illuminate\Support\Str::limit(strip_tags($experience->content), 150) }}</p>

                                        <!-- Client and Province Info -->
                                        <div class="flex items-center gap-4 mt-2 text-gray-600">
                                            <div class="flex-1">
                                                <p class="flex items-center gap-2"><i class="fa-sharp fa-solid fa-circle-user"></i>{{ optional($experience->client)->full_name ?? 'Unknown' }}</p>
                                                <p class="flex items-center gap-2"><i class="fas fa-map-marker-alt"></i> {{ optional($experience->province)->name ?? 'Unknown' }}</p>
                                                <p class="flex items-center gap-2"><i class="fas fa-briefcase"></i> {{ optional($experience->bidang)->name ?? 'Unknown' }}</p>
                                            </div>
                                        </div>                                   

                                        <!-- Read More button -->
                                        <div class="flex items-center justify-between mt-2">
                                            <a href="{{ route('experience.show', $experience->id) }}" class="text-blue-500 mt-4 inline-block">Read More</a>
                                            <div class="flex space-x-2">
                                                <button class="mt-4 bg-blue-500 text-white px-4 py-1 rounded-lg hover:bg-blue-600">
                                                    <a href="{{ route('experience.edit', $experience->id) }}" >
                                                        edit
                                                    </a>
                                                </button>
                                                <button @click="deleteModal = true; deletedId = {{ $experience->id }}; deleteType = 'experience'" type="submit" class="mt-4 px-3 py-2 bg-red-500 hover:bg-red-600 text-white rounded">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            <div class="mt-6">
                                {{ $experiences->appends(request()->query())->links() }}
                            </div>
                        @else
                            <p class="text-gray-500">Belum ada artikel yang tersedia.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL DELETE BIDANG -->
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

                @if(isset($experiences) && $experiences->isNotEmpty())
                    <h3 class="text-lg font-semibold mb-4 text-center">Are you sure?</h3>
                    <p class="text-gray-700 text-center mb-4">You won't be able to revert this action!</p>

                    <!-- Countdown text (disembunyikan dulu) -->
                    <p class="text-red-500 text-center hidden countdown-text"></p>

                    <div class="flex justify-center space-x-4 mt-4">
                        <!-- Cancel button -->
                        <button @click="deleteModal = false" class="cancel-button px-4 py-2 bg-gray-400 text-white rounded">
                            Cancel
                        </button>
                        <form action="{{ route('experience.destroy', $experience?->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="delete-button px-4 py-2 bg-red-500 text-white rounded">
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
        document.addEventListener('DOMContentLoaded', function () {
            let deleteButtons = document.querySelectorAll('.delete-button');
            let cancelButtons = document.querySelectorAll('button.cancel-button');
            let deleteTimeout;
            let countdownText;
            
            function cancelDelete(button) {
                clearInterval(deleteTimeout); // Hentikan countdown
                if (countdownText) {
                    countdownText.classList.add('hidden'); // Sembunyikan teks countdown
                    countdownText.innerText = ''; // Reset teks
                }
                if (button) {
                    button.disabled = false; // Aktifkan kembali tombol delete
                }
            }
    
            deleteButtons.forEach((button) => {
                button.addEventListener('click', function () {
                    let parentModal = button.closest('.fixed');
                    countdownText = parentModal.querySelector('.countdown-text');
                    let deleteForm = parentModal.querySelector('form');
                    let countdown = 5;
    
                    button.disabled = true;
    
                    setTimeout(() => {
                        countdownText.classList.remove('hidden');
                        countdownText.innerText = `Deleting in ${countdown} seconds...`;
    
                        deleteTimeout = setInterval(() => {
                            countdown--;
                            countdownText.innerText = `Deleting in ${countdown} seconds...`;
    
                            if (countdown <= 0) {
                                clearInterval(deleteTimeout);
                                deleteForm.submit();
                            }
                        }, 1000);
                    }, 10);
                });
            });
    
            cancelButtons.forEach((button) => {
                button.addEventListener('click', function () {
                    let parentModal = button.closest('.fixed');
                    let deleteButton = parentModal.querySelector('.delete-button');
                    cancelDelete(deleteButton);
                });
            });
        });

        // Filter by Client
        document.getElementById('filter-client').addEventListener('change', function() {
            applyFilters();
        });
        //  Filter by Province
        document.getElementById('filter-province').addEventListener('change', function() {
            applyFilters();
        });
        // Filter by Bidang
        document.getElementById('filter-bidang').addEventListener('change', function() {
            applyFilters();
        });

        // Function to apply all filters
        function applyFilters() {
            let clientId = document.getElementById('filter-client').value;
            let provinceId = document.getElementById('filter-province').value;
            let bidangId = document.getElementById('filter-bidang').value;
            let url = new URL(window.location.href);

            // Set Client Filter
            if (clientId) {
                url.searchParams.set('client_id', clientId);
            } else {
                url.searchParams.delete('client_id');
            }

            // Set Province Filter
            if (provinceId) {
                url.searchParams.set('province_id', provinceId);
            } else {
                url.searchParams.delete('province_id');
            }

            // Set Bidang Filter
            if (bidangId) {
                url.searchParams.set('kategori_id', bidangId);
            } else {
                url.searchParams.delete('kategori_id');
            }

            // Redirect with new filters
            window.location.href = url;
        }
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "{{ session('success') }}",
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        @endif
    </script>
</x-app-layout>
