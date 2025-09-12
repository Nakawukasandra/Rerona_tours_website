<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Rorena Tours') }} - @yield('title', 'Blog')</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('description', 'Discover Uganda through our travel blog featuring safari adventures, gorilla trekking guides, and cultural experiences.')">
    <meta name="keywords" content="@yield('keywords', 'Uganda tours, safari, gorilla trekking, travel blog, adventure, wildlife')">

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('og:title', config('app.name') . ' - Blog')">
    <meta property="og:description" content="@yield('og:description', 'Discover Uganda through our travel blog')">
    <meta property="og:image" content="@yield('og:image', asset('images/og-default.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'green': {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
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

    <!-- Additional Head Content -->
    @stack('head')

    <!-- Blog-specific styles -->
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body class="font-inter antialiased bg-gray-50">
    <!-- Tours Hero Section with Navigation -->
    <section class="relative h-screen bg-cover bg-center" style="background-image: url('/images/blog-hero.jpg');" x-data="{ open: false }">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/40"></div>

        <!-- Navigation Bar (Only visible in hero section) -->
        <nav class="relative z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center">
                            <img src="/images/logo.png" alt="Rorena Tours" class="h-10 w-10 rounded-full">
                        </a>
                    </div>

                    <div class="hidden lg:flex items-center space-x-6">
                        <a href="{{ route('home') }}" class="text-white hover:text-green-400 px-3 py-2 font-medium transition-colors">Home</a>
                        <a href="{{ route('tours') }}" class="text-green-400 px-3 py-2 font-medium transition-colors">Tours</a>
                        <a href="{{ route('booking') }}" class="text-white hover:text-green-400 px-3 py-2 font-medium transition-colors">Booking</a>
                        <a href="{{ route('destinations') }}" class="text-white hover:text-green-400 px-3 py-2 font-medium transition-colors">Destination</a>

                        <!-- Pages Dropdown -->
                        <div class="relative" x-data="{ dropdownOpen: false }">
                            <button @click="dropdownOpen = !dropdownOpen" class="text-white hover:text-green-400 px-3 py-2 font-medium flex items-center transition-colors">
                                Pages
                                <svg class="ml-1 h-4 w-4 transform transition-transform" :class="dropdownOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute top-full left-0 mt-2 bg-white rounded-lg shadow-lg py-2 w-48 z-50">
                                <a href="{{ route('about') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition-colors">About Us</a>
                                <a href="{{ route('contact') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition-colors">Contact Us</a>
                                <a href="{{ route('faqs') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition-colors">FAQs</a>
                                <a href="{{ route('gallery') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition-colors">Gallery</a>
                            </div>
                        </div>

                        <a href="{{ route('blog') }}" class="text-white hover:text-green-400 px-3 py-2 font-medium transition-colors">Blog</a>
                        <a href="{{ route('services') }}" class="text-white hover:text-green-400 px-3 py-2 font-medium transition-colors">Our Services</a>
                        <a href="{{ route('shop') }}" class="text-white hover:text-green-400 px-3 py-2 font-medium transition-colors">Shop</a>

                        <!-- Menu Icon -->
                        <button class="text-white hover:text-green-400 p-2 transition-colors">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>

                        <!-- Cart Icon -->
                        <button class="text-white hover:text-green-400 p-2 transition-colors relative">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m2.6 8L8 21h8M9 19a2 2 0 100-4 2 2 0 000 4zm10 0a2 2 0 100-4 2 2 0 000 4z"></path>
                            </svg>
                            <span class="absolute -top-1 -right-1 bg-green-500 text-white rounded-full text-xs w-5 h-5 flex items-center justify-center">0</span>
                        </button>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="lg:hidden flex items-center">
                        <button @click="open = !open" class="text-white hover:text-green-400 transition-colors">
                            <svg class="h-6 w-6" :class="open ? 'hidden' : 'block'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            <svg class="h-6 w-6" :class="open ? 'block' : 'hidden'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-1" class="lg:hidden bg-white/95 backdrop-blur-sm mt-2 rounded-lg">
                    <div class="px-2 pt-2 pb-3 space-y-1">
                        <a href="{{ route('home') }}" class="block px-3 py-2 text-gray-700 hover:text-green-600 hover:bg-green-50 rounded transition-colors">Home</a>
                        <a href="{{ route('tours') }}" class="block px-3 py-2 text-green-600 bg-green-50 rounded transition-colors">Tours</a>
                        <a href="{{ route('booking') }}" class="block px-3 py-2 text-gray-700 hover:text-green-600 hover:bg-green-50 rounded transition-colors">Booking</a>
                        <a href="{{ route('destinations') }}" class="block px-3 py-2 text-gray-700 hover:text-green-600 hover:bg-green-50 rounded transition-colors">Destination</a>
                        <a href="{{ route('about') }}" class="block px-3 py-2 text-gray-700 hover:text-green-400 hover:bg-green-50 rounded transition-colors">About</a>
                        <a href="{{ route('contact') }}" class="block px-3 py-2 text-gray-700 hover:text-green-400 hover:bg-green-50 rounded transition-colors">Contact</a>
                        <a href="{{ route('faqs') }}" class="block px-3 py-2 text-gray-700 hover:text-green-400 hover:bg-green-50 rounded transition-colors">FAQs</a>
                        <a href="{{ route('gallery') }}" class="block px-3 py-2 text-gray-700 hover:text-green-400 hover:bg-green-50 rounded transition-colors">Gallery</a>
                        <a href="{{ route('blog') }}" class="block px-3 py-2 text-gray-700 hover:text-green-400 hover:bg-green-50 rounded transition-colors">Blog</a>
                        <a href="{{ route('services') }}" class="block px-3 py-2 text-gray-700 hover:text-green-400 hover:bg-green-50 rounded transition-colors">Our Services</a>
                        <a href="{{ route('shop') }}" class="block px-3 py-2 text-gray-700 hover:text-green-400 hover:bg-green-50 rounded transition-colors">Shop</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Content -->
        <div class="relative z-10 flex items-end justify-center h-full pb-24">
            <div class="text-center text-white max-w-4xl mx-auto px-4">
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                    A blog to teach you more
                </h1>
                <p class="text-base md:text-lg lg:text-xl text-gray-200 max-w-2xl mx-auto">
                    Discover more with updated information about tourism and other related things in East Africa
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="flex-1">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="space-y-6">
                        <!-- Newsletter Card -->
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Newsletter</h3>
                            <p class="text-gray-600 mb-4">Don't miss up a thing! Sign up to receive daily deals</p>
                            <form class="space-y-3">
                                <input type="email" placeholder="Your Email Address"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <button type="submit"
                                        class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                                    Subscribe
                                </button>
                            </form>
                        </div>

                        <!-- Travel Tips Card -->
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-6">Travel Tips</h3>
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3 p-3 bg-yellow-50 rounded-lg">
                                    <div class="flex-shrink-0">
                                        <div class="w-16 h-16 bg-yellow-400 rounded-full flex items-center justify-center">
                                            <img src="/images/trips/east.png" alt="east african logo" class="w-16 h-16 rounded-full object-cover">
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm mb-1">
                                            <a href="/blog/east-africa-guide" class="hover:text-blue-600">
                                                A must know about East African countries
                                            </a>
                                        </h4>
                                        <p class="text-xs text-gray-600">September 16, 2021</p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-3 p-3 bg-blue-50 rounded-lg">
                                    <div class="flex-shrink-0">
                                        <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center">
                                            <img src="/images/trips/giraff.png" alt="giraff" class="w-16 h-16 rounded-full object-cover">
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm mb-1">
                                            <a href="/blog/travel-destinations" class="hover:text-blue-600">
                                                Find out where to go, stay and what to see
                                            </a>
                                        </h4>
                                        <p class="text-xs text-gray-600">September 16, 2021</p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-3 p-3 bg-green-50 rounded-lg">
                                    <div class="flex-shrink-0">
                                        <div class="w-16 h-16 bg-green-400 rounded-full flex items-center justify-center">
                                            <img src="/images/trips/people.png" alt="people" class="w-16 h-16 rounded-full object-cover">
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm mb-1">
                                            <a href="/blog/beginners-travel-guide" class="hover:text-blue-600">
                                                Beginners Travel Guide
                                            </a>
                                        </h4>
                                        <p class="text-xs text-gray-600">September 16, 2021</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Gallery Card -->
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-6">Gallery</h3>
                            <div class="grid grid-cols-3 gap-2">
                                <div class="aspect-square">
                                    <a href="/gallery">
                                        <img src="/images/gallery/nature1.jpg" alt="Safari wildlife" class="w-full h-full object-cover rounded">
                                    </a>
                                </div>
                                <div class="aspect-square">
                                    <a href="/gallery">
                                        <img src="/images/gallery/african.jpg" alt="African landscape" class="w-full h-full object-cover rounded">
                                    </a>
                                </div>
                                <div class="aspect-square">
                                    <a href="/gallery">
                                        <img src="/images/gallery/wild.jpg" alt="Wildlife photography" class="w-full h-full object-cover rounded">
                                    </a>
                                </div>
                                <div class="aspect-square">
                                    <a href="/gallery">
                                        <img src="/images/destinations/uganda-waterfall.jpg" alt="Mountain gorilla" class="w-full h-full object-cover rounded">
                                    </a>
                                </div>
                                <div class="aspect-square">
                                    <a href="/gallery">
                                        <img src="/images/gallery/safari.jpg" alt="Safari adventure" class="w-full h-full object-cover rounded">
                                    </a>
                                </div>
                                <div class="aspect-square">
                                    <a href="/gallery">
                                        <img src="/images/gallery/elephant.jpg" alt="African elephant" class="w-full h-full object-cover rounded">
                                    </a>
                                </div>
                                <div class="aspect-square">
                                    <a href="/gallery">
                                        <img src="/images/gallery/nature1.jpg" alt="Safari sunset" class="w-full h-full object-cover rounded">
                                    </a>
                                </div>
                                <div class="aspect-square">
                                    <a href="/gallery">
                                        <img src="/images/gallery/african.jpg" alt="African landscape" class="w-full h-full object-cover rounded">
                                    </a>
                                </div>
                                <div class="aspect-square">
                                    <a href="/gallery">
                                        <img src="/images/gallery/wild.jpg" alt="wildlife photography" class="w-full h-full object-cover rounded">
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Connect to Us Card -->
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-6">Connect to Us</h3>
                            <div class="flex space-x-4 justify-center">
                                <a href="https://facebook.com/rorenatours" target="_blank" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white hover:bg-blue-700 transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                    </svg>
                                </a>
                                <a href="https://twitter.com/rorenatours" target="_blank" class="w-10 h-10 bg-blue-800 rounded-full flex items-center justify-center text-white hover:bg-blue-900 transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                                    </svg>
                                </a>
                                <a href="https://youtube.com/rorenatours" target="_blank" class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center text-white hover:bg-red-700 transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                    </svg>
                                </a>
                                <a href="https://instagram.com/rorenatours" target="_blank" class="w-10 h-10 bg-pink-600 rounded-full flex items-center justify-center text-white hover:bg-pink-700 transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.042-3.441.219-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738a.36.36 0 01.083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.888-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.357-.631-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.017 0z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <!-- Recent Tours Card -->
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-6">Recent Tours</h3>
                            <div class="space-y-4">
                                <!-- 5 days around Rwanda -->
                                <div class="relative overflow-hidden rounded-lg group cursor-pointer">
                                    <a href="/tours/rwanda-5-days">
                                        <img src="/images/trips/rwanda.png"alt="Rwanda Tour"
                                        class="w-full h-32 object-cover group-hover:scale-105 transition-transform duration-300">
                                        <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col justify-end p-4">
                                            <div class="flex items-center justify-between text-white mb-2">
                                                <div>
                                                    <p class="text-lg font-bold">$4,200</p>
                                                    <div class="flex text-yellow-400 text-sm">
                                                        <span>★★★★★</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4 class="text-white font-semibold text-sm">5 days around Rwanda</h4>
                                        </div>
                                    </a>
                                </div>
                                <!-- 5 days in Kenya -->
                                <div class="relative overflow-hidden rounded-lg group cursor-pointer">
                                    <a href="/tours/kenya-5-days">
                                        <img src="/images/trips/kenya.png"alt="Kenya Tour"
                                        class="w-full h-32 object-cover group-hover:scale-105 transition-transform duration-300">
                                        <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col justify-end p-4">
                                            <div class="flex items-center justify-between text-white mb-2">
                                                <div>
                                                    <p class="text-lg font-bold">$5,000</p>
                                                    <div class="flex text-yellow-400 text-sm">
                                                        <span>★★★★★</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4 class="text-white font-semibold text-sm">5 days in Kenya</h4>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Blog Content Area -->
                <div class="lg:col-span-3">
                    <!-- Blog Posts Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Blog Post 1: Uganda Itinerary -->
                        <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            <div class="relative overflow-hidden">
                                <img src="/images/destinations/uganda-waterfall.jpg" alt="Uganda waterfall landscape"
                                     class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="p-6">
                                <div class="text-sm text-gray-500 mb-2">SEPTEMBER 10, 2021</div>
                                <h2 class="text-xl font-bold text-gray-900 mb-3 hover:text-green-600 transition-colors">
                                    <a href="/blog/uganda-three-weeks-itinerary">The Ultimate three Weeks' Uganda Itinerary</a>
                                </h2>
                                <p class="text-gray-600 line-clamp-3 mb-4">
                                    Uganda is home to more than half of the world's remaining mountain gorilla's, over 5000 chimpanzees and the largest number of monkeys in Africa.
                                </p>
                                <a href="/blog/uganda-three-weeks-itinerary"
                                   class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                                    Read More
                                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </article>

                        <!-- Blog Post 2: Top 10 Places East Africa -->
                        <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            <div class="relative overflow-hidden">
                                <img src="/images/destinations/east-africa-landscape.jpg" alt="East Africa savanna landscape"
                                     class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="p-6">
                                <div class="text-sm text-gray-500 mb-2">SEPTEMBER 10, 2021</div>
                                <h2 class="text-xl font-bold text-gray-900 mb-3 hover:text-green-600 transition-colors">
                                    <a href="/blog/top-10-places-east-africa">Top 10 Places to Visit in East Africa</a>
                                </h2>
                                <p class="text-gray-600 line-clamp-3 mb-4">
                                    Spend some time in East Africa with incredible stories of impact, change, and an impressive from the list of the top 10 incredible places.
                                </p>
                                <a href="/blog/top-10-places-east-africa"
                                   class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                                    Read More
                                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </article>

                        <!-- Blog Post 3: Best time to visit DRC -->
                        <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            <div class="relative overflow-hidden">
                                <img src="/images/trips/visit-drc.jpg" alt="Democratic Republic of Congo lake view"
                                     class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="p-6">
                                <div class="text-sm text-gray-500 mb-2">SEPTEMBER 10, 2021</div>
                                <h2 class="text-xl font-bold text-gray-900 mb-3 hover:text-green-600 transition-colors">
                                    <a href="/blog/best-time-visit-drc">The best time to visit the DRC</a>
                                </h2>
                                <p class="text-gray-600 line-clamp-3 mb-4">
                                    We probably shouldn't begin this article by telling you that the Democratic Republic of Congo experiences one of the highest...
                                </p>
                                <a href="/blog/best-time-visit-drc"
                                   class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                                    Read More
                                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </article>

                        <!-- Blog Post 4: Gorilla Trekking Guide -->
                        <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            <div class="relative overflow-hidden">
                                <img src="/images/destinations/mountain-gorilla.jpg" alt="Mountain gorilla in natural habitat"
                                     class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="p-6">
                                <div class="text-sm text-gray-500 mb-2">SEPTEMBER 10, 2021</div>
                                <h2 class="text-xl font-bold text-gray-900 mb-3 hover:text-green-600 transition-colors">
                                    <a href="/blog/east-africa-gorilla-trekking">East Africa Gorilla trekking Review / Guide</a>
                                </h2>
                                <p class="text-gray-600 line-clamp-3 mb-4">
                                    Uganda is one of the two finest places in the whole world for mountain gorilla trekking, reason why thousands of tourists fly in year in - year out
                                </p>
                                <a href="/blog/east-africa-gorilla-trekking"
                                   class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                                    Read More
                                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </article>

                        <!-- Blog Post 5: High end classic hotels -->
                        <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            <div class="relative overflow-hidden">
                                <img src="/images/destinations/luxury-hotel.jpg" alt="Luxury hotel with swimming pool"
                                     class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="p-6">
                                <div class="text-sm text-gray-500 mb-2">SEPTEMBER 10, 2021</div>
                                <h2 class="text-xl font-bold text-gray-900 mb-3 hover:text-green-600 transition-colors">
                                    <a href="/blog/high-end-classic-hotels">High end classic hotels to have a rest</a>
                                </h2>
                                <p class="text-gray-600 line-clamp-3 mb-4">
                                    Are you looking for an exotic holiday destination that will turn your vacation dreams into reality? Do you want to sleep in the best luxury hotels in
                                </p>
                                <a href="/blog/high-end-classic-hotels"
                                   class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                                    Read More
                                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </article>

                        <!-- Blog Post 6: Hiking peaks and mountains -->
                        <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            <div class="relative overflow-hidden">
                                <img src="/images/destinations/mountain-peak.jpg" alt="Mountain peak in East Africa"
                                     class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="p-6">
                                <div class="text-sm text-gray-500 mb-2">SEPTEMBER 10, 2021</div>
                                <h2 class="text-xl font-bold text-gray-900 mb-3 hover:text-green-600 transition-colors">
                                    <a href="/blog/hiking-peaks-mountains-east-africa">Hiking top peaks of the ranges and mountains in East Africa</a>
                                </h2>
                                <p class="text-gray-600 line-clamp-3 mb-4">
                                    With plenty of trails, mountains, and volcanoes dotting the region, East Africa is one of the best places on earth to enjoy some incredible hikes.
                                </p>
                                <a href="/blog/hiking-peaks-mountains-east-africa"
                                   class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                                    Read More
                                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </article>

                        <!-- Blog Post 7: East Africa's 10 Best National Parks -->
                        <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            <div class="relative overflow-hidden">
                                <img src="/images/destinations/national-park.jpg" alt="East African national park with waterfall"
                                     class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="p-6">
                                <div class="text-sm text-gray-500 mb-2">SEPTEMBER 10, 2021</div>
                                <h2 class="text-xl font-bold text-gray-900 mb-3 hover:text-green-600 transition-colors">
                                    <a href="/blog/east-africa-10-best-national-parks">East Africa's 10 Best National Parks</a>
                                </h2>
                                <p class="text-gray-600 line-clamp-3 mb-4">
                                    East Africa is home to an astonishing range of landscapes and biodiversity. Ripe to explore for the adventurous at heart. Whether savannah...
                                </p>
                                <a href="/blog/east-africa-10-best-national-parks"
                                   class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                                    Read More
                                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </article>

                        <!-- Blog Post 8: Source of the Nile -->
                        <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            <div class="relative overflow-hidden">
                                <img src="/images/trips/nile-source.jpg" alt="Source of River Nile with rapids"
                                     class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="p-6">
                                <div class="text-sm text-gray-500 mb-2">SEPTEMBER 10, 2021</div>
                                <h2 class="text-xl font-bold text-gray-900 mb-3 hover:text-green-600 transition-colors">
                                    <a href="/blog/source-of-nile-africa-biggest-lake">Explore the source of the Nile and Africa's biggest lake</a>
                                </h2>
                                <p class="text-gray-600 line-clamp-3 mb-4">
                                    Discovering the source of the Nile became a colonial obsession as soon as Europeans arrived in mainland Africa. The river cut across 11
                                </p>
                                <a href="/blog/source-of-nile-africa-biggest-lake"
                                   class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                                    Read More
                                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12 flex justify-center">
                        <nav class="flex items-center space-x-2">
                            <button class="w-8 h-8 flex items-center justify-center rounded-full bg-green-600 text-white font-medium hover:bg-green-700 transition-colors">
                                1
                            </button>
                            <button class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-200 text-gray-700 font-medium hover:bg-gray-300 transition-colors">
                                2
                            </button>
                            <span class="text-gray-500 px-2">Page 1 of 2</span>
                        </nav>
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

    <!-- Additional Scripts -->
    @stack('scripts')

    <!-- Enhanced JavaScript -->
    <script>
        // Handle navigation for all route-based links
        document.querySelectorAll('a[href*="{{ route"]').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const href = this.getAttribute('href');
                // Navigate to the route
                window.location.href = href;
            });
        });

        // Add smooth scrolling for anchor links
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

        // Add loading states to buttons
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.classList.add('opacity-75');
                    submitBtn.disabled = true;

                    // Re-enable after 3 seconds (adjust as needed)
                    setTimeout(() => {
                        submitBtn.classList.remove('opacity-75');
                        submitBtn.disabled = false;
                    }, 3000);
                }
            });
        });
    </script>
</body>
</html>
