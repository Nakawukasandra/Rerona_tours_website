<div class="min-h-screen bg-gray-50">
    {{-- Hero Section --}}
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="text-5xl font-bold mb-4">Our Services</h1>
                <p class="text-xl text-blue-100 mb-8">Discover amazing tour packages and experiences</p>

                {{-- Quick Search --}}
                <div class="max-w-2xl mx-auto">
                    <div class="relative">
                        <input type="text"
                               wire:model.live.debounce.300ms="search"
                               placeholder="Search for tours, safaris, adventures..."
                               class="w-full px-6 py-4 text-lg text-gray-800 rounded-full border-0 focus:ring-4 focus:ring-blue-300 focus:outline-none shadow-lg">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-6">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        {{-- Filters Section --}}
        <div class="bg-white rounded-lg shadow-sm mb-8 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                {{-- Category Filter --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select wire:model.live="category" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}">{{ ucfirst($cat) }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Difficulty Level Filter --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Difficulty</label>
                    <select wire:model.live="difficultyLevel" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Levels</option>
                        @foreach($difficultyLevels as $level)
                            <option value="{{ $level }}">{{ ucfirst($level) }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Price Range Filter --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Price Range</label>
                    <select wire:model.live="priceRange" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Prices</option>
                        <option value="under_100">Under $100</option>
                        <option value="100_500">$100 - $500</option>
                        <option value="500_1000">$500 - $1,000</option>
                        <option value="over_1000">Over $1,000</option>
                    </select>
                </div>

                {{-- Sort Options --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                    <select wire:model.live="sortBy" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="name">Name</option>
                        <option value="price">Price</option>
                        <option value="duration">Duration</option>
                        <option value="featured">Featured First</option>
                    </select>
                </div>

                {{-- Clear Filters --}}
                <div class="flex items-end">
                    <button wire:click="clearFilters" class="w-full px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md transition-colors duration-200">
                        Clear Filters
                    </button>
                </div>
            </div>
        </div>

        {{-- Results Summary --}}
        <div class="flex justify-between items-center mb-6">
            <div class="text-sm text-gray-600">
                Showing {{ $services->count() }} of {{ $services->total() }} services
                @if($search)
                    for "<span class="font-semibold">{{ $search }}</span>"
                @endif
            </div>

            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-600">Sort:</span>
                <button wire:click="sortBy('name')" class="text-sm {{ $sortBy === 'name' ? 'text-blue-600 font-semibold' : 'text-gray-500' }} hover:text-blue-600">
                    Name
                    @if($sortBy === 'name')
                        <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                    @endif
                </button>
                <span class="text-gray-300">|</span>
                <button wire:click="sortBy('price')" class="text-sm {{ $sortBy === 'price' ? 'text-blue-600 font-semibold' : 'text-gray-500' }} hover:text-blue-600">
                    Price
                    @if($sortBy === 'price')
                        <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                    @endif
                </button>
            </div>
        </div>

        {{-- Services Grid --}}
        @if($services->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
                @foreach($services as $service)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        {{-- Service Image --}}
                        <div class="relative">
                            @if($service->first_image)
                                <img src="{{ asset('storage/' . $service->first_image) }}"
                                     alt="{{ $service->name }}"
                                     class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                                    <span class="text-white text-4xl">🏝️</span>
                                </div>
                            @endif

                            {{-- Featured Badge --}}
                            @if($service->is_featured)
                                <div class="absolute top-4 left-4">
                                    <span class="bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-semibold">
                                        ⭐ Featured
                                    </span>
                                </div>
                            @endif

                            {{-- Discount Badge --}}
                            @if($service->has_discount)
                                <div class="absolute top-4 right-4">
                                    <span class="bg-red-500 text-white px-2 py-1 rounded-full text-xs font-semibold">
                                        -{{ $service->discount_percentage }}%
                                    </span>
                                </div>
                            @endif
                        </div>

                        {{-- Service Content --}}
                        <div class="p-6">
                            {{-- Category & Difficulty --}}
                            <div class="flex items-center justify-between mb-3">
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">
                                    {{ ucfirst($service->category) }}
                                </span>
                                <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
                                    {{ ucfirst($service->difficulty_level) }}
                                </span>
                            </div>

                            {{-- Service Name --}}
                            <h3 class="text-xl font-bold text-gray-800 mb-2 line-clamp-2">{{ $service->name }}</h3>

                            {{-- Short Description --}}
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ $service->short_description ?: Str::limit($service->description, 100) }}
                            </p>

                            {{-- Duration & Guests --}}
                            <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $service->duration_text }}
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                    </svg>
                                    {{ $service->min_guests }}-{{ $service->max_guests }} guests
                                </span>
                            </div>

                            {{-- Pricing & Book Button --}}
                            <div class="flex items-center justify-between">
                                <div class="price-section">
                                    @if($service->has_discount)
                                        <div class="flex items-center space-x-2">
                                            <span class="text-2xl font-bold text-green-600">${{ $service->formatted_discount_price }}</span>
                                            <span class="text-lg text-gray-500 line-through">${{ $service->formatted_price }}</span>
                                        </div>
                                    @else
                                        <span class="text-2xl font-bold text-green-600">${{ $service->formatted_price }}</span>
                                    @endif
                                    <div class="text-xs text-gray-500">per person</div>
                                </div>

                                <div class="flex flex-col space-y-2">
                                    <a href="{{ route('services', $service->slug) }}"
                                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors duration-200 text-center">
                                        View Details
                                    </a>
                                    <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors duration-200">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="flex justify-center">
                {{ $services->links() }}
            </div>
        @else
            {{-- No Results --}}
            <div class="text-center py-16">
                <div class="text-gray-400 text-6xl mb-6">🔍</div>
                <h3 class="text-2xl font-semibold text-gray-600 mb-4">No services found</h3>
                <p class="text-gray-500 mb-8">
                    @if($search || $category || $difficultyLevel || $priceRange)
                        Try adjusting your search criteria or filters
                    @else
                        Check back soon for exciting tour packages!
                    @endif
                </p>
                @if($search || $category || $difficultyLevel || $priceRange)
                    <button wire:click="clearFilters" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors duration-200">
                        Clear All Filters
                    </button>
                @endif
            </div>
        @endif
    </div>
</div>
