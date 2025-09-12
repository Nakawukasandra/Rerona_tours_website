<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Rorena Tours & Safari')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Livewire Styles -->
    @livewireStyles
</head>
<body class="bg-gray-50">
    <!-- Hero Section with Integrated Navigation (for homepage) -->
    @if(Route::currentRouteName() == 'home')
    <section class="relative h-screen overflow-hidden" x-data="{
        currentImage: 0,
        images: [
            '/images/gorilla-hero.jpg',
            '/images/kilimanjaro-sunset.jpg',
            '/images/savanna-wildlife.jpg'
        ]
    }" x-init="
        setInterval(() => {
            currentImage = (currentImage + 1) % images.length;
        }, 5000);
    ">
        <!-- Background Images with Transition -->
        <template x-for="(image, index) in images" :key="index">
            <div
                class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000"
                :style="`background-image: url('${image}')`"
                :class="{ 'opacity-100': currentImage === index, 'opacity-0': currentImage !== index }"
            ></div>
        </template>

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
                        <a href="{{ route('shop') }}" class="text-white hover:text-green-400 px-3 py-2 font-medium">Shop</a>
                        <!-- Menu Icon -->
                        <a href="#" class="text-white hover:text-green-400 p-2">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </a>
                        <!-- Cart Icon -->
                        <a href="{{ route('cart') }}" class="text-white hover:text-green-400 p-2">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m2.6 8L8 21h8M9 19a2 2 0 100-4 2 2 0 000 4zm10 0a2 2 0 100-4 2 2 0 000 4z"></path>
                            </svg>
                        </a>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="lg:hidden flex items-center">
                        <button @click="open = !open" class="text-white hover:text-green-400">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div x-show="open" x-transition class="lg:hidden bg-white/95 backdrop-blur-sm mt-2">
                    <div class="px-2 pt-2 pb-3 space-y-1">
                        <a href="{{ route('home') }}" class="block px-3 py-2 text-gray-700 hover:text-green-600">Home</a>
                        <a href="{{ route('tours') }}" class="block px-3 py-2 text-gray-700 hover:text-green-600">Tours</a>
                        <a href="{{ route('booking') }}" class="block px-3 py-2 text-gray-700 hover:text-green-600">Booking</a>
                        <a href="{{ route('destinations') }}" class="block px-3 py-2 text-gray-700 hover:text-green-600">Destination</a>
                        <a href="{{ route('about') }}" class="block px-3 py-2 text-gray-700 hover:text-green-600">About Us</a>
                        <a href="{{ route('contact') }}" class="block px-3 py-2 text-gray-700 hover:text-green-600">Contact Us</a>
                        <a href="{{ route('faqs') }}" class="block px-3 py-2 text-gray-700 hover:text-green-600">FAQs</a>
                        <a href="{{ route('gallery') }}" class="block px-3 py-2 text-gray-700 hover:text-green-600">Gallery</a>
                        <a href="{{ route('blog') }}" class="block px-3 py-2 text-gray-700 hover:text-green-600">Blog</a>
                        <a href="{{ route('services') }}" class="block px-3 py-2 text-gray-700 hover:text-green-600">Our Services</a>
                        <a href="{{ route('shop') }}" class="block px-3 py-2 text-gray-700 hover:text-green-600">Shop</a>
                        <a href="{{ route('cart') }}" class="block px-3 py-2 text-gray-700 hover:text-green-600">Cart</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 text-center text-white max-w-4xl mx-auto px-4 flex items-center h-full">
            <div>
                <!-- Logo -->
                <div class="mb-16">
                   <!-- <img src="/images/logo.png" alt="Rorena Tours" class="h-48 w-48 rounded-full mx-auto"> -->
                </div>

                <h1 class="text-4xl md:text-6xl font-bold mb-4">Where do you want to go?</h1>
                <p class="text-xl mb-8">Trips, Safari, adventure, experience and tours. All in one place</p>

                <!-- Search Form (without background card) -->
                <form class="grid grid-cols-1 md:grid-cols-4 gap-4" method="GET" action="{{ route('search') }}">
                    <div>
                        <input type="text" name="destination" placeholder="Destination, City" class="w-full px-4 py-3 rounded-lg border-0 text-gray-700 placeholder-gray-500 focus:ring-2 focus:ring-green-500">
                    </div>
                    <div>
                        <select name="month" class="w-full px-4 py-3 rounded-lg border-0 text-gray-700 focus:ring-2 focus:ring-green-500">
                            <option value="">Any Month</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                    <div>
                        <select name="sort" class="w-full px-4 py-3 rounded-lg border-0 text-gray-700 focus:ring-2 focus:ring-green-500">
                            <option value="date">Sort By Date</option>
                            <option value="price_low">Price: Low to High</option>
                            <option value="price_high">Price: High to Low</option>
                            <option value="duration">Duration</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold">Search</button>
                    </div>
                </form>
                <div class="mt-4 text-left">
                    <label class="inline-flex items-center text-sm text-white">
                        <input type="checkbox" class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                        <span class="ml-2">Advanced search</span>
                    </label>
                </div>
            </div>
        </div>
    </section>


    <!-- Popular Destinations Section (for homepage) -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Popular Destinations</h2>
                <p class="text-gray-600 text-lg">World's best tourist destinations</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Nairobi -->
                <div class="relative group overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="h-64 bg-cover bg-center" style="background-image: url('/images/destinations/nairobi.jpg');">
                        <div class="absolute inset-0 bg-black/30 group-hover:bg-black/40 transition-colors duration-300"></div>
                        <div class="absolute bottom-4 left-4">
                            <h3 class="text-white text-xl font-bold">Nairobi</h3>
                        </div>
                    </div>
                </div>

                <!-- Fort Portal -->
                <div class="relative group overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="h-64 bg-cover bg-center" style="background-image: url('/images/destinations/fort-portal.jpg');">
                        <div class="absolute inset-0 bg-black/30 group-hover:bg-black/40 transition-colors duration-300"></div>
                        <div class="absolute bottom-4 left-4">
                            <h3 class="text-white text-xl font-bold">Fort Portal</h3>
                        </div>
                    </div>
                </div>

                <!-- Moshi -->
                <div class="relative group overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="h-64 bg-cover bg-center" style="background-image: url('/images/destinations/moshi.jpg');">
                        <div class="absolute inset-0 bg-black/30 group-hover:bg-black/40 transition-colors duration-300"></div>
                        <div class="absolute bottom-4 left-4">
                            <h3 class="text-white text-xl font-bold">Moshi</h3>
                        </div>
                    </div>
                </div>

                <!-- Kabale -->
                <div class="relative group overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="h-64 bg-cover bg-center" style="background-image: url('/images/destinations/kabale.jpg');">
                        <div class="absolute inset-0 bg-black/30 group-hover:bg-black/40 transition-colors duration-300"></div>
                        <div class="absolute bottom-4 left-4">
                            <h3 class="text-white text-xl font-bold">Kabale</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Best Value Trips Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Best Value Trips</h2>
                <p class="text-gray-600 text-lg">Best offers trips from us</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Bwindi Impenetrable -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="relative">
                        <img src="/images/trips/bwindi.jpg" alt="Bwindi Impenetrable" class="w-full h-48 object-cover">
                        <div class="absolute top-4 left-4">
                            <span class="bg-blue-600 text-white px-3 py-1 rounded text-sm font-semibold">$5,000</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Bwindi Impenetrable</h3>
                        <p class="text-gray-600 text-sm mb-4">Activities go here</p>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-1">
                                <!-- Star Rating -->
                                <div class="flex space-x-1">
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm text-gray-500 ml-2">4 reviews</span>
                            </div>
                            <div class="flex items-center text-gray-500 text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                5 days
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ol Doinyo Lengai -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="relative">
                        <img src="/images/trips/oI-doinyo.jpg" alt="Ol Doinyo Lengai" class="w-full h-48 object-cover">
                        <div class="absolute top-4 left-4">
                            <span class="bg-blue-600 text-white px-3 py-1 rounded text-sm font-semibold">$6,000</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Ol Doinyo Lengai</h3>
                        <p class="text-gray-600 text-sm mb-4">Activities go here</p>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-1">
                                <!-- Star Rating -->
                                <div class="flex space-x-1">
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm text-gray-500 ml-2">4 reviews</span>
                            </div>
                            <div class="flex items-center text-gray-500 text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                5 days
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mt Kilimanjaro N. Park -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="relative">
                        <img src="/images/trips/kilimanjaro.jpg" alt="Mt Kilimanjaro N. Park" class="w-full h-48 object-cover">
                        <div class="absolute top-4 left-4">
                            <div class="space-y-1">
                                <div class="bg-gray-500 text-white px-2 py-1 rounded text-xs font-semibold line-through">$3,000</div>
                                <div class="bg-blue-600 text-white px-3 py-1 rounded text-sm font-semibold">$2,500</div>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4">
                            <span class="bg-yellow-500 text-white px-2 py-1 rounded text-xs font-semibold">Sale</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Mt Kilimanjaro N. Park</h3>
                        <p class="text-gray-600 text-sm mb-4">Activities go here</p>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-1">
                                <!-- Star Rating -->
                                <div class="flex space-x-1">
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm text-gray-500 ml-2">4 reviews</span>
                            </div>
                            <div class="flex items-center text-gray-500 text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                5 days
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Why Choose Us</h2>
                <p class="text-gray-600 text-lg">Here are reasons you should plan trip with us</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div>
                    <img src="/images/icons/map-pin.png" alt="Tailored tour packages" class="mx-auto mb-4 w-16 h-16">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Tailored tour packages</h3>
                    <p class="text-gray-600 text-sm">The best tours, trips and vacation packages in East Africa delivered by top East Africa travel specialists to the best destinations you have ever heard of that meet the needs of your family.</p>
                </div>
                <div>
                    <img src="/images/icons/globe.png" alt="World class accommodation" class="mx-auto mb-4 w-16 h-16">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">World class accommodation</h3>
                    <p class="text-gray-400 text-sm">Rorena Tours and Safaris has got it's own guest got a good partnership with other service and accommodation providers and facilities in the entire East Africa.</p>
                </div>
                <div>
                    <img src="/images/icons/hot-air-balloon.png" alt="Professional services" class="mx-auto mb-4 w-16 h-16">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Professional services</h3>
                    <p class="text-gray-600 text-sm">We have both experienced and skilled tour drivers and guides to conduct and guide tourists in the above mentioned countries, specialized in making tours and safari activities.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tiger Image Background Separator with Parallax Effect -->
    <section class="relative h-64 bg-fixed bg-cover bg-center" style="background-image: url('/images/tiger-bg.jpg');">
        <div class="absolute inset-0 bg-black/40"></div>
    </section>

    <!-- Articles & Tips Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Articles & Tips</h2>
                <p class="text-gray-600 text-lg">Explore some of the best tips from around the world</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow-lg p-4">
                    <img src="/images/articles/top-places.jpg" alt="Top 10 Places" class="w-full h-32 object-cover rounded-t-lg">
                    <div class="p-4">
                        <p class="text-sm text-gray-500">September 12, 2023</p>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Top 10 Places to visit in East Africa</h3>
                        <p class="text-gray-600 text-sm">East Africa is home to an astonishing range of landscapes and biodiversity, ripe to explore for the adventurous at heart. Whether savannah...</p>
                        <a href="#" class="text-blue-600 text-sm mt-2 inline-block">Read More</a>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-4">
                    <img src="/images/articles/nile-lake.jpg" alt="Nile Lake" class="w-full h-32 object-cover rounded-t-lg">
                    <div class="p-4">
                        <p class="text-sm text-gray-500">September 12, 2023</p>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Exploring the source of the Nile and Africa's biggest lake</h3>
                        <p class="text-gray-600 text-sm">Discovering the source of the Nile became a colonial obsession as soon as Europeans arrived in mainland Africa. The river cut...</p>
                        <a href="#" class="text-blue-600 text-sm mt-2 inline-block">Read More</a>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-4">
                    <img src="/images/articles/uganda-itinerary.jpg" alt="Uganda Itinerary" class="w-full h-32 object-cover rounded-t-lg">
                    <div class="p-4">
                        <p class="text-sm text-gray-500">September 12, 2023</p>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">The Ultimate three Weeks' Uganda Itinerary</h3>
                        <p class="text-gray-600 text-sm">Uganda is a wonderful country for a holiday. The landscape is very diverse and varies from rainforests, savannahs, mountains and...</p>
                        <a href="#" class="text-blue-600 text-sm mt-2 inline-block">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @endif

    <!-- Main Content -->
    <main class="{{ Route::currentRouteName() == 'home' ? '' : 'pt-16' }}">
        @yield('content')
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

    <script>
        // Add smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>
