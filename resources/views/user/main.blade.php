<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regional Economic Development Institute</title>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" as="style">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
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

    @keyframes fadeInLeft {
        from {
            transform: translateX(20px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

        .fade-in-left {
        animation: fadeInLeft 1s ease-in-out forwards;
        opacity: 1; /* Ensure the element is visible when the animation starts */
    }

    .fade-in-left-delayed {
        animation: fadeInLeft 1s ease-in-out forwards;
        animation-delay: 2s; /* Add delay before the animation starts */
        opacity: 1; /* Ensure the element is visible when the animation starts */
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
        height: 100%; /* Ensure full height */
        overflow-x: hidden; /* Prevent horizontal overflow */
        font-family: 'Roboto', sans-serif;
    }

    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh; /* Ensure body fills the viewport */
    }

    .count-item {
        opacity: 0; /* Hidden initially */
        transform: translateY(20px); /* Upward effect */
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }

    .count-item.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .slide-container {
        border-radius: 5vw;
        margin: 1rem auto;
        width: 80%;
        height: 80vh;
        aspect-ratio: 16 / 9; /* Maintain a 16:9 aspect ratio */
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.5);
    }
    .slide-container img {
        width: 100%;
        height: 100%; /* Cover the container */
        object-fit: cover; /* Maintain aspect ratio and cover */
        border-radius: 5vw;
    }
    .hidden {
        display: none;
    }
    .slide-title {
        font-size: 5rem;
        line-height: 1.2;
        text-align: center;
        margin: 0.5rem 0;
    }
    .pillar-box {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
    }

    .pillar-box img {
        transition: opacity 0.3s;
        object-fit: cover;
    }

    .pillar-box:hover {
        box-shadow: 0px 10px 100px rgba(0, 0, 0, 0.5);
    }

    .pillar-box:hover h3 {
        opacity: 1;
    }

    .pillar-box:hover img {
        opacity: 0.6;
    }
    .swiper-navigation {
        position: absolute;
        top: 50%;
        width: 100%;
        display: flex;
        justify-content: center; /* Membagi ruang antara tombol */
        transform: translateY(-50%);
    }

    .swiper-button-next,
    .swiper-button-prev {
        margin: 0 1rem; /* Margin horizontal untuk tombol */
        cursor: pointer;
    }

    /* Media Queries untuk Responsivitas */
@media (max-width: 768px) {
    .swiper-navigation {
        padding: 0 0.5rem; /* Kurangi padding pada layar lebih kecil */
    }

    .swiper-button-next,
    .swiper-button-prev {
        margin: 0 0.5rem; /* Kurangi margin pada layar lebih kecil */
    }

    .apexcharts-xaxis-label {
        font-size: 10px;
    }

    .apexcharts-yaxis-label {
        font-size: 10px;
    }

    .slide-container {
        aspect-ratio: 4 / 3;
        height: auto; /* Adjust height for smaller screens */
    }

    .slide-title {
        font-size: 4rem; /* Ukuran untuk tablet */
    }

    .text-6xl {
        font-size: 3rem; /* Adjust heading size */
    }

    .text-4xl {
        font-size: 2rem; /* Adjust slogan size */
    }

    .count-item {
        font-size: 2.5rem; /* Adjust counts size */
    }

    .pillar-box {
        width: 80%; /* Make pillars stack on smaller screens */
        margin: 0 auto; /* Center align */
    }

    .flex-grow {
        flex-basis: 100%;
    }
}

    /* Media Queries */
    @media (max-width: 480px) {
        .swiper-navigation {
            flex-direction: column; /* Ubah arah menjadi kolom pada ponsel */
            align-items: center; /* Pusatkan tombol secara horizontal */
        }

        .swiper-button-next,
        .swiper-button-prev {
            margin: 0.5rem 0; /* Margin vertikal untuk tombol */
        }

        .slide-title {
            font-size: 2.5rem; /* Ukuran untuk ponsel */
        }

        .text-6xl {
            font-size: 2.5rem; /* Further adjust for mobile */
        }

        .text-4xl {
            font-size: 1.5rem; /* Further adjust for mobile */
        }
    }
        </style>
</head>
<body class="bg-gray-200">
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
                    <a href="{{ route('home.view') }}" class="font-semibold text-gray-700 hover:text-blue-500 transition duration-200">Home</a>
                    <a href="{{ route('gallery.view') }}" class="text-gray-700 hover:text-blue-500 transition duration-200">Gallery</a>
                    <a href="{{ route('experiences.view') }}" class="text-gray-700 hover:text-blue-500 transition duration-200">Experiences</a>
                    <a href="{{ route('publicity.view') }}" class="text-gray-700 hover:text-blue-500 transition duration-200">Publicity</a>
                </div>
            </div>
        </div>
    </nav>

<!-- Container Slider -->
<div class="relative w-full h-full bg-transparent">
    <div class="relative w-full">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide mb-8">
                    <div class="slide-container bg-gradient-to-br from-[#232963] via-[#2C347D] to-[#6370E9] fade-in-up">
                        <h1 class="slide-title text-white text-center">Regional Economic <br> Development Institute</h1>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="swiper-slide mb-8">
                    <div class="slide-container">
                        <img src="{{ asset('images/slide2.jpg') }}" alt="Slide 2">
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="swiper-slide mb-8">
                    <div class="slide-container">
                        <img src="{{ asset('images/slide3.jpg') }}" alt="Slide 3">
                    </div>
                </div>
                <!-- Slide 4 -->
                <div class="swiper-slide mb-8">
                    <div class="slide-container">
                        <img src="{{ asset('images/slide4.jpg') }}" alt="Slide 4">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- About US -->
    <div class="container mx-auto flex flex-col lg:flex-row gap-4 element-to-animate">
        <div class="flex justify-center items-center basis-full lg:basis-1/2">
            <div id="pie" class="bg-white rounded-[5vw] md:rounded-[3vw] w-auto md:w-96 lg:w-full mx-auto p-4" style="box-shadow: 0px 5px 10px rgba(0,0,0,0.5);">
                <!-- Pie Chart -->
            </div>
        </div>        
        <!-- Slogan -->
        <div class="flex flex-col basis-full lg:basis-1/2 mx-4">
            <div style="box-shadow: 0px 5px 50px rgba(0, 0, 0, 0.5);" class="bg-white rounded-[5vw] md:rounded-[2vw] h-16 w-full mb-4 flex items-center justify-center">
                <h2 class="text-2xl md:text-3xl text-transparent bg-clip-text bg-gradient-to-r from-[#232963] from-0% via-[#2C347D] via-50% to-[#6370E9] to-100% font-semibold">
                    Smart, Excellent, Trusted
                </h2>
            </div>
            <!-- Project counter -->
            <div style="box-shadow: 0px 5px 50px rgba(0, 0, 0, 0.5);" class="bg-gradient-to-tl from-[#232963] via-[#2C347D] to-[#6370E9] text-white rounded-[5vw] md:rounded-[2vw] w-full h-52 flex items-center justify-center">
                <div class="flex flex-col md:flex-row justify-around w-full px-2">
                    <div class="flex flex-col items-center mb-4">
                        <div id="projects" class="text-6xl md:text-7xl font-bold count-item text-transparent bg-clip-text bg-gradient-to-b from-white from-35% to-gray-500 to-100%" data-target="{{ $totalProjects }}" data-animated="false">0</div>
                        <div class="text-center text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-300 text-xl md:text-2xl">Projects</div>
                    </div>
                    <div class="flex flex-col items-center mb-4">
                        <div id="clients" class="text-6xl md:text-7xl font-bold count-item text-transparent bg-clip-text bg-gradient-to-b from-gray-200 from-35% to-gray-500 to-100%" data-target="{{ $totalClients }}" data-animated="false">0</div>
                        <div class="text-center text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-300 text-xl md:text-2xl">Clients</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Graph Section -->
    <div class="mb-4 mt-8 text-center text-4xl md:text-5xl font-semibold text-transparent bg-clip-text bg-gradient-to-bl from-[#232963] via-[#2C347D] to-[#6370E9]">
        Our Projects
    </div>

    <div id="graph" style="box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.5);"
        class="element-to-animate mx-8 md:mx-4 mb-8 opacity-1 transition-opacity duration-700 rounded-[5vw] md:rounded-[3vw]">
    </div>



<!-- Focus Pillars -->
    <div id="about_us" 
        class="mx-8 md:mx-4 mb-4 px-10 py-4 bg-gradient-to-br from-[#232963] via-[#2C347D] to-[#6370E9] rounded-[5vw] md:rounded-[2vw]">
        <div class="font-semibold text-transparent bg-clip-text bg-gradient-to-br from-white from-20% to-gray-400 to-80% text-center text-3xl md:text-5xl">
            Our Focus Pillars
        </div>
    </div>

    <div class="mx-8 md:mx-4 mb-4 rounded-[2vw] element-to-animate">
        <div class="flex flex-col md:flex-row justify-around gap-4 md:gap-2">
            <!-- Pillar 1 -->
            <div class="bg-gradient-to-b from-white from-10% to-gray-200 to-75% rounded-[5vw] md:rounded-[1vw] p-4 w-full md:w-1/5 pillar-box"
                style="box-shadow: 0px 5px 50px rgba(0, 0, 0, 0.5);">
                <img src="{{ asset('images/pillar1.jpg') }}" alt="Pillar 1" class="w-full h-32 object-cover rounded-[5vw] md:rounded-[1vw] mb-2 transition-opacity duration-300">
                <h3 class="text-center text-lg font-semibold opacity-0 transition-opacity duration-300">Large-scale Data Collection</h3>
            </div>
            <!-- Pillar 2 -->
            <div class="bg-gradient-to-b from-white from-10% to-gray-200 to-75% rounded-[5vw] md:rounded-[1vw] p-4 w-full md:w-1/5 pillar-box"
                style="box-shadow: 0px 5px 50px rgba(0, 0, 0, 0.5);">
                <img src="{{ asset('images/pillar2.jpg') }}" alt="Pillar 2" class="w-full h-32 object-cover rounded-[5vw] md:rounded-[1vw] mb-2 transition-opacity duration-300">
                <h3 class="text-center text-lg font-semibold opacity-0 transition-opacity duration-300">Research and Studies</h3>
            </div>
            <!-- Pillar 3 -->
            <div class="flex flex-col items-center bg-gradient-to-b from-white from-10% to-gray-200 to-75% rounded-[5vw] md:rounded-[1vw] p-4 w-full md:w-1/5 pillar-box"
                style="box-shadow: 0px 5px 50px rgba(0, 0, 0, 0.5);">
                <img src="{{ asset('images/pillar3.jpg') }}" alt="Pillar 3" class="w-full h-32 object-cover rounded-[5vw] md:rounded-[1vw] mb-2 transition-opacity duration-300">
                <h3 class="text-center text-lg font-semibold opacity-0 transition-opacity duration-300">Training</h3>
            </div>
            <!-- Pillar 4 -->
            <div class="flex flex-col items-center bg-gradient-to-b from-white from-10% to-gray-200 to-75% rounded-[5vw] md:rounded-[1vw] p-4 w-full md:w-1/5 pillar-box"
                style="box-shadow: 0px 5px 50px rgba(0, 0, 0, 0.5);">
                <img src="{{ asset('images/pillar4.jpg') }}" alt="Pillar 4" class="w-full h-32 object-cover rounded-[5vw] md:rounded-[1vw] mb-2 transition-opacity duration-300">
                <h3 class="text-center text-lg font-semibold opacity-0 transition-opacity duration-300">Capacity Development</h3>
            </div>
            <!-- Pillar 5 -->
            <div class="flex flex-col items-center bg-gradient-to-b from-white from-10% to-gray-200 to-75% rounded-[5vw] md:rounded-[1vw] p-4 w-full md:w-1/5 pillar-box"
                style="box-shadow: 0px 5px 50px rgba(0, 0, 0, 0.5);">
                <img src="{{ asset('images/pillar5.jpg') }}" alt="Pillar 5" class="w-full h-32 object-cover rounded-[5vw] md:rounded-[1vw] mb-2 transition-opacity duration-300">
                <h3 class="text-center text-lg font-semibold opacity-0 transition-opacity duration-300">Digital Data Collection</h3>
            </div>
        </div>
    </div>


    <!-- About Us -->

    <div id="about_us" 
        style="box-shadow: 0px 5px 50px rgba(0, 0, 0, 0.5);" 
        class="element-to-animate mx-8 lg:mx-4 mt-8 mb-8 px-6 lg:px-10 py-4 rounded-[5vw] md:rounded-[3vw] bg-gradient-to-b from-white -from-5% to-gray-300 to-100%">
        <div class="mb-4 font-semibold text-transparent bg-clip-text bg-gradient-to-br from-[#232963] to-[#6370E9] text-center text-4xl lg:text-5xl"
            style="text-shadow: 0px 50px 100px rgba(0, 0, 0, 0.5);">
            About Us
        </div>
        
        <p class="text-justify text-sm lg:text-base indent-8">
            Regional Economic Development Institute (REDI) is a leading independent research institution established in Surabaya on May 21, 2001. REDI has more than twenty-two years of experience in conducting studies, data collection activities, training, and capacity building for governments, international agencies, and private sectors.
        </p>

        <!-- Read More Button for Mobile -->
        <button id="read-more-btn" class="text-blue-500 hover:underline mb-2 lg:hidden">
            Read More
        </button>

        <!-- Hidden Paragraphs -->
        <div id="more-info" class="hidden lg:block">
            <p class="text-justify text-sm lg:text-base indent-8">
                For the national institutions, REDI has conducted studies with Bank Indonesia & its Branch Offices in Surabaya, Ambon, Jember, and Papua; the Coordinating Ministry of Economic Affairs (CMEA), and some local governments in Indonesia including the East Java & West Nusa Tenggara Provincial Governments. For the international agencies, REDI has worked for The World Bank, United States Agency for International Development (USAID), The Asia Foundation (TAF), Japan Bank for International Cooperation (JBIC), Department of Foreign Affairs and Trade (DFAT) – Australian Aid, Asian Development Bank (ADB), International Finance Corporation (IFC), Deutsche Gesellschaft für Technische Zusammenarbeit (GTZ) known as Deutsche Gesellschaft für Internationale Zusammenarbeit (GIZ), International Labour Organization (ILO), European Union (EU) Commission, PT. Palladium International, and JBS International.
            </p>
            <p class="text-justify text-sm lg:text-base indent-8 mb-4">
                REDI has strong experience and expertise in conducting data collection across provinces and districts in Indonesia on various study topics, i.e.: education, social, finance and banking, trade, IT, and risk mitigation. REDI has the capacity to undertake quantitative data collection techniques, including the PAPI data collection (using paper-based instruments) and CAPI (using the digital program) also, using applications such as: KOBO, SurveyCTO Collect, or its own designed digital program (web-based program). For qualitative data collection, REDI has the experience to undertake in-depth interviews and focus group discussions (FGD). In terms of managing a large number of personnel deployments and data management, in 2016, REDI conducted field work by deploying more than 200 field personnel to undertake nearly 60,000 data from more than 40,000 respondents.
            </p>
        </div>
    </div>



        <!-- VISION MISSION -->
    <div class="container mx-auto mb-4 flex flex-col lg:flex-row">
        <div class="flex flex-col basis-full md:basis-1/2 mx-8 md:mx-4">
            <div style="box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.5);" class="element-to-animate rounded-[5vw] md:rounded-[2vw] h-auto w-full mb-4 bg-gradient-to-br from-white to-gray-300">
                <h1 class="text-3xl font-semibold text-transparent bg-clip-text bg-gradient-to-b from-[#232963] via-[#2C347D] to-[#6370E9] text-center mt-4">Our Vision</h1>
                <p class="text-center text-md md:text-lg mx-4 mt-4 mb-12">Our vision is to become the most smart, excellent, and trusted research institution in Indonesia and beyond.</p>
            </div>
            <div style="box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.5);" class="element-to-animate rounded-[5vw] md:rounded-[2vw] h-full w-full bg-gradient-to-br from-white to-gray-300">
                <h1 class="text-3xl font-semibold text-transparent bg-clip-text bg-gradient-to-b from-[#232963] via-[#2C347D] to-[#6370E9] text-center mt-4 mb-8">Our Mission</h1>
                <p class="text-center mb-4 mx-4"><strong>Smart</strong> <br> REDI adopts good practices in data collection activities, adopts the latest technology, and applies a <a href="{{ url('conduct') }}" class="text-blue-500 hover:underline" target="_blank">code of ethics</a> during the project implementation.</p>
                <p class="text-center mb-4 mx-4"><strong>Excellent</strong> <br>Through experienced team and data management, and therefore REDI produces excellent data on client requests.</p>
                <p class="text-center mb-4 mx-4"><strong>Trusted</strong> <br>By applying clear procedure, REDI collects Accurate, Correct, and Consistent (ACC) data.</p>
            </div>
        </div>
        <div class="hidden lg:block basis-full md:basis-1/2 mx-4 md:mx-4 element-to-animate-left delayed">
            <div class="bg-white rounded-[3vw] h-full w-full overflow-hidden" style="box-shadow: 0px 5px 10px rgba(0,0,0,0.5);">
                <img src="{{ asset('assets/fotoredi.png') }}" class="w-full h-full object-cover" alt="">
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
        // Navbar
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

    // // Chart
    
    var project = @json($projectsByCategory);
    
    // Ekstrak labels dan series dari data
    var labels = project.map(function(item) {
        return item.bidang ? item.bidang.name : 'Tanpa Kategori';
    });
    
    var series = project.map(function(item) {
        return item.total;
    });

    // Konfigurasi chart
    var options = {
        series: series,
        chart: {
            type: 'pie',
            width: 420, // Default width for larger screens (laptops)
        },
        labels: labels,
        responsive: [
            {
                breakpoint: 1024, // For laptops and larger screens
                options: {
                    chart: {
                        width: 380, // Set specific width for laptops
                    },
                    legend: {
                        position: 'right', // Keep legend on the right for larger screens
                    },
                },
            },
            {
                breakpoint: 768, // For tablets
                options: {
                    chart: {
                        width: '100%', // Use full width on tablets
                    },
                    legend: {
                        position: 'bottom', // Position legend below the chart
                    },
                },
            },
            {
                breakpoint: 480, // For mobile devices
                options: {
                    chart: {
                        width: '100%', // Use full width on mobile devices
                    },
                    legend: {
                        position: 'bottom', // Position legend below the chart
                    },
                },
            },
        ],
    };

    // Membuat chart
    var chart = new ApexCharts(document.querySelector("#pie"), options);        
    // Intersection Observer for animation
    var observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                chart.render();
                observer.unobserve(entry.target); // Stop observing after rendering
            }
        });
    }, { threshold: 0.8 });

    observer.observe(document.querySelector("#pie"));
    
    // COUNTER
    function animateCount(element, startNumber, targetNumber) {
        let current = startNumber;
        const increment = Math.ceil(targetNumber / 100);
        
        const interval = setInterval(() => {
            current += increment;
            if (current >= targetNumber) {
                current = targetNumber;
                clearInterval(interval);
            }
            element.textContent = current;
        }, 20);
    }

    function observeCounts() {
        const counters = document.querySelectorAll(".count-item");
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const counter = entry.target;
                const targetValue = parseInt(counter.dataset.target, 10);
                const startValue = counter.id === "projects" ? 70 : parseInt(counter.textContent, 10); // Mulai dari 50 jika id adalah "projects"

                // Cek jika elemen masuk viewport dan belum dianimasikan
                if (!isNaN(targetValue) && entry.isIntersecting && counter.dataset.animated === "false") {
                    counter.dataset.animated = "true"; // Tandai bahwa animasi sudah berjalan
                    counter.classList.add("visible");
                    animateCount(counter, startValue, targetValue);
                }
            });
        }, { threshold: 0.6 });

        counters.forEach(counter => {
            counter.dataset.animated = "false"; // Set flag awal agar bisa dikontrol
            observer.observe(counter);
        });
    }

    document.addEventListener("DOMContentLoaded", observeCounts);

    // Read More
    document.getElementById('read-more-btn').addEventListener('click', function() {
        const moreInfo = document.getElementById('more-info');
            if (moreInfo.classList.contains('hidden')) {
                moreInfo.classList.remove('hidden'); // Show the paragraphs
                    this.textContent = 'See Less'; // Change button text
                } else {
                moreInfo.classList.add('hidden'); // Hide the paragraphs
                    this.textContent = 'Read More'; // Reset button text
                }
            });

        
        // Grafik
        document.addEventListener("DOMContentLoaded", function () {
        // Ambil data dari PHP
        const projectData = @json($projectsByYear); // Pastikan ini dihasilkan di server
        let years = projectData.map(item => item.year);
        let totals = projectData.map(item => item.total); // Misalnya, menggunakan total project sebagai data

        function renderChart() {
            var options = {
                chart: {
                    type: "line",
                    height: 400,
                    zoom: {
                        enabled: false
                    },
                    animations: {
                        enabled: false
                    }
                },
                series: [{
                    name: "Projects",
                    data: [] // Start with empty data for animation
                }],
                xaxis: {
                    categories: years,
                    labels: { 
                        rotate: -45,
                        style: {
                            fontSize: '12px' // Ukuran font default untuk label x-axis
                        }
                    },
                },
                yaxis: {
                    min: 0,
                    max: 20,
                    tickAmount: 5,
                    labels: {
                        formatter: function (val) {
                            return Math.round(val);
                        },
                        style: {
                            fontSize: '12px' // Ukuran font default untuk label y-axis
                        }
                    }
                },
                stroke: {
                    curve: "straight",
                    width: 3
                },
                markers: {
                    size: 5
                },
                colors: ["#3C46A9"],
                tooltip: { 
                    enabled: true,
                    y: {
                        formatter: (val) => Math.round(val)
                    }    
                }
            };

            var chart = new ApexCharts(document.querySelector("#graph"), options);
            chart.render();

            // Gradual Data Function
            function animateChart() {
                let currentData = [];
                let index = 0;

                function updateChart() {
                    if (index < totals.length) {
                        currentData.push(totals[index]);
                        chart.updateSeries([{ name: "Projects", data: currentData }]);
                        index++;
                        requestAnimationFrame(updateChart);
                    }
                }
                updateChart();
            }

            // Intersection Observer to detect when the graph comes into view
            const graphElement = document.querySelector("#graph");
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateChart(); // Start animation if the chart is in view
                        observer.unobserve(graphElement); // Stop observing after animation starts
                    }
                });
            }, { threshold: 0.5 });

            observer.observe(graphElement); // Start observing the graph
        }

        renderChart(); // Panggil fungsi untuk merender grafik
    });

        // Swiper
        var swiper = new Swiper (".mySwiper", {
            loop: true,
            autoplay: {
                delay:5000,
                disableOnInteraction:false,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            effect: "slide",
        });

        
        // FadeinUp
        document.addEventListener("DOMContentLoaded", function () {
        const elements = document.querySelectorAll('.element-to-animate');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in-up'); // Add animation class
                    observer.unobserve(entry.target); // Stop observing after animation
                }
            });
        }, { threshold: 0.6 }); // Trigger when 10% of the element is visible

        elements.forEach(element => {
            observer.observe(element); // Start observing each element
        });
    });
    // FadeinLeft
    document.addEventListener("DOMContentLoaded", function () {
        const elements = document.querySelectorAll('.element-to-animate-left');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in-left'); // Add animation class
                    observer.unobserve(entry.target); // Stop observing after animation
                }
            });
        }, { threshold: 0.6 }); // Trigger when 10% of the element is visible

        elements.forEach(element => {
            observer.observe(element); // Start observing each element
        });
    });
    </script>
</body>
</html>