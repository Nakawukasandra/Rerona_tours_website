<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-green-600 to-blue-600 text-white py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold text-center mb-4">Rorena Tours Shop</h1>
            <p class="text-xl text-center max-w-2xl mx-auto">Discover authentic Ugandan crafts, art, and souvenirs from our travels</p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <!-- Filters and Search -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                <!-- Search -->
                <div class="md:col-span-2">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search Products</label>
                    <input
                        type="text"
                        id="search"
                        wire:model.live.debounce.300ms="search"
                        placeholder="Search by name or description..."
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                    >
                </div>

                <!-- Category Filter -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select
                        id="category"
                        wire:model.live="selectedCategory"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                    >
                        <option value="">All Categories</option>
                        @foreach($categories as $key => $category)
                            <option value="{{ $key }}">{{ $category }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Sort -->
                <div>
                    <label for="sort" class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                    <select
                        wire:model.live="sortBy"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                    >
                        <option value="name">Name</option>
                        <option value="price">Price</option>
                        <option value="created_at">Newest</option>
                        <option value="sort_order">Featured</option>
                    </select>
                </div>
            </div>

            <!-- Filter Options -->
            <div class="flex flex-wrap gap-4 items-center">
                <label class="flex items-center">
                    <input
                        type="checkbox"
                        wire:model.live="showFeaturedOnly"
                        class="mr-2 text-green-600 focus:ring-green-500"
                    >
                    <span class="text-sm text-gray-700">Featured Only</span>
                </label>

                <button
                    wire:click="clearFilters"
                    class="text-sm text-red-600 hover:text-red-800 underline"
                >
                    Clear All Filters
                </button>

                <div class="ml-auto flex items-center gap-2">
                    <span class="text-sm text-gray-600">{{ $products->total() }} items</span>
                    <button
                        wire:click="sortBy('{{ $sortBy }}')"
                        class="text-sm text-gray-500 hover:text-gray-700"
                    >
                        @if($sortDirection === 'asc')
                            ↑
                        @else
                            ↓
                        @endif
                    </button>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                @foreach($products as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <!-- Product Image -->
                        <div class="relative aspect-square bg-gray-200">
                            <img
                                src="{{ $product->featured_image_url }}"
                                alt="{{ $product->name }}"
                                class="w-full h-full object-cover"
                                loading="lazy"
                            >

                            <!-- Badges -->
                            <div class="absolute top-2 left-2 flex flex-col gap-1">
                                @if($product->is_featured)
                                    <span class="bg-yellow-500 text-white text-xs px-2 py-1 rounded-full">Featured</span>
                                @endif
                                @if($product->is_handmade)
                                    <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full">Handmade</span>
                                @endif
                                @if($product->is_on_sale)
                                    <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                                        -{{ $product->discount_percentage }}%
                                    </span>
                                @endif
                            </div>

                            @if(!$product->in_stock)
                                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                                    <span class="text-white font-bold text-lg">Out of Stock</span>
                                </div>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div class="p-4">
                            <h3 class="font-semibold text-lg text-gray-900 mb-2 line-clamp-2">{{ $product->name }}</h3>

                            @if($product->short_description)
                                <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $product->short_description }}</p>
                            @endif

                            <!-- Category -->
                            @if($product->category)
                                <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full mb-3">
                                    {{ $categories[$product->category] ?? $product->category }}
                                </span>
                            @endif

                            <!-- Price -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    @if($product->is_on_sale)
                                        <span class="text-lg font-bold text-red-600">{{ $product->formatted_sale_price }}</span>
                                        <span class="text-sm text-gray-500 line-through">{{ $product->formatted_price }}</span>
                                    @else
                                        <span class="text-lg font-bold text-gray-900">{{ $product->formatted_price }}</span>
                                    @endif
                                </div>

                                @if($product->sku)
                                    <span class="text-xs text-gray-500">{{ $product->sku }}</span>
                                @endif
                            </div>

                            <!-- Stock Info -->
                            @if($product->manage_stock)
                                <div class="mt-2">
                                    @if($product->stock_quantity > 0)
                                        <span class="text-xs text-green-600">{{ $product->stock_quantity }} in stock</span>
                                    @else
                                        <span class="text-xs text-red-600">Out of stock</span>
                                    @endif
                                </div>
                            @endif

                            <!-- Action Button -->
                            <div class="mt-4">
                                @if($product->in_stock)
                                    <button class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition-colors duration-200">
                                        View Details
                                    </button>
                                @else
                                    <button disabled class="w-full bg-gray-300 text-gray-500 font-medium py-2 px-4 rounded-md cursor-not-allowed">
                                        Out of Stock
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center">
                {{ $products->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <div class="text-gray-400 mb-4">
                    <svg class="mx-auto h-16 w-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-medium text-gray-900 mb-2">No products found</h3>
                <p class="text-gray-600 mb-4">
                    @if($search || $selectedCategory || $showFeaturedOnly)
                        Try adjusting your filters or search terms.
                    @else
                        We're currently updating our inventory. Please check back soon!
                    @endif
                </p>
                @if($search || $selectedCategory || $showFeaturedOnly)
                    <button
                        wire:click="clearFilters"
                        class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md"
                    >
                        Clear Filters
                    </button>
                @endif
            </div>
        @endif
    </div>

    <!-- Loading Indicator -->
    <div wire:loading class="fixed inset-0 bg-black bg-opacity-25 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 flex items-center gap-3">
            <svg class="animate-spin h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="text-gray-700">Loading...</span>
        </div>
    </div>

    <style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    </style>
</div>
