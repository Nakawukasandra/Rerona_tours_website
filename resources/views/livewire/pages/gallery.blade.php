<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Gallery</h1>
            <p class="text-xl md:text-2xl opacity-90">Discover the beauty of our destinations through stunning visuals</p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12">
        @if($allImages->count() > 0)
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

            <!-- Image Gallery Grid -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Our Gallery</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($allImages as $index => $image)
                        <div class="gallery-item bg-white rounded-lg overflow-hidden shadow-md cursor-pointer"
                             wire:click="openLightbox('{{ $image['src'] }}')">
                            <div class="relative h-48">
                                <img src="{{ $image['src'] }}"
                                     alt="{{ $image['title'] }}"
                                     class="w-full h-full object-cover">

                                <div class="gallery-overlay"></div>

                                <div class="gallery-content">
                                    <div class="flex flex-wrap gap-1 mb-2">
                                        @if($image['category'])
                                            <span class="badge badge-category text-xs">{{ ucfirst($image['category']) }}</span>
                                        @endif
                                    </div>
                                    <h3 class="text-lg font-bold mb-1">{{ $image['title'] }}</h3>
                                    @if($image['location'])
                                        <p class="text-sm opacity-90 mb-1">📍 {{ $image['location'] }}</p>
                                    @endif
                                </div>
                            </div>

                            @if($image['description'])
                                <div class="p-4">
                                    <p class="text-gray-600 text-sm line-clamp-2">{{ Str::limit($image['description'], 80) }}</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <!-- Results Info -->
                <div class="text-center mt-8">
                    <p class="text-gray-600">
                        Showing {{ $allImages->count() }} images
                        @if($search || $selectedCategory)
                            <button wire:click="clearFilters" class="ml-2 text-blue-600 hover:text-blue-800 underline">
                                Clear Filters
                            </button>
                        @endif
                    </p>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-20">
                <div class="max-w-md mx-auto">
                    <div class="text-8xl mb-6">📷</div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">No Images Found</h2>
                    <p class="text-gray-600 text-lg mb-8">
                        @if($search || $selectedCategory)
                            Try adjusting your search or filter criteria.
                        @else
                            Add some galleries in the admin panel to see them here.
                        @endif
                    </p>
                    @if($search || $selectedCategory)
                        <button wire:click="clearFilters"
                                class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                            Clear Filters
                        </button>
                    @endif
                </div>
            </div>
        @endif
    </div>

    <!-- Simple Lightbox -->
    @if($showLightbox && $selectedImage)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-90" wire:click="closeLightbox">
            <div class="relative p-4" wire:click.stop>
                <img src="{{ $selectedImage }}" alt="Gallery Image" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl">
                <button wire:click="closeLightbox" class="absolute top-2 right-2 text-white bg-black bg-opacity-50 rounded-full w-10 h-10 flex items-center justify-center hover:bg-opacity-75">
                    ✕
                </button>
            </div>
        </div>
    @endif
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
</style>
@endpush
