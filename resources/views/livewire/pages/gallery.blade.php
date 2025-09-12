<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Gallery</h1>
            <p class="text-xl md:text-2xl opacity-90">Discover the beauty of our destinations through stunning visuals</p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12">
        @if($galleries->count() > 0)
            <!-- Filter and Search Section -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                    <!-- Search -->
                    <div class="w-full md:w-1/3">
                        <input type="text" 
                               wire:model.live.debounce.300ms="search" 
                               placeholder="Search galleries..." 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <!-- Category Filter -->
                    @php
                        $categories = $galleries->pluck('category')->filter()->unique()->sort();
                    @endphp
                    
                    @if($categories->count() > 0)
                        <div class="flex flex-wrap gap-2">
                            <button wire:click="$set('selectedCategory', '')" 
                                    class="px-4 py-2 rounded-full font-medium transition-colors
                                           @if($selectedCategory === '') bg-blue-600 text-white @else bg-gray-200 text-gray-700 hover:bg-gray-300 @endif">
                                All
                            </button>
                            @foreach($categories as $category)
                                <button wire:click="$set('selectedCategory', '{{ $category }}')" 
                                        class="px-4 py-2 rounded-full font-medium transition-colors
                                               @if($selectedCategory === $category) bg-blue-600 text-white @else bg-gray-200 text-gray-700 hover:bg-gray-300 @endif">
                                    {{ ucfirst($category) }}
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Featured Galleries -->
            @if($featuredGalleries->count() > 0)
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Featured Galleries</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($featuredGalleries as $gallery)
                            <div class="gallery-item bg-white rounded-lg overflow-hidden shadow-lg">
                                <div class="relative h-64">
                                    @if($gallery->main_image)
                                        <img src="{{ asset('storage/' . $gallery->main_image) }}" 
                                             alt="{{ $gallery->title }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-gray-300 to-gray-400 flex items-center justify-center">
                                            <div class="text-center">
                                                <div class="text-4xl mb-2">📷</div>
                                                <span class="text-gray-600">No Image</span>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <div class="gallery-overlay"></div>
                                    
                                    <div class="gallery-content">
                                        <div class="flex flex-wrap gap-2 mb-2">
                                            <span class="badge badge-featured">Featured</span>
                                            @if($gallery->category)
                                                <span class="badge badge-category">{{ ucfirst($gallery->category) }}</span>
                                            @endif
                                        </div>
                                        <h3 class="text-xl font-bold mb-1">{{ $gallery->title }}</h3>
                                        @if($gallery->location)
                                            <p class="text-sm opacity-90 mb-2">📍 {{ $gallery->location }}</p>
                                        @endif
                                        @if($gallery->image_count > 0)
                                            <p class="text-sm opacity-75">{{ $gallery->image_count }} {{ $gallery->image_count === 1 ? 'photo' : 'photos' }}</p>
                                        @endif
                                    </div>
                                </div>
                                
                                @if($gallery->description)
                                    <div class="p-6">
                                        <p class="text-gray-600 mb-4 line-clamp-3">{{ $gallery->description }}</p>
                                        <a href="{{ $gallery->url }}" 
                                           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                            View Gallery 
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- All Galleries -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">
                    @if($featuredGalleries->count() > 0) All Galleries @else Our Galleries @endif
                </h2>
                
                @if($filteredGalleries->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach($filteredGalleries as $gallery)
                            <div class="gallery-item bg-white rounded-lg overflow-hidden shadow-md">
                                <div class="relative h-48">
                                    @if($gallery->main_image)
                                        <img src="{{ asset('storage/' . $gallery->main_image) }}" 
                                             alt="{{ $gallery->title }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-gray-300 to-gray-400 flex items-center justify-center">
                                            <div class="text-center">
                                                <div class="text-3xl mb-1">📷</div>
                                                <span class="text-gray-600 text-sm">No Image</span>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <div class="gallery-overlay"></div>
                                    
                                    <div class="gallery-content">
                                        <div class="flex flex-wrap gap-1 mb-2">
                                            @if($gallery->featured)
                                                <span class="badge badge-featured text-xs">Featured</span>
                                            @endif
                                            @if($gallery->category)
                                                <span class="badge badge-category text-xs">{{ ucfirst($gallery->category) }}</span>
                                            @endif
                                        </div>
                                        <h3 class="text-lg font-bold mb-1">{{ $gallery->title }}</h3>
                                        @if($gallery->location)
                                            <p class="text-sm opacity-90 mb-1">📍 {{ $gallery->location }}</p>
                                        @endif
                                        @if($gallery->image_count > 0)
                                            <p class="text-xs opacity-75">{{ $gallery->image_count }} {{ $gallery->image_count === 1 ? 'photo' : 'photos' }}</p>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="p-4">
                                    @if($gallery->description)
                                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ Str::limit($gallery->description, 80) }}</p>
                                    @endif
                                    <a href="{{ $gallery->url }}" 
                                       class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium text-sm">
                                        View Gallery 
                                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Results Info -->
                    <div class="text-center mt-8">
                        <p class="text-gray-600">
                            Showing {{ $filteredGalleries->count() }} of {{ $galleries->count() }} galleries
                        </p>
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="text-6xl mb-4">🔍</div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">No galleries found</h3>
                        <p class="text-gray-600 mb-4">
                            @if($search || $selectedCategory)
                                Try adjusting your search or filter criteria.
                            @else
                                No galleries match your current selection.
                            @endif
                        </p>
                        @if($search || $selectedCategory)
                            <button wire:click="clearFilters" 
                                    class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                Clear Filters
                            </button>
                        @endif
                    </div>
                @endif
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-20">
                <div class="max-w-md mx-auto">
                    <div class="text-8xl mb-6">📷</div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Coming Soon</h2>
                    <p class="text-gray-600 text-lg mb-8">We're curating an amazing collection of galleries to showcase the beauty of our destinations and travel experiences.</p>
                    <div class="space-y-4">
                        <a href="{{ route('destinations') }}" 
                           class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                            Explore Destinations
                        </a>
                        <p class="text-sm text-gray-500">Check back soon for stunning visual content!</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@push('styles')
<style>
    .gallery-item {
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .gallery-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 50%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }
    
    .gallery-content {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 1.5rem;
        color: white;
        transform: translateY(20px);
        transition: transform 0.3s ease;
    }
    
    .gallery-item:hover .gallery-content {
        transform: translateY(0);
    }
    
    .badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 9999px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .badge-featured {
        background-color: #f59e0b;
        color: white;
    }
    
    .badge-category {
        background-color: #3b82f6;
        color: white;
    }
    
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
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }
</style>
@endpush