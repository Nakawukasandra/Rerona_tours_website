<div class="blog-index">
    {{-- Hero Section with Featured Posts --}}
    @if($featuredPosts->count() > 0 && !$search && !$categoryFilter)
        <section class="hero-section mb-12">
            <div class="container mx-auto px-4">
                <h1 class="text-4xl md:text-6xl font-bold text-center mb-8 text-gray-800">
                    Discover Uganda's Adventures
                </h1>
                <p class="text-xl text-center text-gray-600 mb-12 max-w-3xl mx-auto">
                    From gorilla trekking to safari adventures, explore the pearl of Africa through our curated stories and guides.
                </p>

                <div class="grid md:grid-cols-3 gap-8">
                    @foreach($featuredPosts as $post)
                        <article class="featured-post bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            @if($post->featured_image)
                                <div class="aspect-w-16 aspect-h-10">
                                    <img src="{{ Voyager::image($post->featured_image) }}"
                                         alt="{{ $post->title }}"
                                         class="w-full h-48 object-cover">
                                </div>
                            @endif
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-2">
                                    @if($post->category)
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                            {{ $post->category->name }}
                                        </span>
                                    @endif
                                    <span class="text-gray-500 text-sm">{{ $post->read_time }} min read</span>
                                </div>
                                <h3 class="text-xl font-bold mb-3 text-gray-800 line-clamp-2">
                                    <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-green-600 transition-colors">
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                <p class="text-gray-600 mb-4 line-clamp-3">{{ $post->excerpt }}</p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="text-sm text-gray-500">By {{ $post->author->name }}</span>
                                    </div>
                                    <span class="text-sm text-gray-500">{{ $post->published_at->format('M j, Y') }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Filters Section --}}
    <section class="filters-section mb-8">
        <div class="container mx-auto px-4">
            <div class="bg-white rounded-lg shadow-sm border p-6">
                <div class="grid md:grid-cols-4 lg:grid-cols-5 gap-4 items-end">
                    {{-- Search --}}
                    <div class="md:col-span-2">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                        <input type="text"
                               wire:model.live.debounce.300ms="search"
                               id="search"
                               placeholder="Search posts..."
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    </div>

                    {{-- Category Filter --}}
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                        <select wire:model.live="categoryFilter"
                                id="category"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Sort By --}}
                    <div>
                        <label for="sortBy" class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                        <select wire:model.live="sortBy"
                                id="sortBy"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <option value="latest">Latest</option>
                            <option value="oldest">Oldest</option>
                            <option value="title">Title A-Z</option>
                            <option value="popular">Popular</option>
                        </select>
                    </div>

                    {{-- Clear Filters --}}
                    <div>
                        <button wire:click="clearFilters"
                                class="w-full px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                            Clear Filters
                        </button>
                    </div>
                </div>

                {{-- Featured Only Toggle --}}
                <div class="mt-4 flex items-center">
                    <label class="flex items-center">
                        <input type="checkbox"
                               wire:model.live="featuredOnly"
                               class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-600">Show featured posts only</span>
                    </label>
                </div>
            </div>
        </div>
    </section>

    {{-- Posts Grid --}}
    <section class="posts-section">
        <div class="container mx-auto px-4">
            @if($posts->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
                    @foreach($posts as $post)
                        <article class="post-card bg-white rounded-lg shadow-sm border overflow-hidden hover:shadow-md transition-shadow duration-300">
                            @if($post->featured_image)
                                <div class="aspect-w-16 aspect-h-10">
                                    <img src="{{ Voyager::image($post->featured_image) }}"
                                         alt="{{ $post->title }}"
                                         class="w-full h-48 object-cover">
                                </div>
                            @endif

                            <div class="p-6">
                                <div class="flex items-center justify-between mb-3">
                                    @if($post->category)
                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-medium">
                                            {{ $post->category->name }}
                                        </span>
                                    @endif

                                    @if($post->featured)
                                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-medium">
                                            Featured
                                        </span>
                                    @endif

                                    <span class="text-gray-500 text-xs">{{ $post->read_time }} min read</span>
                                </div>

                                <h2 class="text-xl font-bold mb-3 text-gray-800 line-clamp-2">
                                    <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-green-600 transition-colors">
                                        {{ $post->title }}
                                    </a>
                                </h2>

                                <p class="text-gray-600 mb-4 line-clamp-3">{{ $post->excerpt }}</p>

                                {{-- Safari/Tourism Tags --}}
                                @if($post->getTourismTags())
                                    <div class="flex flex-wrap gap-1 mb-4">
                                        @foreach($post->getTourismTags() as $tag)
                                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">
                                                {{ $tag }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <span>By {{ $post->author->name }}</span>
                                    </div>
                                    <span>{{ $post->published_at->format('M j, Y') }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="flex justify-center">
                    {{ $posts->links() }}
                </div>
            @else
                {{-- No Posts Found --}}
                <div class="text-center py-12">
                    <div class="max-w-md mx-auto">
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No posts found</h3>
                        <p class="text-gray-500 mb-4">
                            @if($search || $categoryFilter || $featuredOnly)
                                Try adjusting your filters or search terms.
                            @else
                                There are no published posts yet.
                            @endif
                        </p>
                        @if($search || $categoryFilter || $featuredOnly)
                            <button wire:click="clearFilters"
                                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                                Clear Filters
                            </button>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </section>
</div>
