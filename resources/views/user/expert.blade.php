<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Experiences</title>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" as="style">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <style>
        @keyframes fadeInUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        .fade-in-up {
            animation: fadeInUp 1s ease-in-out forwards;
        }
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow-x: hidden;
            font-family: 'Roboto', sans-serif;
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
    </style>
</head>
<body class="bg-gradient-to-b from-white to-blue-100">
    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-300 sticky top-0 z-50 shadow-md">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="hidden md:block">
                    <img src="{{ asset('assets/logo transparan.png') }}" alt="Logo" class="h-5"> 
                </a>
                <button id="menu-toggle" class="md:hidden text-gray-700 focus:outline-none">
                    &#9776; <!-- Hamburger icon -->
                </button>
            </div>
            <div class="flex-grow text-center">
                <div class="flex flex-col md:flex-row justify-center gap-4 md:gap-12 md:flex" id="menu">
                    <a href="{{ url('/home') }}" class="text-gray-700 hover:text-blue-500 transition duration-200">Home</a>
                    <a href="{{ route('gallery.view') }}" class="text-gray-700 hover:text-blue-500 transition duration-200">Gallery</a>
                    <a href="{{ route('experiences.view') }}" class="font-semibold text-gray-700 hover:text-blue-500 transition duration-200">Experiences</a>
                    <a href="{{ route('publicity.view') }}" class="text-gray-700 hover:text-blue-500 transition duration-200">Publicity</a>
                </div>
            </div>
        </div>
    </nav>

    <script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
        const menu = document.getElementById('menu');
        menu.classList.toggle('hidden'); // Toggle the hidden class
        
        // Smooth transition for opacity
        if (menu.classList.contains('hidden')) {
            menu.style.opacity = '0'; // Hide menu
            setTimeout(() => {
                menu.style.display = 'none'; // Remove from flow
            }, 300); // Match this duration with the transition duration
        } else {
            menu.style.display = 'flex'; // Show menu
            setTimeout(() => {
                menu.style.opacity = '1'; // Show with opacity
            }, 10); // Short delay to apply opacity
        }
    });
    </script>

    <div class=" mt-8 mb-8 font-semibold text-center text-4xl lg:text-6xl text-transparent bg-clip-text bg-gradient-to-br from-[#232963] via-[#2C347D] to-[#6370E9]
    fade-in-up">Experiences
    </div>

    <!-- Main Content -->
    <div class="py-6 px-4 sm:px-6 lg:px-8 fade-in-up">
        <div class="gap-6">
            <div class="sm:flex-row justify-between items-center mb-4">
                
                <form action="{{ route('experiences.view') }}" method="GET" class="mb-4 mt-4 flex flex-col sm:flex-row justify-between items-center gap-2">
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
                            <a href="{{ route('experiences.view') }}" class="absolute right-3 text-gray-400 hover:text-gray-600">
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
            @if($experiences->count() > 0)
                <!-- Articles Grid Container -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($experiences as $experience)
                        <a href="{{ route('detail.experiences', $experience->id) }}" 
                        class="bg-gradient-to-b from-white to-blue-50 rounded-lg shadow-md overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-lg block">
                            
                            <!-- Image -->
                            @if($experience->image)
                                <img src="{{ asset($experience->image) }}" 
                                    alt="Gambar Experience" 
                                    class="w-full h-56 object-cover">
                            @else
                                <div class="w-full h-56 bg-gray-200 flex items-center justify-center text-gray-500">
                                    No Image
                                </div>
                            @endif

                            <!-- Content -->
                            <div class="p-5">
                                <h4 class="text-xl font-bold text-gray-900 line-clamp-2 break-words" style="font-family: 'Poppins', sans-serif;">
                                    {{ $experience->title }}
                                </h4>
                                
                                <p class="mt-2 text-gray-700 text-sm" style="font-family: 'Inter', sans-serif;">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($experience->content), 150) }}
                                </p>

                                <!-- Info -->
                                <div class="mt-4 p-3 rounded-lg text-gray-600 text-sm">
                                    <p class="flex items-center gap-2">
                                        <i class="fa-sharp fa-solid fa-circle-user text-gray-500"></i> 
                                        <span class="font-medium">{{ optional($experience->client)->full_name ?? 'Unknown' }}</span>
                                    </p>
                                    <p class="flex items-center gap-2 mt-1">
                                        <i class="fas fa-map-marker-alt text-red-500"></i> 
                                        <span class="font-medium">{{ optional($experience->province)->name ?? 'Unknown' }}</span>
                                    </p>
                                    <p class="flex items-center gap-2 mt-1">
                                        <i class="fas fa-briefcase text-blue-500"></i> 
                                        <span class="font-medium">{{ optional($experience->bidang)->name ?? 'Unknown' }}</span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $experiences->appends(request()->query())->links('vendor.pagination.default') }}
                </div>
            @else
                <p class="text-gray-500">Belum ada artikel yang tersedia.</p>
            @endif
        </div>


        </div>
    </div>

    <!-- Footer & Contact Us -->
    <div class="px-10 py-4 bg-gradient-to-t from-[#313989] to-[#3C46A9]"> 
        <h1 class="element-to-animate text-4xl md:text-6xl font-semibold text-center text-transparent bg-clip-text bg-gradient-to-b from-white to-gray-400 mt-12">Contact Us</h1>
        <div class="element-to-animate text-white flex flex-col md:flex-row gap-4 md:gap-8">
            <div class="text-justify md:basis-1/2 md:ml-12 mb-4 md:mb-12">
                <h2 class="text-lg md:text-2xl font-bold pt-12 mb-4">REDI Research</h2>
                <p class="text-sm">Jl. Arief Rahman Hakim No. 152, Galaxy Bumi Permai Bl N3,<br> Surabaya 60111 - East Java - Indonesia</p>
                <p class="text-sm">Phone: +62 31 592 3001</p>
                <p class="text-sm">Fax: +62 31 591 3735</p>
                <p class="text-sm">Mobile Phone: +62 813 21 05 01</p>
                <p class="text-sm">Website: <a href="http://www.redi.or.id" class="text-[#FDEB00] hover:underline">www.redi.or.id</a></p>
                <p class="text-sm">Email: <a href="mailto:redi@redi.or.id" class="text-[#FDEB00] hover:underline">redi@redi.or.id</a></p>
            </div>
            <div class="text-justify md:basis-1/2 md:ml-80">
                <h2 class="text-lg md:text-2xl font-bold pt-12 mb-4">Connect with Us</h2>
                <p class="text-sm">Instagram: <a href="https://www.instagram.com/redi.research/" class="text-[#FDEB00] hover:underline">@redi.research</a></p>
                <p class="text-sm">Facebook: <a href="https://www.facebook.com/share/158k3pDTgS/" class="text-[#FDEB00] hover:underline">redi research</a></p>
                <p class="text-sm">Twitter: <a href="https://x.com/rediresearch" class="text-[#FDEB00] hover:underline">rediresearch</a></p>
            </div>
        </div>
    </div>
    
    <!-- All rights reserved -->
    <div class="px-10 py-2 bg-gradient-to-b from-gray-700 to-gray-800">
        <h1 class="text-center text-white text-[9px] md:text-lg">Regional Economic Development Institute (REDI), 2025 - All Rights Reserved</h1>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const elements = document.querySelectorAll('.element-to-animate');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in-up'); // Add animation class
                    observer.unobserve(entry.target); // Stop observing after animation
                }
            });
        }, { threshold: 0.3 }); // Trigger when 10% of the element is visible

        elements.forEach(element => {
            observer.observe(element); // Start observing each element
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
    </script>
</body>
</html>