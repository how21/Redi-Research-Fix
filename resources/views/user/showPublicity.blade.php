<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicity</title>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" as="style">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
                    <a href="{{ route('experiences.view') }}" class="text-gray-700 hover:text-blue-500 transition duration-200">Experiences</a>
                    <a href="{{ route('publicity.view') }}" class="text-gray-700 font-semibold hover:text-blue-500 transition duration-200">Publicity</a>
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
    fade-in-up">Publicity
    </div>

    <!-- Main Content -->

    <div class="py-6 px-4 sm:px-6 lg:px-8 fade-in-up">
        <div class="max-w-full mx-auto rounded-lg p-6 grid grid-cols-1 gap-6">
            <!-- Detail Journal Container -->
            <div class="mb-6 bg-white shadow-2xl p-8 rounded-2xl flex flex-col justify-between min-h-[400px] border border-gray-200">
                <div>
                    <h3 class="text-3xl font-extrabold text-gray-900 mb-6 leading-tight">{{ $journals->title }}</h3>
                    <div class="text-gray-700 text-sm md:text-base space-y-2">
                        <p><strong>📖 Authors:</strong> {{ $journals->authors }}</p>
                        <p><strong>📅 Publication Year:</strong> {{ $journals->publication_year }}</p>
                        <p><strong>🏢 Publisher:</strong> {{ $journals->publisher }}</p>
                    </div>
            
                    <div class="flex justify-between items-center mt-4">
                        <p class="text-gray-600"><strong>🔗 DOI:</strong> 
                            <a href="{{ $journals->doi }}" class="text-blue-600 font-semibold hover:underline" target="_blank">
                                {{ $journals->doi }}
                            </a>
                        </p>
                        @if($journals->file_path)
                            <a href="{{ asset('storage/' . $journals->file_path) }}" target="_blank" class="px-5 py-2 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 transition">
                                <i class=" fa-regular fa-file-pdf fa-2x"></i>
                            </a>
                        @endif
                    </div>
            
                    <hr class="my-6 border-gray-300">
            
                    <p class="text-lg font-semibold text-gray-700">Abstract:</p>
                    <p class="text-gray-900 mt-4 text-justify leading-relaxed">{{ $journals->abstract }}</p>
            
                    <hr class="my-6 border-gray-300">
            
                    <div class="flex flex-wrap gap-2 mt-2">
                        <p class="text-gray-600 text-lg font-semibold">🔑 Keywords:</p>
                        @php
                            $keywords = is_array($journals->keyword) ? $journals->keyword : json_decode($journals->keyword, true);
                        @endphp
                        @foreach($keywords ?? [] as $tag)
                            <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-medium shadow-md">
                                {{ trim($tag) }}
                            </span>
                        @endforeach                                        
                    </div> 
                </div>               
            </div>                           
    
            <!-- Other Journals (Updated Design) -->
            <div class="mb-6 p-6 rounded-lg">
                <h3 class="text-2xl font-semibold mb-4">Other Journals</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($randomJournals as $randomJournal)
                        @if($randomJournal->id !== $journals->id)
                            <a href="{{ route('detail.jurnal', $randomJournal->id) }}" class="block">
                                <div class="flex flex-col bg-white p-6 rounded-2xl shadow-lg transform transition-all hover:scale-105 hover:shadow-xl group border border-gray-300 cursor-pointer">
                                    <h4 class="text-xl font-bold text-gray-900 group-hover:text-blue-500 transition line-clamp-2 break-words leading-snug">
                                        {{ $randomJournal->title }}
                                    </h4>
                                    <p class="text-sm text-gray-500 mt-2 truncate">{{ $randomJournal->authors }}</p>
                                    <p class="text-sm text-gray-500 mt-2">📅 Published: {{ $randomJournal->publication_year }}</p>
            
                                    <div class="flex flex-wrap gap-2 mt-3 w-full overflow-hidden">
                                        @php
                                            $keywords = is_array($randomJournal->keyword) ? $randomJournal->keyword : json_decode($randomJournal->keyword, true);
                                            $tagCount = count($keywords);
                                        @endphp
                                        @foreach($keywords as $index => $tag)
                                            @if($index < 3)
                                                <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-medium max-w-[120px] truncate">
                                                    {{ trim($tag) }}
                                                </span>
                                            @endif
                                        @endforeach
                                        @if($tagCount > 3)
                                            <span class="text-gray-600 text-xs max-w-[120px]">+ {{ $tagCount - 3 }} more</span>
                                        @endif
                                    </div>                                
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
    <!-- Contact Us -->
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

    <!-- Back to List (Floating Button) -->
    <div class="fixed bottom-6 left-6 md:bottom-8 md:left-8 fade-in-up">
        <a href="{{ route('publicity.view') }}" class="px-5 py-3 bg-gradient-to-r from-[#313989] to-[#6370E9] text-white rounded-full shadow-lg 
            hover:from-[#232963] hover:to-[#2C347D] transition duration-300 flex items-center gap-2">
            ⬅ Back to List
        </a>
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

    function clearSearch() {
            // Clear the search input value
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.value = '';
            }
    
            // Redirect to the journal index page without the search query
            window.location.href = "{{ route('publicity.view') }}"; // Adjust as necessary
        }
    </script>
</body>
</html>