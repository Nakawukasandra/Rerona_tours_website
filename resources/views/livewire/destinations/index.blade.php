<div>
    <!-- Hero Section -->
    <div class="relative h-96 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/hero-destinations.jpg') }}');">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>

        <!-- Content -->
        <div class="relative z-10 flex items-center justify-center h-full">
            <div class="text-center text-white px-4">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Traveler's destinations</h1>
                <p class="text-lg md:text-xl opacity-90">Popular places for travelers in East Africa</p>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="flex flex-col md:flex-row gap-4">
                <!-- Search Input -->
                <div class="flex-1">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search Destinations</label>
                    <input
                        type="text"
                        id="search"
                        wire:model.live="searchTerm"
                        placeholder="Search by name, city, or description..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                </div>

                <!-- Country Filter -->
                <div class="md:w-64">
                    <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Filter by Country</label>
                    <select
                        id="country"
                        wire:model.live="selectedCountry"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                        <option value="">All Countries</option>
                        @foreach($countries as $country)
                            <option value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Clear Filters Button -->
                <div class="md:w-32 flex items-end">
                    <button
                        wire:click="clearFilters"
                        class="w-full px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-200"
                    >
                        Clear
                    </button>
                </div>
            </div>
        </div>

        <!-- Results Count -->
        <div class="mb-6">
            <p class="text-gray-600">
                Showing {{ count($destinations) }} destination{{ count($destinations) !== 1 ? 's' : '' }}
                @if($searchTerm || $selectedCountry)
                    matching your filters
                @endif
            </p>
        </div>

        <!-- Destinations Grid -->
        @if(count($destinations) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($destinations as $destination)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                        <!-- Destination Image -->
                        @if($destination->featured_image)
                            <div class="h-48 bg-gray-200 overflow-hidden">
                                <img
                                    src="{{ asset('storage/' . $destination->featured_image) }}"
                                    alt="{{ $destination->name }}"
                                    class="w-full h-full object-cover hover:scale-105 transition duration-300"
                                >
                            </div>
                        @else
                            <div class="h-48 bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                <span class="text-white text-lg font-semibold">{{ substr($destination->name, 0, 1) }}</span>
                            </div>
                        @endif

                        <!-- Destination Content -->
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-xl font-bold text-gray-800">{{ $destination->name }}</h3>
                                @if($destination->tours_count > 0)
                                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">
                                        {{ $destination->tours_count }} tour{{ $destination->tours_count !== 1 ? 's' : '' }}
                                    </span>
                                @endif
                            </div>

                            <div class="flex items-center text-gray-600 mb-3">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-sm">
                                    {{ $destination->city }}@if($destination->city && $destination->country), @endif{{ $destination->country }}
                                </span>
                            </div>

                            @if($destination->description)
                                <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                                    {{ Str::limit($destination->description, 120) }}
                                </p>
                            @endif

                            <!-- Action Buttons -->
                            <div class="flex gap-2">
                                <a
                                    href="{{ route('tours') }}?destination={{ $destination->slug }}"
                                    class="flex-1 bg-blue-600 text-white text-center py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200 text-sm font-medium"
                                >
                                    View Tours
                                </a>
                                <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- No Results State -->
            <div class="text-center py-12">
                <div class="mb-4">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No destinations found</h3>
                <p class="text-gray-500 mb-4">
                    @if($searchTerm || $selectedCountry)
                        Try adjusting your search filters or clear them to see all destinations.
                    @else
                        No destinations are currently available.
                    @endif
                </p>
                @if($searchTerm || $selectedCountry)
                    <button
                        wire:click="clearFilters"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200"
                    >
                        Clear Filters
                    </button>
                @endif
            </div>
        @endif
    </div>
</div>
