<div>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <!-- Back to Home -->
        <a href="{{ route('home') }}" class="text-green-600 hover:text-green-800 mb-4 inline-block">
            ← Back to Home
        </a>

        <!-- Article Header -->
        <article class="bg-white">
            @if($article->image)
                <img src="{{ Voyager::image($article->image) }}" alt="{{ $article->title }}" class="w-full h-64 object-cover rounded-lg mb-6">
            @endif

            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $article->title }}</h1>

            <div class="text-gray-600 mb-6">
                <time datetime="{{ $article->created_at }}">{{ date('M d, Y', strtotime($article->created_at)) }}</time>
            </div>

            @if($article->excerpt)
                <p class="text-xl text-gray-700 mb-6 font-medium">{{ $article->excerpt }}</p>
            @endif

            <div class="prose max-w-none">
                {!! $article->body !!}
            </div>
        </article>

        <!-- Related Articles (Optional) -->
        <div class="mt-12">
            <h3 class="text-2xl font-bold mb-6">More Travel Tips</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- You can add related articles here -->
            </div>
        </div>
    </div>
</div>
