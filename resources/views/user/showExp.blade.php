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
                    <a href="{{ route('experiences.view') }}" class="text-gray-700 font-semibold hover:text-blue-500 transition duration-200">Experiences</a>
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

    <div class="mt-8 mb-8 font-semibold text-center text-4xl lg:text-6xl text-transparent bg-clip-text bg-gradient-to-br from-[#232963] via-[#2C347D] to-[#6370E9] fade-in-up font-[Inter]">
        @if($experiences->image)
            <div class="relative w-full h-80 md:h-[500px] rounded-lg overflow-hidden shadow-xl">
                <img src="{{ asset($experiences->image) }}" alt="{{ $experiences->title }}" class="w-full h-full object-cover transform transition duration-500 hover:scale-110">
                <div class="absolute inset-0 bg-black bg-opacity-60 flex flex-col justify-center items-center p-8">
                    <h1 class="text-white text-5xl md:text-6xl font-extrabold text-center drop-shadow-lg">{{ $experiences->title }}</h1>
                </div>
            </div>
        @else
            <h2 class="font-semibold text-3xl md:text-4xl text-gray-800 leading-tight text-center py-8 border-b-4 border-gray-400 w-max mx-auto">
                {{ $experiences->title }}
            </h2>
        @endif
    </div>

    <!-- Main Content -->
    <div class="py-10 px-6 sm:px-8 lg:px-12 max-w-7xl mx-auto fade-in-up">
        <div class="grid grid-cols-1 md:grid-cols-1 gap-10">
            <!-- Container Detail Experience (2/3) -->
            <div class="bg-white shadow-lg rounded-xl p-12">
                <h2 class="text-3xl font-bold  hidden mb-6 text-gray-900">Detail Experience</h2>
                
                <div class="mb-6 text-lg text-gray-700">
                    <p><strong>Client:</strong> {{ $experiences->client->full_name ?? 'Tidak tersedia' }}</p>
                    <p><strong>Provinsi:</strong> {{ $experiences->province->name ?? 'Tidak tersedia' }}</p>
                    <p><strong>Bidang:</strong> {{ $experiences->bidang->name ?? 'Tidak tersedia' }}</p>
                </div>

                <div class="text-gray-800 trix-content leading-relaxed text-justify text-lg">
                    {!! $experiences->desc !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Other Experiences Section -->
    <div class="py-10 px-6 sm:px-8 lg:px-12 max-w-7xl mx-auto fade-in-up">
        <h3 class="text-2xl font-bold mb-6 text-black">Other Experiences</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @php
                $combinedExperiences = collect($relatedExperiences)->take(4);
                if ($combinedExperiences->count() < 4) {
                    $remaining = 4 - $combinedExperiences->count();
                    $randomToAdd = $randomExperiences->take($remaining);
                    $combinedExperiences = $combinedExperiences->merge($randomToAdd);
                }
            @endphp

            @foreach($combinedExperiences as $experience)
                <a href="{{ route('detail.experiences', $experience->id) }}" class="block transform transition duration-300 hover:scale-105">
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                        <h5 class="font-bold text-lg mb-2 text-gray-900  line-clamp-2 break-words">{{ $experience->title }}</h5>
                        <p class="text-gray-600 text-sm"><strong>Client:</strong> {{ $experience->client->short_name ?? 'Tidak tersedia' }}</p>
                        <p class="text-gray-600 text-sm mb-4"><strong>Provinsi:</strong> {{ $experience->province->name ?? 'Tidak tersedia' }}</p>
                    </div>
                </a>
            @endforeach
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

    <!-- Back to List (Floating Button) -->
    <div class="fixed bottom-6 left-6 md:bottom-8 md:left-8 fade-in-up">
        <a href="{{ route('experiences.view') }}" class="px-5 py-3 bg-gradient-to-r from-[#313989] to-[#6370E9] text-white rounded-full shadow-lg 
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
    </script>
    <style>
        /* Styling for trix-editor content */
        trix-editor, trix-editor .trix-content {
            text-align: justify !important;
        }

        /* Styling for images in figure */
        .trix-content figure,
        .trix-content figure img {
            display: block !important;
            margin-left: auto !important;
            margin-right: auto !important;
            max-width: 80% !important;
            height: auto !important;
            text-align: center !important;
        }

        /* Hide figure captions */
        .trix-content figure figcaption {
            display: none !important;
        }
    </style>
</body>
</html>