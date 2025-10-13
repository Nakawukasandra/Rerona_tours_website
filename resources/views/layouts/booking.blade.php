<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>East Africa's 10 Best National Parks - Rorena Tours</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.5rem;
        }
        .gallery-item {
            aspect-ratio: 1;
            overflow: hidden;
            border-radius: 0.5rem;
        }
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .gallery-item:hover img {
            transform: scale(1.05);
        }
        .main-layout {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 2rem;
        }
        @media (max-width: 1024px) {
            .main-layout {
                grid-template-columns: 1fr;
            }
        }
        .main-content {
            max-height: 80vh;
            overflow-y: auto;
            scroll-behavior: smooth;
        }
        .main-content::-webkit-scrollbar {
            width: 8px;
        }
        .main-content::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }
        .main-content::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        .main-content::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Backdrop blur effect for mobile menu */
        .backdrop-blur-sm {
            backdrop-filter: blur(4px);
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50" x-data="{ open: false }">
    <!-- Navigation Bar -->
    <nav class="relative z-50 bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <a href="/" class="flex items-center">
                        <img src="/images/logo.png" alt="Rorena Tours" class="h-10 w-10 rounded-full">
                    </a>
                </div>

                <div class="hidden lg:flex items-center space-x-6">
                    <a href="/" class="text-white hover:text-green-400 px-3 py-2 font-medium transition-colors">Home</a>
                    <a href="/tours" class="text-white hover:text-green-400 px-3 py-2 font-medium transition-colors">Tours</a>
                    <a href="/booking" class="text-white hover:text-green-400 px-3 py-2 font-medium transition-colors">Booking</a>
                    <a href="/destinations" class="text-white hover:text-green-400 px-3 py-2 font-medium transition-colors">Destination</a>

                    <!-- Pages Dropdown -->
                    <div class="relative" x-data="{ dropdownOpen: false }">
                        <button @click="dropdownOpen = !dropdownOpen" class="text-white hover:text-green-400 px-3 py-2 font-medium flex items-center transition-colors">
                            Pages
                            <svg class="ml-1 h-4 w-4 transform transition-transform" :class="dropdownOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute top-full left-0 mt-2 bg-white rounded-lg shadow-lg py-2 w-48 z-50">
                            <a href="/about" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition-colors">About Us</a>
                            <a href="/contact" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition-colors">Contact Us</a>
                            <a href="/faqs" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition-colors">FAQs</a>
                            <a href="/gallery" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition-colors">Gallery</a>
                        </div>
                    </div>

                    <a href="/blog" class="text-green-400 px-3 py-2 font-medium transition-colors">Blog</a>
                    <a href="/services" class="text-white hover:text-green-400 px-3 py-2 font-medium transition-colors">Our Services</a>
                    <a href="/shop" class="text-white hover:text-green-400 px-3 py-2 font-medium transition-colors">Shop</a>

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
                    <a href="/" class="block px-3 py-2 text-gray-700 hover:text-green-600 hover:bg-green-50 rounded transition-colors">Home</a>
                    <a href="/tours" class="block px-3 py-2 text-gray-700 hover:text-green-600 hover:bg-green-50 rounded transition-colors">Tours</a>
                    <a href="/booking" class="block px-3 py-2 text-gray-700 hover:text-green-600 hover:bg-green-50 rounded transition-colors">Booking</a>
                    <a href="/destinations" class="block px-3 py-2 text-gray-700 hover:text-green-600 hover:bg-green-50 rounded transition-colors">Destination</a>
                    <a href="/about" class="block px-3 py-2 text-gray-700 hover:text-green-400 hover:bg-green-50 rounded transition-colors">About</a>
                    <a href="/contact" class="block px-3 py-2 text-gray-700 hover:text-green-400 hover:bg-green-50 rounded transition-colors">Contact</a>
                    <a href="/faqs" class="block px-3 py-2 text-gray-700 hover:text-green-400 hover:bg-green-50 rounded transition-colors">FAQs</a>
                    <a href="/gallery" class="block px-3 py-2 text-gray-700 hover:text-green-400 hover:bg-green-50 rounded transition-colors">Gallery</a>
                    <a href="/blog" class="block px-3 py-2 text-green-600 bg-green-50 rounded transition-colors">Blog</a>
                    <a href="/services" class="block px-3 py-2 text-gray-700 hover:text-green-400 hover:bg-green-50 rounded transition-colors">Our Services</a>
                    <a href="/shop" class="block px-3 py-2 text-gray-700 hover:text-green-400 hover:bg-green-50 rounded transition-colors">Shop</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <div class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <header class="text-center">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">East Africa's 10 Best National Parks</h1>
                <p class="text-gray-600">September 16, 2021 • <span class="text-blue-600">0 COMMENT</span></p>
            </header>
        </div>
    </div>

    <!-- Main Content Layout -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="main-layout">
            <!-- Main Content -->
            <div class="main-content">
                <div class="bg-white rounded-lg shadow-sm p-8">
                    <!-- Introduction -->
                    <div class="mb-12">
                        <p class="text-lg text-gray-700 leading-relaxed">
                            East Africa is home to an astonishing range of landscapes and biodiversity, ripe to explore for the adventurous at heart.
                            Whether savannah, rainforest, mountains or valleys, each location offers a truly unique and exciting prospect for the curious
                            mind. We took a look at 10 of our favorite options (in no particular order) to cover as much variety as possible.
                        </p>
                    </div>

                    <!-- National Parks List -->
                    <div class="space-y-8 mb-12">
                        <!-- 1. Murchison Falls -->
                        <div class="border-l-4 border-blue-500 pl-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">1. Murchison Falls National Park, Uganda</h3>
                            <p class="text-gray-700 leading-relaxed">
                                Located in Northwest Uganda, Murchison Falls National Park boasts an impressive series of waterfalls from the Nile River as it
                                spills into Lake Albert below. Visitors to the park will experience lush rainforest and river valleys filled with lions, leopards,
                                elephants, giraffes, hartebeests, chimpanzees, and many bird species.
                            </p>
                        </div>

                        <!-- 2. Volcanoes -->
                        <div class="border-l-4 border-green-500 pl-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">2. Volcanoes National Park, Rwanda</h3>
                            <p class="text-gray-700 leading-relaxed">
                                Home to the rare and majestic Mountain Gorilla, this park is made up of 5 active volcanoes covered in thick rainforests and
                                mountain peaks. The park is also home to Golden monkeys, Spotted Hyena, buffaloes, elephants, black-fronted duiker, and
                                bushbuck. The park also harbors 178 bird species, 29 of which are only found in this area.
                            </p>
                        </div>

                        <!-- 3. Ruaha -->
                        <div class="border-l-4 border-yellow-500 pl-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">3. Ruaha National Park, Tanzania</h3>
                            <p class="text-gray-700 leading-relaxed">
                                Tanzania's largest national park, Ruaha homes East Africa's biggest elephant population, along with over 500 species of birds
                                and reptiles that inhabit the park's namesake river.
                            </p>
                        </div>

                        <!-- 4. Serengeti -->
                        <div class="border-l-4 border-orange-500 pl-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">4. Serengeti National Park, Tanzania</h3>
                            <div class="mb-4">
                                <img src="/images/trips/serengeti.jpg"
                                     alt="Serengeti landscape with elephants at sunset"
                                     class="w-full h-64 object-cover rounded-lg shadow-lg">
                            </div>
                            <p class="text-gray-700 leading-relaxed">
                                One of Africa's most famous national parks, the Serengeti features the Earth's largest Wildebeest and Zebra migrations (1.5
                                million and 250,000 respectively). It is also one of the best places in Africa to view the intimidating Nile Crocodile in large
                                numbers.
                            </p>
                        </div>

                        <!-- 5. Maasai Mara -->
                        <div class="border-l-4 border-red-500 pl-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">5. Maasai Mara National Reserve, Kenya</h3>
                            <p class="text-gray-700 leading-relaxed">
                                Possibly one of the most famous National Parks on earth, Maasai Mara is home to some of the largest populations of Maasai
                                lions, African leopards and Tanzanian cheetahs.
                            </p>
                        </div>

                        <!-- 6. Queen Elizabeth -->
                        <div class="border-l-4 border-purple-500 pl-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">6. Queen Elizabeth National Park, Uganda</h3>
                            <div class="mb-4">
                                <img src="/images/trips/warthogs.jpg"
                                     alt="Warthogs in Queen Elizabeth National Park"
                                     class="w-full h-64 object-cover rounded-lg shadow-lg">
                            </div>
                            <p class="text-gray-700 leading-relaxed">
                                Uganda's most popular national park, Queen Elizabeth NP features a landscape of volcanic cones and craters to form a series
                                of lakes and rivers. The park is also famous for its population of tree-climbing lions and their unique black manes.
                            </p>
                        </div>

                        <!-- 7-10 More Parks -->
                        <div class="border-l-4 border-indigo-500 pl-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">7. Ngorongoro Conservation Area, Tanzania</h3>
                            <p class="text-gray-700 leading-relaxed">
                                Ngorongoro's defining feature is its massive crater, the world's largest inactive, intact and unfilled volcanic caldera. This unique
                                geological feature created a food, fresh water and shelter combination that has attracted many animals to remain within it
                                for centuries, such as the endangered Black Rhino.
                            </p>
                        </div>

                        <div class="border-l-4 border-pink-500 pl-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">8. Amboseli National Park, Kenya</h3>
                            <p class="text-gray-700 leading-relaxed">
                                Famous for its large elephant herds and spectacular views of Mount Kilimanjaro, Amboseli offers some of the best wildlife
                                viewing in Africa. The park is particularly known for its elephant research and conservation efforts.
                            </p>
                        </div>

                        <div class="border-l-4 border-teal-500 pl-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">9. Lake Nakuru National Park, Kenya</h3>
                            <p class="text-gray-700 leading-relaxed">
                                Renowned for its flamingo spectacle, Lake Nakuru is home to millions of flamingos that create a stunning pink blanket across
                                the lake. The park also provides sanctuary for both black and white rhinoceros.
                            </p>
                        </div>

                        <div class="border-l-4 border-emerald-500 pl-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">10. Bwindi Impenetrable National Park, Uganda</h3>
                            <p class="text-gray-700 leading-relaxed">
                                Home to almost half of the world's remaining mountain gorillas, Bwindi is a UNESCO World Heritage Site known for its
                                incredible biodiversity. The park offers unforgettable gorilla trekking experiences in its ancient rainforest.
                            </p>
                        </div>
                    </div>

                    <!-- Book Now Section -->
                    <div class="mb-12 bg-gradient-to-br from-green-800 to-green-900 rounded-lg p-8">
                        <h3 class="text-2xl font-bold text-white mb-6 text-center">Book Your East African Adventure</h3>
                        <form class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <input type="text"
                                           placeholder="Full Name"
                                           required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent">
                                </div>
                                <div>
                                    <input type="email"
                                           placeholder="Email Address"
                                           required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <input type="date"
                                           placeholder="Preferred Travel Date"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent">
                                </div>
                                <div>
                                    <input type="number"
                                           placeholder="Number of People"
                                           min="1"
                                           max="20"
                                           required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent bg-white text-gray-600">
                                        <option value="">Select Tour Package</option>
                                        <option value="serengeti-3days">Serengeti Safari - 3 Days ($800/person)</option>
                                        <option value="uganda-gorilla-5days">Uganda Gorilla Trek - 5 Days ($1200/person)</option>
                                        <option value="kenya-masai-4days">Kenya Masai Mara - 4 Days ($950/person)</option>
                                        <option value="rwanda-volcanoes-3days">Rwanda Volcanoes - 3 Days ($1100/person)</option>
                                        <option value="tanzania-kilimanjaro-7days">Kilimanjaro Trek - 7 Days ($1500/person)</option>
                                        <option value="east-africa-grand-10days">East Africa Grand Tour - 10 Days ($2200/person)</option>
                                        <option value="custom">Custom Package (Quote on Request)</option>
                                    </select>
                                </div>
                                <div>
                                    <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent bg-white text-gray-600">
                                        <option value="">Accommodation Level</option>
                                        <option value="budget">Budget ($50-100/night)</option>
                                        <option value="mid-range">Mid-range ($100-300/night)</option>
                                        <option value="luxury">Luxury ($300-600/night)</option>
                                        <option value="ultra-luxury">Ultra Luxury ($600+/night)</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <textarea rows="4"
                                          placeholder="Special requests, dietary requirements, accessibility needs, or specific preferences..."
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent resize-none"></textarea>
                            </div>

                            <div class="bg-green-700 p-4 rounded-lg">
                                <p class="text-white text-sm mb-2">
                                    <strong>Note:</strong> This is a booking inquiry. Our team will contact you within 24 hours with:
                                </p>
                                <ul class="text-white text-sm space-y-1 ml-4">
                                    <li>• Detailed itinerary and pricing</li>
                                    <li>• Payment schedule options</li>
                                    <li>• Travel requirements and recommendations</li>
                                    <li>• Confirmation of availability</li>
                                </ul>
                            </div>

                            <div class="text-center">
                                <button type="submit"
                                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-8 rounded-lg transition duration-300 transform hover:scale-105 shadow-lg">
                                    Submit Booking Inquiry
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Tourism Highlight Box -->
                    <div class="bg-blue-50 p-8 rounded-lg mb-12 text-center">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">East Africa is home to an astonishing range of landscapes and biodiversity, ripe to explore for the adventurous at heart.</h2>
                        <p class="text-gray-700 mb-6">
                            Tourism in the East African region has many opportunities. While affording the travelers an impressive range of options in
                            exploration and relaxation, the region presents incredible potential for investors across the tourism value chain.
                        </p>
                        <div class="flex justify-center space-x-8 text-sm text-gray-600">
                            <span># EAST AFRICA</span>
                            <span># TRAVEL</span>
                            <span># TOURS</span>
                        </div>
                    </div>

                    <!-- Author Section with Avatar -->
                    <div class="bg-gray-50 p-6 rounded-lg mb-12">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <!-- Avatar with initials -->
                                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold text-xl shadow-lg">
                                    GK
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">POSTED BY</p>
                                <h4 class="text-lg font-bold text-gray-900 mb-2">George Kaine</h4>
                                <p class="text-gray-700 text-sm">
                                    Owing to its socio-economic significance in the region, tourism is one of the key productive
                                    sectors that have been identified for cooperation in EAC.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
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

                <!-- Recent Tours Card -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Recent Tours</h3>
                    <div class="space-y-4">
                        <!-- Rwanda Tour -->
                        <div class="relative overflow-hidden rounded-lg group cursor-pointer">
                            <img src="/images/trips/rwanda.png" alt="Rwanda Tour"
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
                        </div>

                        <!-- Kenya Tour -->
                        <div class="relative overflow-hidden rounded-lg group cursor-pointer">
                            <img src="/images/trips/kenya.png" alt="Kenya Tour"
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

    <script>
        // Form submission handling
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    if (this.querySelector('input[type="email"]')) {
                        alert('Thank you for your inquiry! We will contact you within 24 hours.');
                        this.reset();
                    }
                });
            });
        });
    </script>
</body>
</html>
