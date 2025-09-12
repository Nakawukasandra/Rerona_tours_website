<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold mb-4">Our Amazing Tours</h1>
        <p class="text-gray-600 text-lg">Discover incredible destinations with Rorena Tours</p>
    </div>

    <!-- Search and Filter Section -->
    <div class="mb-8 bg-white rounded-lg shadow-md p-6">
        <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
            <!-- Search Input -->
            <div class="flex-1 max-w-md">
                <input
                    type="text"
                    wire:model.debounce.300ms="search"
                    placeholder="Search tours or destinations..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
            </div>

            <!-- Sort Options -->
            <div class="flex gap-2">
                <button
                    wire:click="sortBy('title')"
                    class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition {{ $sortBy === 'title' ? 'bg-blue-100 text-blue-800' : '' }}"
                >
                    Name
                    @if($sortBy === 'title')
                        @if($sortDirection === 'asc') ↑ @else ↓ @endif
                    @endif
                </button>
                <button
                    wire:click="sortBy('price')"
                    class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition {{ $sortBy === 'price' ? 'bg-blue-100 text-blue-800' : '' }}"
                >
                    Price
                    @if($sortBy === 'price')
                        @if($sortDirection === 'asc') ↑ @else ↓ @endif
                    @endif
                </button>
                <button
                    wire:click="sortBy('start_date')"
                    class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition {{ $sortBy === 'start_date' ? 'bg-blue-100 text-blue-800' : '' }}"
                >
                    Start Date
                    @if($sortBy === 'start_date')
                        @if($sortDirection === 'asc') ↑ @else ↓ @endif
                    @endif
                </button>
            </div>
        </div>

        <!-- Featured Tours Filter -->
        <div class="mt-4 flex items-center">
            <label class="inline-flex items-center">
                <input
                    type="checkbox"
                    wire:model="showFeaturedOnly"
                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                >
                <span class="ml-2 text-sm text-gray-600">Show featured tours only</span>
            </label>
        </div>
    </div>

    <!-- Loading State -->
    <div wire:loading class="text-center py-4">
        <div class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-white bg-blue-500">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Loading tours...
        </div>
    </div>

    <!-- Tours Grid -->
    @if($tours->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" wire:loading.remove>
            @foreach($tours as $tour)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 {{ $tour->is_featured ? 'ring-2 ring-yellow-400' : '' }}">
                    <!-- Tour Image -->
                    @if($tour->featured_image)
                        <div class="relative h-64 overflow-hidden">
                            <img
                                src="{{ Voyager::image($tour->featured_image) }}"
                                alt="{{ $tour->title }}"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                            >
                            @if($tour->is_featured)
                                <div class="absolute top-4 left-4 bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                    ⭐ Featured
                                </div>
                            @endif

                            <!-- Tour Duration Badge -->
                            @if($tour->duration)
                                <div class="absolute top-4 right-4 bg-black bg-opacity-70 text-white px-3 py-1 rounded-full text-sm">
                                    {{ $tour->duration }}
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="h-64 bg-gray-200 flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif

                    <!-- Tour Content -->
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-gray-800 flex-1">{{ $tour->title }}</h3>
                        </div>

                        <!-- Destination -->
                        @if($tour->destination)
                            <div class="flex items-center text-sm text-blue-600 mb-2">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $tour->destination->name }}
                            </div>
                        @endif

                        @if($tour->description)
                            <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit(strip_tags($tour->description), 120) }}</p>
                        @endif

                        <!-- Tour Details -->
                        <div class="space-y-2 mb-4">
                            <!-- Tour Dates -->
                            @if($tour->start_date && $tour->end_date)
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $tour->start_date->format('M d') }} - {{ $tour->end_date->format('M d, Y') }}
                                </div>
                            @endif

                            <!-- Available Months -->
                            @php
                                $availableMonths = is_array($tour->available_months) ? $tour->available_months :
                                    (is_string($tour->available_months) ? json_decode($tour->available_months, true) : []);
                                $availableMonths = $availableMonths ?: [];
                            @endphp
                            @if($availableMonths && count($availableMonths) > 0)
                                <div class="flex items-start text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div>
                                        <span class="block">Available: </span>
                                        <span class="text-xs">{{ implode(', ', $availableMonths) }}</span>
                                    </div>
                                </div>
                            @endif

                            <!-- Departure Dates -->
                            @php
                                $departureDates = is_array($tour->departure_dates) ? $tour->departure_dates :
                                    (is_string($tour->departure_dates) ? json_decode($tour->departure_dates, true) : []);
                                $departureDates = $departureDates ?: [];
                            @endphp
                            @if($departureDates && count($departureDates) > 0)
                                <div class="flex items-start text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9 2-9-2 9-2zm0 0V9m0 10l-9-2V7l9 2v10z"></path>
                                    </svg>
                                    <div>
                                        <span class="block">Next departures:</span>
                                        <span class="text-xs">{{ implode(', ', array_slice($departureDates, 0, 3)) }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Tour Features Preview -->
                        @if($tour->features)
                            <div class="mb-4">
                                <div class="flex flex-wrap gap-1">
                                    @if($tour->features->accommodation)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-green-100 text-green-800">
                                            🏨 {{ $tour->features->accommodation }}
                                        </span>
                                    @endif
                                    @if($tour->features->meals_included)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-orange-100 text-orange-800">
                                            🍽️ Meals
                                        </span>
                                    @endif
                                    @if($tour->features->transport)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-800">
                                            🚐 {{ $tour->features->transport }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- Price and Booking -->
                        <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                            @if($tour->price)
                                <div class="text-left">
                                    <span class="text-2xl font-bold text-green-600">${{ number_format($tour->price, 2) }}</span>
                                    <span class="text-sm text-gray-500 block">per person</span>
                                </div>
                            @else
                                <div class="text-gray-500">Contact for pricing</div>
                            @endif

                            <a
                                href="{{ route('booking') }}?tour={{ $tour->id }}"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition-colors duration-200 flex items-center"
                            >
                                Book Now
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $tours->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-16" wire:loading.remove>
            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 20.4a7.962 7.962 0 01-8-7.938l3-2.647z"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No tours found</h3>
            <p class="text-gray-500">
                @if($search)
                    No tours match your search "{{ $search }}". Try adjusting your search terms.
                @else
                    Check back soon for exciting tour packages!
                @endif
            </p>
            @if($search)
                <button
                    wire:click="$set('search', '')"
                    class="mt-4 text-blue-600 hover:text-blue-800 font-medium"
                >
                    Clear search
                </button>
            @endif
        </div>
    @endif
</div>
