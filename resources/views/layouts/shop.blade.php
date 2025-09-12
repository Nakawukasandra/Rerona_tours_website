<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Shop - Rorena Tours & Safari' }}</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="{{ $metaDescription ?? 'Browse our collection of authentic African crafts, safari gear, and memorable souvenirs from Rorena Tours & Safari.' }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'african crafts, safari gear, souvenirs, shop, rorena tours, uganda tours' }}">
    <meta name="author" content="Rorena Tours & Safari">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $title ?? 'Shop - Rorena Tours & Safari' }}">
    <meta property="og:description" content="{{ $metaDescription ?? 'Browse our collection of authentic African crafts, safari gear, and memorable souvenirs.' }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? 'Shop - Rorena Tours & Safari' }}">
    <meta name="twitter:description" content="{{ $metaDescription ?? 'Browse our collection of authentic African crafts and safari gear.' }}">
    <meta name="twitter:image" content="{{ asset('images/logo.png') }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Configure Tailwind -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'green': {
                            600: '#059669',
                            700: '#047857',
                            400: '#34d399'
                        }
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Livewire Styles -->
    @livewireStyles

    <!-- Custom Styles for Shop -->
    <style>
        .shop-card-hover {
            transition: all 0.3s ease;
        }
        .shop-card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .filter-sidebar {
            position: sticky;
            top: 2rem;
            height: fit-content;
        }

        @media (max-width: 768px) {
            .filter-sidebar {
                position: relative;
                top: auto;
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Hero Section with Integrated Navigation -->
    <section class="relative h-screen bg-cover bg-center" style="background-image: url('/images/cultural-hero.jpg');">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/40"></div>

        <!-- Navigation Integrated at the Top -->
        <div class="relative z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center">
                            <img src="/images/logo.png" alt="Rorena Tours" class="h-10 w-10 rounded-full">
                            <span class="ml-2 text-xl font-bold text-green-600">RORENA</span>
                        </a>
                    </div>

                    <div class="hidden lg:flex items-center space-x-6">
                        <a href="{{ route('home') }}" class="text-white hover:text-green-400 px-3 py-2 font-medium">Home</a>
                        <a href="{{ route('tours') }}" class="text-white hover:text-green-400 px-3 py-2 font-medium">Tours</a>
                        <a href="{{ route('booking') }}" class="text-white hover:text-green-400 px-3 py-2 font-medium">Booking</a>
                        <a href="{{ route('destinations') }}" class="text-white hover:text-green-400 px-3 py-2 font-medium">Destination</a>

                        <!-- Pages Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="text-white hover:text-green-400 px-3 py-2 font-medium flex items-center">
                                Pages
                                <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition class="absolute top-full left-0 mt-2 bg-white rounded-lg shadow-lg py-2 w-48">
                                <a href="{{ route('about') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">About Us</a>
                                <a href="{{ route('contact') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Contact Us</a>
                                <a href="{{ route('faqs') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">FAQs</a>
                                <a href="{{ route('gallery') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Gallery</a>
                            </div>
                        </div>

                        <a href="{{ route('blog') }}" class="text-white hover:text-green-400 px-3 py-2 font-medium">Blog</a>
                        <a href="{{ route('services') }}" class="text-white hover:text-green-400 px-3 py-2 font-medium">Our Services</a>
                        <a href="{{ route('shop') }}" class="text-white hover:text-green-400 px-3 py-2 font-medium border-b-2 border-green-400">Shop</a>

                        <!-- Menu Icon -->
                        <a href="#" class="text-white hover:text-green-400 p-2">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </a>

                        <!-- Cart Icon with Badge -->
                        <a href="#" class="text-white hover:text-green-400 p-2 relative">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m2.6 8L8 21h8M9 19a2 2 0 100-4 2 2 0 000 4zm10 0a2 2 0 100-4 2 2 0 000 4z"></path>
                            </svg>
                            <!-- Cart badge (optional) -->
                            <span class="absolute -top-1 -right-1 bg-green-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">0</span>
                        </a>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="lg:hidden flex items-center" x-data="{ open: false }">
                        <button @click="open = !open" class="text-white hover:text-green-400">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>

                        <!-- Mobile Menu -->
                        <div x-show="open" x-transition class="absolute top-full left-0 right-0 bg-white/95 backdrop-blur-sm mt-2 rounded-lg">
                            <div class="px-2 pt-2 pb-3 space-y-1">
                                <a href="{{ route('home') }}" class="block px-3 py-2 text-gray-700 hover:text-green-600">Home</a>
                                <a href="{{ route('tours') }}" class="block px-3 py-2 text-gray-700 hover:text-green-600">Tours</a>
                                <a href="{{ route('booking') }}" class="block px-3 py-2 text-gray-700 hover:text-green-600">Booking</a>
                                <a href="{{ route('destinations') }}" class="block px-3 py-2 text-gray-700 hover:text-green-600">Destination</a>
                                <a href="{{ route('about') }}" class="block px-3 py-2 text-gray-700 hover:text-green-600">About</a>
                                <a href="{{ route('blog') }}" class="block px-3 py-2 text-gray-700 hover:text-green-600">Blog</a>
                                <a href="{{ route('services') }}" class="block px-3 py-2 text-gray-700 hover:text-green-600">Our Services</a>
                                <a href="{{ route('shop') }}" class="block px-3 py-2 text-gray-700 hover:text-green-600 font-semibold bg-green-50">Shop</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hero Content for Shop -->
        <div class="relative z-10 text-center text-white max-w-4xl mx-auto px-4 flex items-center h-full">
            <div class="w-full">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">Shop</h1>
                <p class="text-lg">This is sample of page tagline and you can set it up using page option</p>
            </div>
        </div>
    </section>

    <!-- Main Content Area -->
    <main class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Newsletter Section -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <h3 class="font-bold text-lg mb-3">Newsletter</h3>
                        <p class="text-gray-600 text-sm mb-4">Don't miss a thing! Sign up to receive daily deals</p>
                        <form class="space-y-3">
                            <input type="email" placeholder="Your Email Address" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition">
                                Subscribe
                            </button>
                        </form>
                    </div>

                    <!-- Featured Tours Section -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <div class="space-y-4">
                            <!-- Rwanda Tour -->
                            <div class="relative rounded-lg overflow-hidden">
                                <img src="/images/trips/rwanda.png" alt="Rwanda Tour" class="w-full h-32 object-cover">
                                <div class="absolute inset-0 bg-black/50 flex items-end">
                                    <div class="p-3 text-white">
                                        <div class="text-xs line-through text-gray-300">$4,900</div>
                                        <div class="text-lg font-bold">$4,200</div>
                                        <div class="text-sm font-medium">5 days around Rwanda</div>
                                        <div class="flex items-center text-xs mt-1">
                                            <div class="flex text-white">
                                                ★★★★★
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kenya Tour -->
                            <div class="relative rounded-lg overflow-hidden">
                                <img src="/images/trips/kenya.png" alt="Kenya Tour" class="w-full h-32 object-cover">
                                <div class="absolute inset-0 bg-black/50 flex items-end">
                                    <div class="p-3 text-white">
                                        <div class="text-lg font-bold">$6,000</div>
                                        <div class="text-sm font-medium">5 days in Kenya</div>
                                        <div class="flex items-center text-xs mt-1">
                                            <div class="flex text-white">
                                                ★★★★★
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Products Section -->
                <div class="lg:col-span-3">
                    <!-- Header with results and sorting -->
                    <div class="flex justify-between items-center mb-6">
                        <p class="text-gray-600">Showing all 6 results</p>
                        <select class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option>Default sorting</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                            <option>Name: A to Z</option>
                        </select>
                    </div>

                    <!-- Products Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Product 1: Uganda Tshirt -->
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition">
                            <img src="/images/uganda-tshirt.jpg" alt="Uganda Tshirt" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-800 mb-1">Uganda Tshirt</h3>
                                <div class="flex items-center mb-2">
                                    <div class="flex text-teal-500 text-sm">
                                        ★★★★★
                                    </div>
                                </div>
                                <div class="text-red-500 font-bold">$ 34</div>
                            </div>
                        </div>

                        <!-- Product 2: Iringa Basket Bag -->
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition">
                            <img src="/images/iringa-basket.jpg" alt="Iringa Basket Bag" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-800 mb-1">Iringa Basket Bag</h3>
                                <div class="flex items-center mb-2">
                                    <div class="flex text-teal-500 text-sm">
                                        ★★★★★
                                    </div>
                                </div>
                                <div class="text-red-500 font-bold">$ 54</div>
                            </div>
                        </div>

                        <!-- Product 3: Beaded Baskets -->
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition">
                            <img src="/images/beaded-baskets.jpg" alt="Beaded Baskets" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-800 mb-1">Beaded Baskets</h3>
                                <div class="flex items-center mb-2">
                                    <div class="flex text-teal-500 text-sm">
                                        ★★★★☆
                                    </div>
                                </div>
                                <div class="text-red-500 font-bold">$ 12</div>
                            </div>
                        </div>

                        <!-- Product 4: Wall art painting -->
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition">
                            <img src="/images/wall-art-painting.jpg" alt="Wall art painting" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-800 mb-1">Wall art painting</h3>
                                <div class="flex items-center mb-2">
                                    <div class="flex text-teal-500 text-sm">
                                        ★★★★☆
                                    </div>
                                </div>
                                <div class="text-red-500 font-bold">$ 73</div>
                            </div>
                        </div>

                        <!-- Product 5: Karamajong beads -->
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition">
                            <img src="/images/karamajong-beads.jpg" alt="Karamajong beads" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-800 mb-1">Karamajong beads</h3>
                                <div class="flex items-center mb-2">
                                    <div class="flex text-teal-500 text-sm">
                                        ★★★★☆
                                    </div>
                                </div>
                                <div class="text-red-500 font-bold">$ 11</div>
                            </div>
                        </div>

                        <!-- Product 6: African craft shoes -->
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition">
                            <img src="/images/african-craft-shoes.jpg" alt="African craft shoes" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-800 mb-1">African craft shoes</h3>
                                <div class="flex items-center mb-2">
                                    <div class="flex text-teal-500 text-sm">
                                        ★★★★☆
                                    </div>
                                </div>
                                <div class="text-red-500 font-bold">$ 23</div>
                            </div>
                        </div>
                    </div>
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

    <!-- Livewire Scripts -->
    @livewireScripts

    <!-- Custom Shop Scripts -->
    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add loading states for better UX
        document.addEventListener('livewire:init', () => {
            Livewire.on('loading', () => {
                // Add loading indicator
                console.log('Loading...');
            });
        });
    </script>
</body>
</html>
