<div>
    <!-- Hero Section -->
    <section class="relative h-screen bg-cover bg-center" style="background-image: url('/images/gorilla-hero.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="relative z-10 flex items-center justify-center h-full">
            <div class="text-center text-white max-w-4xl mx-auto px-4">
                <!-- Logo -->
                <div class="mb-8">
                    <div class="inline-flex items-center justify-center w-32 h-32 bg-green-600 rounded-full mb-4">
                        <img src="/images/gorilla-logo.png" alt="Rorena Tours" class="w-20 h-20 rounded-full">
                    </div>
                    <h1 class="text-4xl md:text-6xl font-bold tracking-wider">RORENA</h1>
                    <p class="text-lg md:text-xl mt-2 tracking-wide">TOURS AND SAFARIS(U) LTD</p>
                </div>

                <h2 class="text-3xl md:text-5xl font-bold mb-4">Where do you want to go?</h2>
                <p class="text-xl mb-8">Trips, safaris, adventures, experiences and tours. All in one place.</p>

                <!-- Search Form -->
                <form wire:submit.prevent="search" class="max-w-4xl mx-auto">
                    <div class="bg-white rounded-lg p-6 shadow-lg">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div class="relative">
                                <input
                                    type="text"
                                    wire:model="searchDestination"
                                    placeholder="Destination, City"
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                >
                                <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>

                            <div class="relative">
                                <select
                                    wire:model="searchMonth"
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                >
                                    <option value="">Any Month</option>
                                    <option value="january">January</option>
                                    <option value="february">February</option>
                                    <option value="march">March</option>
                                    <option value="april">April</option>
                                    <option value="may">May</option>
                                    <option value="june">June</option>
                                    <option value="july">July</option>
                                    <option value="august">August</option>
                                    <option value="september">September</option>
                                    <option value="october">October</option>
                                    <option value="november">November</option>
                                    <option value="december">December</option>
                                </select>
                            </div>

                            <div class="relative">
                                <select
                                    wire:model="sortBy"
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                >
                                    <option value="date">Sort By Date</option>
                                    <option value="price">Sort By Price</option>
                                    <option value="popularity">Sort By Popularity</option>
                                    <option value="duration">Sort By Duration</option>
                                </select>
                            </div>

                            <button
                                type="submit"
                                class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-200 font-semibold"
                            >
                                Search
                            </button>
                        </div>

                        <div class="mt-4 text-left">
                            <button type="button" class="text-blue-600 hover:text-blue-800 text-sm">
                                ⚙️ Advanced search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Featured Tours Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Featured Tours</h2>
                <p class="text-lg text-gray-600">Discover our most popular safari and adventure experiences</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($featuredTours as $tour)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                        <img
                            src="{{ $tour->featured_image ? asset('storage/' . $tour->featured_image) : '/images/default-tour.jpg' }}"
                            alt="{{ $tour->title }}"
                            class="w-full h-48 object-cover"
                        >
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $tour->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($tour->description, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <div>
                                    @if($tour->discounted_price)
                                        <span class="text-gray-500 line-through text-sm">${{ number_format($tour->price, 0) }}</span>
                                        <span class="text-green-600 font-bold text-lg ml-2">${{ number_format($tour->discounted_price, 0) }}</span>
                                    @else
                                        <span class="text-green-600 font-bold text-lg">From ${{ number_format($tour->price, 0) }}</span>
                                    @endif
                                </div>
                                <a
                                    href="{{ route('tours.show', $tour->slug) }}"
                                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-200"
                                >
                                    Learn More
                                </a>
                            </div>
                            <div class="mt-3 text-sm text-gray-500">
                                <span class="inline-flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $tour->duration }} {{ $tour->duration == 1 ? 'Day' : 'Days' }}
                                </span>
                                <span class="ml-4 inline-flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    Max {{ $tour->max_group_size }} people
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-600">No featured tours available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Why Choose Rorena Tours?</h2>
                <p class="text-lg text-gray-600">Experience the best of Uganda with our expert guides and personalized service</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Expert Guides</h3>
                    <p class="text-gray-600">Our experienced local guides know every trail, every animal behavior, and every secret spot.</p>
                </div>

                <div class="text-center">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Personalized Experience</h3>
                    <p class="text-gray-600">Every tour is tailored to your interests, ensuring you get the most out of your African adventure.</p>
                </div>

                <div class="text-center">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Safety First</h3>
                    <p class="text-gray-600">Your safety is our priority. We maintain the highest safety standards on all our tours.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Recent Blog Posts -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Latest Stories</h2>
                <p class="text-lg text-gray-600">Read about recent adventures and travel tips</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($recentPosts as $post)
                    <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                        <img
                            src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : '/images/default-blog.jpg' }}"
                            alt="{{ $post->title }}"
                            class="w-full h-48 object-cover"
                        >
                        <div class="p-6">
                            <div class="text-sm text-gray-500 mb-2">
                                {{ \Carbon\Carbon::parse($post->created_at)->format('M d, Y') }}
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $post->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($post->excerpt ?? $post->content, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ ucfirst($post->type) }}
                                </span>
                                <a
                                    href="{{ route('blog.show', $post->slug) }}"
                                    class="text-green-600 hover:text-green-800 font-medium"
                                >
                                    Read More →
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-600">No blog posts available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
