<x-app-layout>
    {{-- Font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <x-slot name="header">
        <div x-data="{ 
            showDropdown: false, 
            clientModal: false, 
            provinceModal: false,
            categoryModal: false,
            bidangModal: false}"
            x-init="
                @if ($errors->has('full_name') || $errors->has('short_name'))
                    clientModal = true;
                @endif
                @if ($errors->has('name'))
                    provinceModal = true;
                @endif"
            class="flex justify-between items-center relative">
    
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="relative">
                <button @click="showDropdown = !showDropdown" class="px-4 py-2 bg-blue-700 text-white rounded-lg flex items-center transition-all duration-300 hover:bg-blue-800">
                    Create New <i class="fas fa-chevron-down ml-2"></i>
                </button>
        
                <!-- DROPDOWN MENU -->
                <div x-show="showDropdown" 
                    @click.away="showDropdown = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-90"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-90"
                    class="absolute top-full right-0 mt-2 w-48 bg-white shadow-md rounded-lg z-10 overflow-hidden">
                    
                    <button @click="clientModal = true; showDropdown = false" class="block px-4 py-2 text-left w-full hover:bg-gray-200">Create Client</button>
                    <button @click="provinceModal = true; showDropdown = false" class="block px-4 py-2 text-left w-full hover:bg-gray-200">Create Province</button>
                    <button @click="categoryModal = true; showDropdown = false" class="block px-4 py-2 text-left w-full hover:bg-gray-200">Create Category</button>
                    <button @click="bidangModal = true; showDropdown = false" class="block px-4 py-2 text-left w-full hover:bg-gray-200">Create Bidang</button>
                </div>
            </div>

            <!-- BACKDROP -->
            <div x-show="clientModal || provinceModal || categoryModal || bidangModal"
                class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex justify-center items-center z-50"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0">
            
                <!-- MODAL WRAPPER CLIENTS-->

                <div @keydown.escape.window="clientModal = false; provinceModal = false; categoryModal = false; bidangModal = false" 
                    x-show="clientModal" 
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-10"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-10"
                    class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
                    
                    <h3 class="text-lg font-semibold mb-4">Create New Client</h3>
                    <form method="POST" action="{{ route('client.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700">Client Full Name</label>
                            <input type="text" name="full_name" class="w-full border p-2 rounded focus:ring focus:ring-blue-300" required>
                            @error('full_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Client Short Name</label>
                            <input type="text" name="short_name" class="w-full border p-2 rounded focus:ring focus:ring-blue-300" required>
                            @error('short_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex justify-end">
                            <button type="button" @click="clientModal = false" class="px-4 py-2 bg-gray-400 text-white rounded mr-2 hover:bg-gray-500">Cancel</button>
                            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Save</button>
                        </div>
                    </form>
                </div>

                <!-- MODAL WRAPPER PROVINCE-->

                <div @keydown.escape.window="clientModal = false; provinceModal = false; categoryModal = false; bidangModal = false" 
                    x-show="provinceModal" 
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-10"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-10"
                    class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
                    
                    <h3 class="text-lg font-semibold mb-4">Create New Province</h3>
                    <form method="POST" action="{{ route('province.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700">Province Name</label>
                            <input type="text" name="name" class="w-full border p-2 rounded focus:ring focus:ring-blue-300" required>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex justify-end">
                            <button type="button" @click="provinceModal = false" class="px-4 py-2 bg-gray-400 text-white rounded mr-2 hover:bg-gray-500">Cancel</button>
                            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Save</button>
                        </div>
                    </form>
                </div>

                <!-- MODAL WRAPPER CATEGORY-->

                <div @keydown.escape.window="clientModal = false; provinceModal = false; categoryModal = false; bidangModal = false" 
                    x-show="categoryModal" 
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-10"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-10"
                    class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
                    
                    <h3 class="text-lg font-semibold mb-4">Create New category</h3>
                    <form method="POST" action="{{ route('categorie.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700">category Name</label>
                            <input type="text" name="name" class="w-full border p-2 rounded focus:ring focus:ring-blue-300" required>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex justify-end">
                            <button type="button" @click="categoryModal = false" class="px-4 py-2 bg-gray-400 text-white rounded mr-2 hover:bg-gray-500">Cancel</button>
                            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Save</button>
                        </div>
                    </form>
                </div>

                <!-- MODAL WRAPPER BIDANG-->

                <div @keydown.escape.window="clientModal = false; provinceModal = false; categoryModal = false; bidangModal = false" 
                    x-show="bidangModal" 
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-10"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-10"
                    class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
                    
                    <h3 class="text-lg font-semibold mb-4">Create New Bidang</h3>
                    <form method="POST" action="{{ route('bidang.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700">Bidang Name</label>
                            <input type="text" name="name" class="w-full border p-2 rounded focus:ring focus:ring-blue-300" required>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex justify-end">
                            <button type="button" @click="bidangModal = false" class="px-4 py-2 bg-gray-400 text-white rounded mr-2 hover:bg-gray-500">Cancel</button>
                            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-slot>

    <div x-data="{ openProvinceModal: false, selectedProvince: { id: '', name: ''}, 
                openEditClientModal: false, selectedClient: { id: '', full_name: '', short_name: '' },
                openCategoryModal: false, selectedCategori: {id: '', name: ''},
                openBidangModal: false, selectedBidang: {id: '', name: ''},
                deleteModalbid: false, deleteModalclient: false, deleteModalprov: false, deleteModalcat: false,deleteId: null }">
        <div class="mx-4 sm:mx-6 lg:mx-8 py-6 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 pt-6 gap-4">
                {{-- card statistik --}}
                <div class="bg-white shadow-md rounded-lg p-4 border relative">
                    <!-- Header Strip -->
                    <div class="absolute top-0 left-0 w-full h-3 rounded-t-lg bg-blue-700"></div>
                    
                    <!-- Isi Kartu -->
                    <div class="flex justify-between items-start mt-3">
                        <div>
                            <span class="text-gray-500 text-sm">Projects</span>
                            <h2 class="text-3xl font-bold text-gray-900">{{ $totalProjects }}</h2>
                            <span class="text-sm text-gray-500">Completed</span>
                        </div>
                        <div class="bg-blue-100 p-2 rounded-lg">
                            <i class="fas fa-briefcase bg-blue-100 text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white shadow-md rounded-lg p-4 border relative">
                    <!-- Header Strip -->
                    <div class="absolute top-0 left-0 w-full h-3 rounded-t-lg bg-blue-700"></div>
                    
                    <!-- Isi Kartu -->
                    <div class="flex justify-between items-start mt-3">
                        <div>
                            <span class="text-gray-500 text-sm">Publikasi</span>
                            <h2 class="text-3xl font-bold text-gray-900">{{ $totalJournal }}</h2>
                            <span class="text-sm text-gray-500">Completed</span>
                        </div>
                        <div class="bg-blue-100 p-2 rounded-lg">
                            <i class="fa-solid fa-book-open bg-blue-100 text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white shadow-md rounded-lg p-4 border relative">
                    <!-- Header Strip -->
                    <div class="absolute top-0 left-0 w-full h-3 rounded-t-lg bg-blue-700"></div>
                    
                    <!-- Isi Kartu -->
                    <div class="flex justify-between items-start mt-3">
                        <div>
                            <span class="text-gray-500 text-sm">Experience</span>
                            <h2 class="text-3xl font-bold text-gray-900">{{ $totalExperiences }}</h2>
                            <span class="text-sm text-gray-500">Completed</span>
                        </div>
                        <div class="bg-blue-100 p-2 rounded-lg">
                            <i class="fa-solid fa-handshake-angle bg-blue-100 text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white shadow-md rounded-lg p-4 border relative">
                    <!-- Header Strip -->
                    <div class="absolute top-0 left-0 w-full h-3 rounded-t-lg bg-blue-700"></div>
                    
                    <!-- Isi Kartu -->
                    <div class="flex justify-between items-start mt-3">
                        <div>
                            <span class="text-gray-500 text-sm">Album</span>
                            <h2 class="text-3xl font-bold text-gray-900">{{ $totalAlbums }}</h2>
                            <span class="text-sm text-gray-500">Completed</span>
                        </div>
                        <div class="bg-blue-100 p-2 rounded-lg">
                            <i class="fas fa-image bg-blue-100 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 pt-6 gap-4">
                <!-- Clients Table -->
                <div class="md:col-span-1 bg-white shadow-md rounded-lg p-6">
                    <form action="{{ route('dashboard') }}" method="GET" class="mb-4 flex justify-between items-center gap-2">
                        <span class="text-2xl text-blue-700 font-semibold">Clients</span>
                        <div class="relative flex items-center w-80 border border-gray-300 rounded-lg shadow-sm">
                            <i class="fa-solid fa-magnifying-glass text-gray-400 absolute left-3"></i>
                            <input 
                                type="text" 
                                name="searchClient" 
                                placeholder="Cari client..." 
                                class="w-full pl-10 pr-10 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ request('searchClient') }}"
                            >
                            @if(request('searchClient'))
                                <a href="{{ route('dashboard') }}" class="absolute right-3 text-gray-400 hover:text-gray-600">
                                    <i class="fa-solid fa-xmark"></i>
                                </a>
                            @endif
                        </div>
                    </form>                                        
                                                        
                    <div class="overflow-x-auto rounded-lg">
                        <table class="w-full border-collapse text-sm sm:text-base">
                            <thead>
                                <tr class="bg-blue-200 text-center">
                                    <th class="px-4 py-2">Full Name</th>
                                    <th class="px-4 py-2">Short Name</th>
                                    <th class="px-4 py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr class="text-center hover:bg-gray-100 border-b">
                                        <td class="px-4 py-2">{{ $client->full_name }}</td>
                                        <td class="px-4 py-2">{{ $client->short_name }}</td>
                                        <td class="px-4 py-2 flex flex-row justify-center space-x-2">
                                            <button @click="
                                                selectedClient = {
                                                    id: '{{ $client->id }}',
                                                    full_name: '{{ $client->full_name }}',
                                                    short_name: '{{ $client->short_name }}'
                                                };
                                                openEditClientModal = true;
                                                " class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded"><i class="fa-duotone fa-regular fa-pen-to-square"></i></button>
                                            <button @click="deleteModalclient = true; deleteId = {{ $client->id }}; deleteType = 'client'" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex-grow"></div>
                    <div class="flex mt-4">
                        {{ $clients->appends(['provinces_page' => request('provinces_page')])->links('vendor.pagination.simple-tailwind') }}
                    </div>
                </div>
            
                <!-- Provinces Table -->
                <div class="md:col-span-1 bg-white shadow-md rounded-lg p-6">
                    <form action="{{ route('dashboard') }}" method="GET" class="mb-4 flex justify-between items-center gap-2">
                        <span class="text-2xl text-blue-700 font-semibold">Provinsi</span>
                        <div class="relative flex items-center w-80 border border-gray-300 rounded-lg shadow-sm">
                            <i class="fa-solid fa-magnifying-glass text-gray-400 absolute left-3"></i>
                            <input 
                                type="text" 
                                name="searchProvince" 
                                placeholder="Cari Provinsi..." 
                                class="w-full pl-10 pr-10 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ request('searchProvince') }}"
                            >
                            @if(request('searchProvince'))
                                <a href="{{ route('dashboard') }}" class="absolute right-3 text-gray-400 hover:text-gray-600">
                                    <i class="fa-solid fa-xmark"></i>
                                </a>
                            @endif
                        </div>
                    </form> 
                    <div class="overflow-x-auto rounded-lg">
                        <table class="w-full border-collapse text-sm sm:text-base">
                            <thead>
                                <tr class="bg-blue-200 text-center">
                                    <th class="px-4 py-2">Name</th>
                                    <th class="px-4 py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($provinces as $province)
                                    <tr class="text-center hover:bg-gray-100 border-b">
                                        <td class="px-4 py-2">{{ $province->name }}</td>
                                        <td class="px-4 py-2 flex flex-row justify-center space-x-2">
                                            <button @click="
                                                selectedProvince = {
                                                    id: '{{ $province->id }}',
                                                    name: '{{ $province->name }}'
                                                };
                                                openProvinceModal = true;
                                                " class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded"><i class="fa-duotone fa-regular fa-pen-to-square"></i></button>
                                            <button @click="deleteModalprov = true; deleteId = {{ $province->id }}; deleteType = 'province'" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-6">
                            {{ $provinces->appends(['clients_page' => request('clients_page')])->links('vendor.pagination.simple-tailwind') }}
                        </div>
                    </div>
                </div>

                <!-- Category Table -->
                <div class="md:col-span-1 bg-white shadow-md rounded-lg p-6">
                    <form action="{{ route('dashboard') }}" method="GET" class="mb-4 flex justify-between items-center gap-2">
                        <span class="text-2xl text-blue-700 font-semibold">Category</span>
                        <div class="relative flex items-center w-80 border border-gray-300 rounded-lg shadow-sm">
                            <i class="fa-solid fa-magnifying-glass text-gray-400 absolute left-3"></i>
                            <input 
                                type="text" 
                                name="searchCategory" 
                                placeholder="Cari Category..." 
                                class="w-full pl-10 pr-10 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ request('searchCategory') }}"
                            >
                            @if(request('searchCategory'))
                                <a href="{{ route('dashboard') }}" class="absolute right-3 text-gray-400 hover:text-gray-600">
                                    <i class="fa-solid fa-xmark"></i>
                                </a>
                            @endif
                        </div>
                    </form>
                    <div class="overflow-x-auto rounded-lg">
                        <table class="w-full border-collapse text-sm sm:text-base">
                            <thead>
                                <tr class="bg-blue-200 text-center">
                                    <th class="px-4 py-2">Name</th>
                                    <th class="px-4 py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $categori)
                                    <tr class="text-center hover:bg-gray-100 border-b">
                                        <td class="px-4 py-2">{{ $categori->name }}</td>
                                        <td class="px-4 py-2 flex flex-row justify-center space-x-2">
                                            <button @click="
                                                selectedCategori = {
                                                    id: '{{ $categori->id }}',
                                                    name: '{{ $categori->name }}'
                                                };
                                                openCategoryModal = true;
                                                " class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded"><i class="fa-duotone fa-regular fa-pen-to-square"></i></button>
                                            <button @click="deleteModalcat = true; deleteId = {{ $categori->id }}; deleteType = 'categori'" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-6">
                            {{ $category->appends(['category_page' => request('category_page')])->links('vendor.pagination.simple-tailwind') }}
                        </div>
                    </div>
                </div>

                <!-- Bidang Table -->
                <div class="md:col-span-1 bg-white shadow-md rounded-lg p-6"> 
                    <form action="{{ route('dashboard') }}" method="GET" class="mb-4 flex justify-between items-center gap-2">
                        <span class="text-2xl text-blue-700 font-semibold">Bidang</span>
                        <div class="relative flex items-center w-80 border border-gray-300 rounded-lg shadow-sm">
                            <i class="fa-solid fa-magnifying-glass text-gray-400 absolute left-3"></i>
                            <input 
                                type="text" 
                                name="searchBidang" 
                                placeholder="Cari Bidang..." 
                                class="w-full pl-10 pr-10 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ request('searchBidang') }}"
                            >
                            @if(request('searchBidang'))
                                <a href="{{ route('dashboard') }}" class="absolute right-3 text-gray-400 hover:text-gray-600">
                                    <i class="fa-solid fa-xmark"></i>
                                </a>
                            @endif
                        </div>
                    </form>
                    <div class="overflow-x-auto rounded-lg">
                        <table class="w-full border-collapse text-sm sm:text-base">
                            <thead>
                                <tr class="bg-blue-200 text-center">
                                    <th class="px-4 py-2">Name</th>
                                    <th class="px-4 py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bidangs as $bidang)
                                    <tr class="text-center hover:bg-gray-100 border-b">
                                        <td class="px-4 py-2">{{ $bidang->name }}</td>
                                        <td class="px-4 py-2 flex flex-row justify-center space-x-2">
                                            <button @click="
                                                selectedBidang = {
                                                    id: '{{ $bidang->id }}',
                                                    name: '{{ $bidang->name }}'
                                                };
                                                openBidangModal = true;
                                                " class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded"><i class="fa-duotone fa-regular fa-pen-to-square"></i></button>
                                            <button @click="deleteModalbid = true; deleteId = {{ $bidang->id }}; deleteType = 'bidang'" class="px-3 py-1 bg-red-500 hover:bg-red-700 text-white rounded"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-6">
                            {{ $bidangs->appends(['bidang_page' => request('bidang_page')])->links('vendor.pagination.simple-tailwind') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- EDIT AREA -->

        <!-- MODAL EDIT CLIENT -->
        <div x-show="openEditClientModal" 
            x-cloak
            @keydown.escape.window="openEditClientModal = false"
            class="fixed inset-0 flex justify-center items-center bg-gray-900 bg-opacity-50 backdrop-blur-sm z-50 transition-opacity duration-300"
            @click.self="openEditClientModal = false">

            <!-- MODAL BOX -->
            <div x-show="openEditClientModal"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-10"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-10"
                class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg relative z-50">
                
                <!-- Tombol Close -->
                <button @click="openEditClientModal = false" class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 transition">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>      

                <h3 class="text-lg font-semibold mb-4">Edit Client</h3>
                <form :action="'{{ url('/clients') }}/' + (selectedClient.id || '{{ old('id') }}')" method="POST">
                    @csrf
                    @method('PUT')
        
                    <!-- ID tetap ada setelah validasi gagal -->
                    <input type="hidden" name="id" x-model="selectedClient.id" value="{{ old('id') }}">
                    <div class="mb-4">
                        <label class="block text-gray-700">Client Full Name</label>
                        <input type="text" name="full_name" 
                            x-model="selectedClient.full_name" 
                            value="{{ old('full_name') }}" 
                            class="w-full border p-2 rounded-lg" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Client Short Name</label>
                        <input type="text" name="short_name" 
                            x-model="selectedClient.short_name" 
                            value="{{ old('short_name') }}" 
                            class="w-full border p-2 rounded-lg" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" @click="openEditClientModal = false" class="px-4 py-2 bg-gray-400 text-white rounded-lg mr-2 transition hover:bg-gray-500">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg transition hover:bg-blue-600" :disabled="!selectedClient.id">
                            Save
                        </button>                        
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL EDIT PROVINCE -->
        <div x-show="openProvinceModal" 
            x-cloak
            @keydown.escape.window="openProvinceModal = false"
            class="fixed inset-0 flex justify-center items-center bg-gray-900 bg-opacity-50 backdrop-blur-sm z-50 transition-opacity duration-300"
            @click.self="openProvinceModal = false">

            <!-- MODAL BOX -->
            <div x-show="openProvinceModal"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-10"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-10"
                class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg relative z-50">
                
                <!-- Tombol Close -->
                <button @click="openProvinceModal = false" class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 transition">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>   

                <h3 class="text-lg font-semibold mb-4">Edit Province</h3>
        
                <form :action="'{{ url('/provinces') }}/' + (selectedProvince.id || '{{ old('id') }}')" method="POST">
                    @csrf
                    @method('PUT')
        
                    <!-- ID tetap ada setelah validasi gagal -->
                    <input type="hidden" name="id" x-model="selectedProvince.id" value="{{ old('id') }}">
                    <div class="mb-4">
                        <label class="block text-gray-700">Client Full Name</label>
                        <input type="text" name="name" 
                            x-model="selectedProvince.name" 
                            value="{{ old('name') }}" 
                            class="w-full border p-2 rounded" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" @click="openProvinceModal = false" class="px-4 py-2 bg-gray-400 text-white rounded mr-2">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded" :disabled="!selectedProvince.id">
                            Save
                        </button>                        
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL EDIT CATEGORY -->
        <div x-show="openCategoryModal" 
            x-cloak
            @keydown.escape.window="openCategoryModal = false"
            class="fixed inset-0 flex justify-center items-center bg-gray-900 bg-opacity-50 backdrop-blur-sm z-50 transition-opacity duration-300"
            @click.self="openCategoryModal = false">

            <!-- MODAL BOX -->
            <div x-show="openCategoryModal"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-10"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-10"
                class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg relative z-50">
                
                <!-- Tombol Close -->
                <button @click="openCategoryModal = false" class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 transition">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>

                <h3 class="text-lg font-semibold mb-4">Edit Category</h3>
        
                <form :action="'{{ url('/categories') }}/' + (selectedCategori.id || '{{ old('id') }}')" method="POST">
                    @csrf
                    @method('PUT')
        
                    <!-- ID tetap ada setelah validasi gagal -->
                    <input type="hidden" name="id" x-model="selectedCategori.id" value="{{ old('id') }}">
                    <div class="mb-4">
                        <label class="block text-gray-700">Client Full Name</label>
                        <input type="text" name="name" 
                            x-model="selectedCategori.name" 
                            value="{{ old('name') }}" 
                            class="w-full border p-2 rounded" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" @click="openCategoryModal = false" class="px-4 py-2 bg-gray-400 text-white rounded mr-2">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded" :disabled="!selectedCategori.id">
                            Save
                        </button>                        
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL EDIT BIDANG -->
        <div x-show="openBidangModal" 
            x-cloak
            @keydown.escape.window="openBidangModal = false"
            class="fixed inset-0 flex justify-center items-center bg-gray-900 bg-opacity-50 backdrop-blur-sm z-50 transition-opacity duration-300"
            @click.self="openBidangModal = false">

            <!-- MODAL BOX -->
            <div x-show="openBidangModal"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-10"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-10"
                class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg relative z-50">
                
                <!-- Tombol Close -->
                <button @click="openBidangModal = false" class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 transition">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>

                <h3 class="text-lg font-semibold mb-4">Edit Category</h3>
        
                <form :action="'{{ url('/bidangs') }}/' + (selectedBidang.id || '{{ old('id') }}')" method="POST">
                    @csrf
                    @method('PUT')
        
                    <!-- ID tetap ada setelah validasi gagal -->
                    <input type="hidden" name="id" x-model="selectedBidang.id" value="{{ old('id') }}">
                    <div class="mb-4">
                        <label class="block text-gray-700">Client Full Name</label>
                        <input type="text" name="name" 
                            x-model="selectedBidang.name" 
                            value="{{ old('name') }}" 
                            class="w-full border p-2 rounded" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" @click="openBidangModal = false" class="px-4 py-2 bg-gray-400 text-white rounded mr-2">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded" :disabled="!selectedBidang.id">
                            Save
                        </button>                        
                    </div>
                </form>
            </div>
        </div>

        
        <!-- DELETE AREA -->


        <!-- MODAL DELETE CLIENT -->
        <div x-show="deleteModalclient" 
            x-cloak
            @keydown.escape.window="deleteModalclient = false"
            class="fixed inset-0 flex justify-center items-center bg-gray-900 bg-opacity-50 backdrop-blur-sm z-50 transition-opacity duration-300"
            @click.self="deleteModalclient = false">

            <!-- MODAL BOX -->
            <div x-show="deleteModalclient"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-10"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-10"
                class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg relative z-50">
                
                <!-- Tombol Close -->
                <button @click="deleteModalclient = false" class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 transition">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>

                @if(isset($clients) && $clients->isNotEmpty())
                    <h3 class="text-lg font-semibold mb-4 text-center">Are you sure?</h3>
                    <p class="text-gray-700 text-center mb-4">You won't be able to revert this action!</p>

                    <!-- Countdown text (disembunyikan dulu) -->
                    <p class="text-red-500 text-center hidden countdown-text"></p>

                    <div class="flex justify-center space-x-4 mt-4">
                        <!-- Cancel button -->
                        <button @click="deleteModalclient = false" class="cancel-button px-4 py-2 bg-gray-400 text-white rounded">
                            Cancel
                        </button>
                        <form id="deleteFormClient" x-bind:action="'/clients/' + deleteId" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" id="deleteButtonClient" class="delete-button px-4 py-2 bg-red-500 text-white rounded">
                                Delete
                            </button>
                        </form>                              
                    </div>
                @else
                    <p class="text-gray-500 text-center mt-4">Tidak ada data yang bisa dihapus.</p>
                @endif
            </div>
        </div>

        <!-- MODAL DELETE PROVINCE -->
        <div x-show="deleteModalprov" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96" @click.away="deleteModalprov = false">
                @if(isset($provinces) && $provinces->isNotEmpty())
                    <h3 class="text-lg font-semibold mb-4 text-center">Are you sure?</h3>
                    <p class="text-gray-700 text-center mb-4">You won't be able to revert this action!</p>

                    <!-- Countdown text (disembunyikan dulu) -->
                    <p class="text-red-500 text-center hidden countdown-text"></p>

                    <div class="flex justify-center space-x-4 mt-4">
                        <!-- Cancel button -->
                        <button @click="deleteModalprov = false" class="cancel-button px-4 py-2 bg-gray-400 text-white rounded">
                            Cancel
                        </button>
                        <form id="deleteFormProvince" action="{{ route('province.destroy', $province->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" id="deleteButtonProvince" class="delete-button px-4 py-2 bg-red-500 text-white rounded">
                                Delete
                            </button>
                        </form>                                    
                    </div>
                @else
                    <p class="text-gray-500 text-center mt-4">Tidak ada data yang bisa dihapus.</p>
                @endif
            </div>
        </div>

        <!-- MODAL DELETE CATEGORY -->
        <div x-show="deleteModalcat" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96" @click.away="deleteModalcat = false">
                @if(isset($category) && $category->isNotEmpty())
                    <h3 class="text-lg font-semibold mb-4 text-center">Are you sure?</h3>
                    <p class="text-gray-700 text-center mb-4">You won't be able to revert this action!</p>

                    <!-- Countdown text (disembunyikan dulu) -->
                    <p class="text-red-500 text-center hidden countdown-text"></p>

                    <div class="flex justify-center space-x-4 mt-4">
                        <!-- Cancel button -->
                        <button @click="deleteModalcat = false" class="cancel-button px-4 py-2 bg-gray-400 text-white rounded">
                            Cancel
                        </button>
                        <form id="deleteFormCategory" action="{{ route('categorie.destroy', $categori->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" id="deleteButtonCategory" class="delete-button px-4 py-2 bg-red-500 text-white rounded">
                                Delete
                            </button>
                        </form>                                    
                    </div>
                @else
                    <p class="text-gray-500 text-center mt-4">Tidak ada data yang bisa dihapus.</p>
                @endif
            </div>
        </div>

        <!-- MODAL DELETE BIDANG -->
        <div x-show="deleteModalbid" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96" @click.away="deleteModalbid = false">
                @if(isset($bidangs) && $bidangs->isNotEmpty())
                    <h3 class="text-lg font-semibold mb-4 text-center">Are you sure?</h3>
                    <p class="text-gray-700 text-center mb-4">You won't be able to revert this action!</p>

                    <!-- Countdown text (disembunyikan dulu) -->
                    <p class="text-red-500 text-center hidden countdown-text"></p>

                    <div class="flex justify-center space-x-4 mt-4">
                        <!-- Cancel button -->
                        <button @click="deleteModalbid = false" class="cancel-button px-4 py-2 bg-gray-400 text-white rounded">
                            Cancel
                        </button>
                        <form id="deleteFormBidang" action="{{ route('bidang.destroy', $bidang->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" id="deleteButtonBidang" class="delete-button px-4 py-2 bg-red-500 text-white rounded">
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

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

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
                    let countdown = 10;
    
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
        });
    </script>
</x-app-layout>
