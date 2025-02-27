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
    <div class=" mt-8 mb-8 font-semibold text-center text-4xl lg:text-6xl text-transparent bg-clip-text bg-gradient-to-br from-[#232963] via-[#2C347D] to-[#6370E9]
    fade-in-up">Code of Conduct
    </div>
    <!-- Main COntent -->
    <div class="bg-gradient-to-br from-white to-gray-300 rounded-[5vw] mx-8 md:mx-24 mb-8 fade-in-up"
    style="box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.5);">
    <div class="font-semibold text-justify ml-8 mr-8 mb-4 mt-8 text-sm md:text-lg">REDI obligates all team personnel to obey six main ethical codes during the implementation of an ongoing project,
        i.e.: intellectual property rights, confidentiality, no bribery act, child protection policy, and COVID-19 safety protocol.</div>
        <ul class="list-disc pl-5 text-justify mr-8 ml-8 mb-16 font-semibold text-sm md:text-lg">
            <li class="mb-2">
                <strong>Intellectual Property Rights.</strong> REDI understands that the client has the right to collect all data obtained from the data collection process, and REDI should keep the data until the period stated on the contract. 
                Therefore, all data collected by the field team at the field should be delivered to the REDI office and they should keep a copy of the files (if any) for the data cleaning process only until the Study Manager contacts them and instructs them to delete the files. 
                When keeping the files on their computer, the field team should not distribute/use/give access to the data to others for any reason and usage. REDI understands to keep the hard copy of the filled instruments (if any) during the period stated in the contract.  
            </li>
            <li>
                <strong>Confidentiality.</strong> All respondents and key resources of the study are confidential, including all Personal Identifiable Information (PII) of the participating key resources. 
                Their identity is confidential, and the use of the identity and any picture taken from the process should get permission from the key resources by signing the consent. 
            </li>
            <li class="mb-2">
                <strong>No Bribery Act.</strong> To obtain good and qualified data in the field, objectiveness during the data collection process is an obligation. 
                All field team personnel should pose themselves as professional researchers and should not accept any gift/reward in the form of money, in-kind, 
                or souvenirs from key resources that may produce unfair and non-objective data. 
                Field team personnel must sign a form of agreement for the no-bribery act during field data collection. 
            </li>
            <li class="mb-2">
                <strong>Child Protection Policy.</strong> During the data collection process, the field team commonly builds interaction with children, both when the child is becoming a respondent and/or as part of the community to interact with. 
                Field team personnel must comply with the child protection policy that ensures there is no child abuse, harassment, or exploitation. Field team personnel must sign a form of child protection agreement during field data collection.
            </li>
            <li class="mb-2">
                <strong>Obligation to Respect Women’s Rights.</strong> REDI believes in women’s and men’s equal rights in the workplace and during the project implementation. 
                REDI emphasizes that all women must be treated with full respect and dignity. REDI obligates all personnel not to make any type of sexual harassment to women colleagues and source persons. 
                REDI also emphasizes that both women and men employees must be protected from gender-based discrimination and harassment in the workplace and during the project implementation.
            </li>
            <li>
                <strong>Compliance with Health Protocol.</strong> During the COVID-19 pandemic in Indonesia, REDI developed a safety protocol guidance to undertake the data collection process in the field. 
                The guidance states the guideline for field team personnel when interacting with other team members at the base camp, with the respondent, and other protocols in line with the protocol stated by the Ministry of Health of the Government of Indonesia. 
            </li>
        </ul>
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
                <p class="text-sm">Instagram: <a href="https://www.instagram.com/redi.research/" class="text-[#FDEB00] hover:underline" target="_blank">@redi.research</a></p>
                <p class="text-sm">Facebook: <a href="https://www.facebook.com/share/158k3pDTgS/" class="text-[#FDEB00] hover:underline" target="_blank">@redi research</a></p>
                <p class="text-sm">Twitter: <a href="https://x.com/rediresearch" class="text-[#FDEB00] hover:underline" target="_blank">@rediresearch</a></p>
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
    </script>
</body>
</html>