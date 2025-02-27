<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REDI - Code of Conduct</title>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" as="style">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <style>
            @keyframes fadeInUp {
                from {
                    transform: translateY(20px); /* Start slightly below */
                    opacity: 0; /* Start transparent */
                }
                to {
                    transform: translateY(0); /* End at its original position */
                    opacity: 1; /* End fully visible */
                }
            }

            .fade-in-up {
                animation: fadeInUp 1s ease-in-out forwards;
                opacity: 1; /* Ensure the element is visible when the animation starts */
            }

            .fade-in-up-delayed {
                animation: fadeInUp 1s ease-in-out forwards;
                animation-delay: 2s; /* Add delay before the animation starts */
                opacity: 1; /* Ensure the element is visible when the animation starts */
            }

            .element-to-animate,
            .element-to-animate-left {
                opacity: 0; /* Initially hidden */
                transition: visibility 0s linear 1s, opacity 1s linear; /* Transition for smooth appearance */
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
                <a href="{{ url('/home') }}" class="hidden md:block">
                    <img src="{{ asset('assets/logo transparan.png') }}" alt="Logo" class="h-5"> 
                </a>
                <button id="menu-toggle" class="md:hidden text-gray-700 focus:outline-none">
                    &#9776; <!-- Hamburger icon -->
                </button>
            </div>
            <div class="flex-grow text-center">
                <div class="flex flex-col md:flex-row justify-center gap-4 md:gap-12 md:flex" id="menu">
                    <a href="{{ route('home.view') }}" class="text-gray-700 hover:text-blue-500 transition duration-200">Home</a>
                    <a href="{{ route('gallery.view') }}" class="text-gray-700 font-semibold hover:text-blue-500 transition duration-200">Gallery</a>
                    <a href="{{ route('experiences.view') }}" class="text-gray-700 hover:text-blue-500 transition duration-200">Experiences</a>
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

    <!-- Title -->
    <div class=" mt-10 mb-8 font-semibold text-center text-4xl lg:text-6xl text-transparent bg-clip-text bg-gradient-to-br from-[#232963] via-[#2C347D] to-[#6370E9]
    fade-in-up">Gallery
    </div>
    
    <!-- Main COntent -->

    <div class="container mx-auto px-4 py-8 fade-in-up mb-16">
        <div x-data="sliderComponent()" x-init="startAutoSlide()" class="relative w-full h-[80vh] overflow-hidden rounded-lg shadow-lg">
            <!-- Gambar Slider -->
            <template x-for="(image, index) in images" :key="index">
                <img :src="image" 
                    alt="Gallery Image" 
                    class="absolute inset-0 w-full h-full object-cover transition-opacity duration-700 ease-in-out"
                    :class="{ 'opacity-0 scale-95': index !== currentIndex, 'opacity-100 scale-100': index === currentIndex }">
            </template>

            <!-- Overlay -->
            <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col items-center justify-center text-white text-center">
                <h1 class="text-5xl md:text-7xl font-extrabold tracking-wide drop-shadow-xl font-serif">REDI in Motion</h1>
                <p class="text-xl mt-3 drop-shadow-lg font-light italic">Embracing moments, inspiring the future</p>
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
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                @forelse($categories as $category)
                    <a href="{{ route('categorie.view', $category->id) }}" class="relative group block">
                        <img src="{{ optional($category->albums->first())->image ? asset('storage/' . $category->albums->first()->image) : 'https://via.placeholder.com/400x300' }}" 
                            alt="Category Image" class="w-full h-64 object-cover rounded-lg shadow-lg transition-transform duration-500 group-hover:scale-90">
                        <div class="absolute inset-0 bg-black bg-opacity-50 group-hover:bg-opacity-70 flex items-center justify-center transition-all rounded-lg">
                            <h4 class="text-white text-sm font-bold tracking-wide font-serif">{{ $category->name }}</h4>
                        </div>
                    </a>
                @empty
                    <p class="text-gray-500 text-center text-base font-medium italic">Belum ada kategori yang tersedia.</p>
                @endforelse
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
</body>
</html>