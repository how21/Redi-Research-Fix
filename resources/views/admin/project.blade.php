<x-app-layout>
    <x-slot name="header">
        <div x-data="{ projectModal: false}" 
        x-init="if({{ $errors->any() ? 'true' : 'false' }}) projectModal = true"
        class="flex justify-between items-center relative">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Project Management') }}
            </h2>
            <!-- MODAL CREATE PROJECT -->
            <div class="relative">
                <button @click="projectModal = true" class="px-4 py-2 bg-blue-700 text-white rounded mt-2 sm:mt-0 transi duration-300 hover:scale-110"><i class="fa-sharp fa-solid fa-plus"></i></button>
                <div x-show="projectModal" 
                    class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 backdrop-blur-sm z-50"
                    x-transition:enter="transition-opacity duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">
                    
                    <!-- MODAL BOX -->
                    <div x-show="projectModal"
                        x-transition:enter="transition-all transform duration-500"
                        x-transition:enter-start="opacity-0 scale-90"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition-all transform duration-250"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-90"
                        class="bg-white w-full max-w-md p-6 rounded-xl shadow-xl relative z-50">
                        
                        <!-- Tombol Close (X) -->
                        <button @click="projectModal = false" class="absolute top-3 right-3 text-gray-600 hover:text-gray-900">
                            <i class="fa-solid fa-xmark text-xl"></i>
                        </button>

                        <!-- Header -->
                        <h3 class="text-xl font-semibold text-gray-800 mb-4 text-center">🚀 Create New Project</h3>

                        <!-- Form -->
                        <form action="{{ route('project.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700">Title</label>
                                <input type="text" name="title" class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                                @error('title')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700">Date</label>
                                <input type="date" name="date" class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700">Client</label>
                                <select name="client_id" class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                                    <option value="">Pilih Client</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700">Kategori</label>
                                <select name="kategori_id" class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($bidangs as $bidang)
                                        <option value="{{ $bidang->id }}">{{ $bidang->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="flex justify-end gap-2">
                                <button type="button" @click="projectModal = false" 
                                    class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 transition-all">
                                    Cancel
                                </button>
                                <button type="submit" 
                                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-all shadow-md">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div x-data="{deleteModal: false, deleteId: null}" class="mx-4 sm:mx-6 lg:mx-8 py-4 px-2 sm:px-4 lg:px-6}">
        <!-- Projects List -->
        <div class=" bg-white shadow-md rounded-lg p-4 sm:p-6 m-6">
            <div class="sm:flex-row justify-between items-center mb-4">
                <form action="{{ route('project.index') }}" method="GET" class="mb-4 mt-4 flex flex-col sm:flex-row justify-between items-center gap-2">
                    <!-- Search Input -->
                    <div class="relative flex items-center w-80 border border-gray-300 rounded-lg shadow-sm">
                        <i class="fa-solid fa-magnifying-glass text-gray-400 absolute left-3"></i>
                        <input 
                            type="text" 
                            name="searchProject" 
                            placeholder="Cari Project..." 
                            class="w-full pl-10 pr-10 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ request('searchProject') }}"
                        >
                        @if(request('searchProject'))
                            <a href="{{ route('project.index') }}" class="absolute right-3 text-gray-400 hover:text-gray-600">
                                <i class="fa-solid fa-xmark"></i>
                            </a>
                        @endif
                    </div>
            
                    <div class="flex flex-col sm:flex-row gap-2">
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
            
            <div class="overflow-x-auto pt-4">
                <table class="w-full border-collapse text-sm sm:text-base">
                    <thead>
                        <tr class="bg-blue-600 text-white font-semibold">
                            <th class="w-2/5 px-4 py-3 text-left">Title</th>
                            <th class="w-1/5 px-4 py-3 text-left">Date</th>
                            <th class="w-1/5 px-4 py-3 text-left">Client</th>
                            <th class="w-1/5 px-4 py-3 text-left">Category</th>
                            <th class="w-[80px] px-4 py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr class="border-b hover:bg-blue-50 transition">
                                <td class="px-4 py-3 whitespace-normal break-words text-gray-800">
                                    {{ $project->title }}
                                </td>
                                <td class="px-4 py-3 text-gray-600">{{ $project->date }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $project->client->full_name }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $project->bidang->name }}</td>
                                <td class="px-4 py-3 text-center">
                                    <button @click="deleteModal = true; deleteId = {{ $project->id }}"
                                        type="submit" 
                                        class="px-2 py-1 bg-red-500 hover:bg-red-600 text-white rounded">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6">
                {{ $projects->appends(['project_page' => request('project_page')])->links('vendor.pagination.tailwind') }}
            </div>
        </div>

        <!-- MODAL DELETE PROJECT -->
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

                <h3 class="text-lg font-semibold mb-4 text-center">Are you sure?</h3>
                <p class="text-gray-700 text-center mb-4">You won't be able to revert this action!</p>

                <!-- Countdown text -->
                <p class="text-red-500 text-center hidden countdown-text"></p>
                <p class="text-center text-red-600">Deleting Project ID: <span x-text="deleteId"></span></p>

                <div class="flex justify-center space-x-4 mt-4">
                    <!-- Cancel button -->
                    <button @click="deleteModal = false; cancelDelete()" class="cancel-button px-4 py-2 bg-gray-400 text-white rounded">
                        Cancel
                    </button>

                    <!-- Form -->
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="delete-button px-4 py-2 bg-red-500 text-white rounded">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let deleteButtons = document.querySelectorAll('.delete-button');
            let cancelButtons = document.querySelectorAll('.cancel-button');
            let countdownText;
            let deleteTimeout;
            
            function deleteProject(id) {
                console.log("Deleting project with ID:", id); // DEBUGGING
                let form = document.getElementById('deleteForm');

                // Ganti '__ID__' dengan deleteId di route Laravel
                let deleteRoute = `{{ route('project.destroy', '__ID__') }}`.replace('__ID__', id);
                form.action = deleteRoute;
            }

            function cancelDelete() {
                clearInterval(deleteTimeout);
                if (countdownText) {
                    countdownText.classList.add('hidden');
                    countdownText.innerText = '';
                }
                document.querySelector('.delete-button').disabled = false;
            }

            deleteButtons.forEach((button) => {
                button.addEventListener('click', function () {
                    let parentModal = button.closest('.fixed');
                    countdownText = parentModal.querySelector('.countdown-text');
                    let deleteForm = document.getElementById('deleteForm');
                    let deleteId = document.querySelector('[x-text="deleteId"]').textContent.trim();
                    let countdown = 5;

                    if (!deleteId) {
                        console.error("❌ ERROR: deleteId tidak ditemukan!");
                        return;
                    }

                    deleteProject(deleteId);

                    button.disabled = true;
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
                });
            });

            cancelButtons.forEach((button) => {
                button.addEventListener('click', function () {
                    cancelDelete();
                });
            });
        });

        // Filter by Client
        document.getElementById('filter-client').addEventListener('change', function() {
            applyFilters();
        });
        // Filter by Bidang
        document.getElementById('filter-bidang').addEventListener('change', function() {
            applyFilters();
        });

        // Function to apply all filters
        function applyFilters() {
            let clientId = document.getElementById('filter-client').value;
            let bidangId = document.getElementById('filter-bidang').value;
            let url = new URL(window.location.href);

            // Set Client Filter
            if (clientId) {
                url.searchParams.set('client_id', clientId);
            } else {
                url.searchParams.delete('client_id');
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
