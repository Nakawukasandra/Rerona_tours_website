<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Explore our stunning gallery of Uganda safari adventures, wildlife photography, and breathtaking landscapes from our tours.">
    <title>Gallery - Rerona Safari Tours</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Custom scrollbar for gallery */
        .gallery-scroll::-webkit-scrollbar {
            width: 8px;
        }
        .gallery-scroll::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        .gallery-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        .gallery-scroll::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Image loading animation */
        .image-loading {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* Smooth transitions */
        .gallery-item {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            overflow: hidden;
        }

        .gallery-item:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .gallery-item img {
            transition: transform 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        /* Full screen overlay styles */
        .fullscreen-overlay {
            backdrop-filter: blur(10px);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 50;
            background: rgba(0, 0, 0, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .fullscreen-image {
            max-width: 90vw;
            max-height: 90vh;
            object-fit: contain;
        }

        /* Navigation background image */
        .nav-bg {
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60"><g fill-opacity="0.05"><circle cx="30" cy="30" r="20" fill="%23059669"/><path d="M10 10h10v10H10zM40 40h10v10H40z" fill="%23059669"/><path d="M30 5l5 5-5 5-5-5zM30 45l5 5-5 5-5-5z" fill="%23059669"/></g></svg>');
            background-size: 60px 60px;
            background-repeat: repeat;
            background-attachment: scroll;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">

    <!-- Main Navigation Header -->
    <header class="bg-white shadow-sm sticky top-0 z-40 nav-bg">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-4">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="h-10 w-10 bg-green-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-lg">R</span>
                    </div>
                    <div class="text-xl font-bold text-gray-800">Rerona Safari Tours</div>
                </div>

                <!-- Main Navigation -->
                <nav class="hidden lg:flex items-center space-x-8">
                    <a href="/" class="text-gray-600 hover:text-blue-600 transition-colors font-medium">Home</a>
                    <a href="/tours" class="text-gray-600 hover:text-blue-600 transition-colors font-medium">Tours</a>
                    <a href="/booking" class="text-gray-600 hover:text-blue-600 transition-colors font-medium">Booking</a>
                    <a href="/destination" class="text-gray-600 hover:text-blue-600 transition-colors font-medium">Destination</a>

                    <!-- Pages Dropdown -->
                    <div class="relative group">
                        <button class="text-gray-600 hover:text-blue-600 transition-colors font-medium flex items-center space-x-1">
                            <span>Pages</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="absolute top-full left-0 mt-1 w-48 bg-white rounded-lg shadow-lg border opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <a href="/about" class="block px-4 py-2 text-gray-600 hover:text-blue-600 hover:bg-gray-50">About Us</a>
                            <a href="/contact" class="block px-4 py-2 text-gray-600 hover:text-blue-600 hover:bg-gray-50">Contact Us</a>
                            <a href="/faqs" class="block px-4 py-2 text-gray-600 hover:text-blue-600 hover:bg-gray-50">FAQs</a>
                            <a href="/gallery" class="block px-4 py-2 text-gray-600 hover:text-blue-600 hover:bg-gray-50">Gallery</a>
                        </div>
                    </div>

                    <a href="/blog" class="text-gray-600 hover:text-blue-600 transition-colors font-medium">Blog</a>
                    <a href="/services" class="text-gray-600 hover:text-blue-600 transition-colors font-medium">Our Services</a>
                    <a href="/shop" class="text-gray-600 hover:text-blue-600 transition-colors font-medium">Shop</a>
                </nav>

                <!-- Right Side Actions -->
                <div class="flex items-center space-x-4">
                    <!-- Menu Toggle -->
                    <button class="p-2 text-gray-600 hover:text-blue-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <!-- Cart with Badge -->
                    <div class="relative">
                        <button class="p-2 text-gray-600 hover:text-blue-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.293 2.293c-.195.195-.195.512 0 .707L6.414 17.707A1 1 0 007.828 18H19M7 13v4a2 2 0 002 2h8a2 2 0 002-2v-4m-8 6v-6"/>
                            </svg>
                        </button>
                        <span class="absolute -top-1 -right-1 h-5 w-5 bg-blue-600 text-white text-xs rounded-full flex items-center justify-center">0</span>
                    </div>

                    <!-- Mobile Menu Button -->
                    <button class="lg:hidden p-2 text-gray-600 hover:text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Gallery Content -->
    <main class="min-h-screen py-8">
        <div class="container mx-auto px-4">
            <!-- Gallery Title -->
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Gallery</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    This is sample of gallery excerpt and you can set it up using gallery option
                </p>
            </div>

            <!-- Gallery Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Row 1 -->
                <div class="gallery-item rounded-lg shadow-md hover:shadow-lg" onclick="openLightbox('https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')">
                    <img src="/images/trips/murchison.jpg"
                         alt="Murchison Falls waterfall"
                         class="w-full h-64 object-cover rounded-lg"
                         loading="lazy">
                </div>

                <div class="gallery-item rounded-lg shadow-md hover:shadow-lg" onclick="openLightbox('https://images.unsplash.com/photo-1549366021-9f761d040a94?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')">
                    <img src="/images/gallery/animals1.jpg"
                         alt="Safari vehicle on African savanna"
                         class="w-full h-64 object-cover rounded-lg"
                         loading="lazy">
                </div>

                <div class="gallery-item rounded-lg shadow-md hover:shadow-lg" onclick="openLightbox('https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')">
                    <img src="/images/destinations/fort-portal.jpg"
                         alt="African sunset landscape"
                         class="w-full h-64 object-cover rounded-lg"
                         loading="lazy">
                </div>

                <div class="gallery-item rounded-lg shadow-md hover:shadow-lg" onclick="openLightbox('https://images.unsplash.com/photo-1564760055775-d63b17a55c44?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')">
                    <img src="/images/gallery/antelope.jpg"
                         alt="Antelope in natural habitat"
                         class="w-full h-64 object-cover rounded-lg"
                         loading="lazy">
                </div>

                <!-- Row 2 -->
                <div class="gallery-item rounded-lg shadow-md hover:shadow-lg" onclick="openLightbox('https://images.unsplash.com/photo-1551632811-561732d1e306?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')">
                    <img src="/images/gallery/nature1.jpg"
                         alt="African elephants"
                         class="w-full h-64 object-cover rounded-lg"
                         loading="lazy">
                </div>

                <div class="gallery-item rounded-lg shadow-md hover:shadow-lg" onclick="openLightbox('https://images.unsplash.com/photo-1518709268805-4e9042af2176?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')">
                    <img src="/images/gallery/lions.jpg"
                         alt="Lions in African wilderness"
                         class="w-full h-64 object-cover rounded-lg"
                         loading="lazy">
                </div>

                <div class="gallery-item rounded-lg shadow-md hover:shadow-lg" onclick="openLightbox('https://images.unsplash.com/photo-1546026423-cc4642628d2b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')">
                    <img src="/images/gallery/landscape1.jpg"
                         alt="Giraffe silhouette at sunset"
                         class="w-full h-64 object-cover rounded-lg"
                         loading="lazy">
                </div>

                <div class="gallery-item rounded-lg shadow-md hover:shadow-lg" onclick="openLightbox('https://images.unsplash.com/photo-1544735716-392fe2489ffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')">
                    <img src="/images/gallery/plans.jpg"
                         alt=" African plains"
                         class="w-full h-64 object-cover rounded-lg"
                         loading="lazy">
                </div>

                <!-- Row 3 - Additional Safari Images -->
                <div class="gallery-item rounded-lg shadow-md hover:shadow-lg" onclick="openLightbox('https://images.unsplash.com/photo-1554995207-c18c203602cb?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')">
                    <img src="/images/gallery/chimpanzees.jpg"
                         alt="Chimpanzees in forest"
                         class="w-full h-64 object-cover rounded-lg"
                         loading="lazy">
                </div>

                <div class="gallery-item rounded-lg shadow-md hover:shadow-lg" onclick="openLightbox('https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')">
                    <img src="/images/gallery/baboons.jpg"
                         alt="Baboons in natural habitat"
                         class="w-full h-64 object-cover rounded-lg"
                         loading="lazy">
                </div>

                <div class="gallery-item rounded-lg shadow-md hover:shadow-lg" onclick="openLightbox('https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')">
                    <img src="/images/gallery/africanland.jpg"
                         alt="African landscape aerial view"
                         class="w-full h-64 object-cover rounded-lg"
                         loading="lazy">
                </div>

                <div class="gallery-item rounded-lg shadow-md hover:shadow-lg" onclick="openLightbox('https://images.unsplash.com/photo-1539650116574-75c0c6d73a0e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')">
                    <img src="/images/gallery/safari2.jpg"
                         alt="Safari tourists on adventure"
                         class="w-full h-64 object-cover rounded-lg"
                         loading="lazy">
                </div>

                <!-- Row 4 - More Wildlife -->
                <div class="gallery-item rounded-lg shadow-md hover:shadow-lg" onclick="openLightbox('https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')">
                    <img src="/images/gallery/zebras.jpg"
                         alt="Zebras drinking water"
                         class="w-full h-64 object-cover rounded-lg"
                         loading="lazy">
                </div>

                <div class="gallery-item rounded-lg shadow-md hover:shadow-lg" onclick="openLightbox('https://images.unsplash.com/photo-1597655601841-214a4cfe8b2c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')">
                    <img src="/images/gallery/leopard.jpg"
                         alt="Leopard in tree"
                         class="w-full h-64 object-cover rounded-lg"
                         loading="lazy">
                </div>

                <div class="gallery-item rounded-lg shadow-md hover:shadow-lg" onclick="openLightbox('https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')">
                    <img src="/images/gallery/dining.jpg"
                         alt="Safari dining experience"
                         class="w-full h-64 object-cover rounded-lg"
                         loading="lazy">
                </div>

                <div class="gallery-item rounded-lg shadow-md hover:shadow-lg" onclick="openLightbox('https://images.unsplash.com/photo-1527118732049-c88155f2107c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')">
                    <img src="/images/gallery/africanwildlife.jpg"
                         alt="African wildlife scene"
                         class="w-full h-64 object-cover rounded-lg"
                         loading="lazy">
                </div>
            </div>
        </div>
    </main>

 <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <!-- About Us Section -->
                <div x-data="{ expanded: false }">
                    <div class="flex justify-center mb-6">
                        <a href="/">
                            <img src="/images/logo.png" alt="Rorena Tours" class="h-20 w-20 rounded-full">
                        </a>
                    </div>
                    <h4 class="flex justify-center mb-4">About us</h4>
                    <p class="text-gray-400 mb-6">
                        Rorena Tours and Safaris is a small-medium sized equipped, experienced licensed tours and safari company based in Kampala, Uganda.
                        <button @click="expanded = !expanded" class="inline-flex items-center ml-1 text-green-400 hover:text-green-300 transition-colors">
                            <svg class="w-4 h-4" :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <span x-show="expanded" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                            We offer quality, exceptional, affordable, bespoke, deluxe and luxury of highest tours to Uganda and the entire of East African countries with a personal touch. We organize authentic individual as well as group tours.
                        </span>
                    </p>
                </div>

                <!-- Contact Info Section -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">Contact Info</h4>
                    <ul class="space-y-4 text-gray-400">
                        <li class="flex items-center">
                            <span class="mr-3">📞</span>
                            <a href="tel:+256800500000" class="hover:text-white transition-colors">+256-800500000</a>
                        </li>
                        <li class="flex items-center">
                            <span class="mr-3">📍</span>
                            <span>Kikumbi, Wakiso Uganda</span>
                        </li>
                        <li class="flex items-center">
                            <span class="mr-3">🕒</span>
                            <span>Mon - Sat 8.00 - 18.00 Sunday CLOSED</span>
                        </li>
                    </ul>

                    <!-- Social Media Icons -->
                    <div class="flex space-x-3 mt-6">
                        <a href="https://facebook.com/rorenatours" target="_blank" class="bg-blue-600 p-2 rounded-full hover:bg-blue-700">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M20 10C20 4.477 15.523 0 10 0S0 4.477 0 10c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V10h2.54V7.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V10h2.773l-.443 2.89h-2.33v6.988C16.343 19.128 20 14.991 20 10z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a href="https://twitter.com/rorenatours" target="_blank" class="bg-blue-400 p-2 rounded-full hover:bg-blue-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84"></path>
                            </svg>
                        </a>
                        <a href="https://youtube.com/rorenatours" target="_blank" class="bg-red-600 p-2 rounded-full hover:bg-red-700">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a href="https://instagram.com/rorenatours" target="_blank" class="bg-purple-600 p-2 rounded-full hover:bg-purple-700">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Gallery Section -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">Gallery</h4>
                    <div class="grid grid-cols-3 gap-2">
                        <a href="/gallery">
                            <img src="/images/gallery/safari1.jpg" alt="Safari" class="w-full h-20 object-cover rounded hover:opacity-80 transition-opacity">
                        </a>
                        <a href="/gallery">
                            <img src="/images/gallery/gorilla2.jpg" alt="Gorilla" class="w-full h-20 object-cover rounded hover:opacity-80 transition-opacity">
                        </a>
                        <a href="/gallery">
                            <img src="/images/gallery/landscape1.jpg" alt="Landscape" class="w-full h-20 object-cover rounded hover:opacity-80 transition-opacity">
                        </a>
                        <a href="/gallery">
                            <img src="/images/gallery/safari2.jpg" alt="Safari" class="w-full h-20 object-cover rounded hover:opacity-80 transition-opacity">
                        </a>
                        <a href="/gallery">
                            <img src="/images/gallery/animals1.jpg" alt="Animals" class="w-full h-20 object-cover rounded hover:opacity-80 transition-opacity">
                        </a>
                        <a href="/gallery">
                            <img src="/images/gallery/nature1.jpg" alt="Nature" class="w-full h-20 object-cover rounded hover:opacity-80 transition-opacity">
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="border-t border-gray-700 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">© Copyright Rorena Tours and Safaris 2021</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="/" class="text-gray-400 hover:text-white text-sm">Home</a>
                    <a href="/tours" class="text-gray-400 hover:text-green-400 text-sm">Tours</a>
                    <a href="/blog" class="text-gray-400 hover:text-white text-sm">Blog</a>
                    <a href="/services" class="text-gray-400 hover:text-white text-sm">Our services</a>
                </div>
            </div>
        </div>
    </footer>


    <!-- Lightbox Modal (Initially Hidden) -->
    <div id="lightbox" class="fullscreen-overlay hidden" onclick="closeLightbox()">
        <div class="relative">
            <img id="lightbox-image" src="" alt="" class="fullscreen-image">
            <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white bg-black bg-opacity-50 rounded-full w-10 h-10 flex items-center justify-center hover:bg-opacity-75 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <script>
        // Image lazy loading optimization
        document.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('img[loading="lazy"]');

            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.classList.remove('image-loading');
                            observer.unobserve(img);
                        }
                    });
                });

                images.forEach(img => imageObserver.observe(img));
            }

            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeLightbox();
                }
            });
        });

        // Lightbox functionality
        function openLightbox(imageSrc) {
            const lightbox = document.getElementById('lightbox');
            const lightboxImage = document.getElementById('lightbox-image');
            lightboxImage.src = imageSrc;
            lightbox.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Load more functionality
        document.querySelector('.bg-blue-600').addEventListener('click', function() {
            // Simulate loading more images
            const gallery = document.querySelector('.grid');
            const newImages = [
                'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1566992103-9f57c067da47?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1559827260-dc66d52bef19?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1534759926787-89b5c8fa7ff4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ];

            newImages.forEach((src, index) => {
                const div = document.createElement('div');
                div.className = 'gallery-item rounded-lg shadow-md hover:shadow-lg';
                div.onclick = () => openLightbox(src);

                const img = document.createElement('img');
                img.src = src;
                img.alt = `Additional safari image ${index + 1}`;
                img.className = 'w-full h-64 object-cover rounded-lg';
                img.loading = 'lazy';

                div.appendChild(img);
                gallery.appendChild(div);
            });

            // Hide button after loading
            this.style.display = 'none';
        });
    </script>
</body>
</html>
