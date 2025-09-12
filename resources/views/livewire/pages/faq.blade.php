<div class="min-h-screen bg-gray-50">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Frequently Asked Questions</h1>
                <p class="text-xl text-blue-100 max-w-2xl mx-auto">
                    Find answers to common questions about Rorena Tours and our services
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12">
        <!-- Category Filter -->
        @if($categories->count() > 0)
            <div class="mb-8">
                <div class="flex flex-wrap gap-2 justify-center">
                    <button
                        wire:click="filterByCategory('all')"
                        class="px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200
                               {{ $selectedCategory === 'all' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}
                               border border-gray-300 shadow-sm">
                        All Questions
                    </button>
                    @foreach($categories as $category)
                        <button
                            wire:click="filterByCategory('{{ $category }}')"
                            class="px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200 capitalize
                                   {{ $selectedCategory === $category ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}
                                   border border-gray-300 shadow-sm">
                            {{ str_replace(['_', '-'], ' ', $category) }}
                        </button>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- FAQ Items -->
        <div class="max-w-4xl mx-auto">
            @if($faqs->count() > 0)
                <div class="space-y-4">
                    @foreach($faqs as $faq)
                        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden transition-all duration-200 hover:shadow-lg">
                            <!-- Question -->
                            <button
                                wire:click="toggleFaq({{ $faq->id }})"
                                class="w-full px-6 py-4 text-left focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-inset
                                       hover:bg-gray-50 transition-colors duration-200">
                                <div class="flex justify-between items-center">
                                    <div class="flex-1 pr-4">
                                        <h3 class="text-lg font-semibold text-gray-900">
                                            {{ $faq->question }}
                                        </h3>
                                        @if($faq->category)
                                            <span class="inline-block mt-2 px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full capitalize">
                                                {{ str_replace(['_', '-'], ' ', $faq->category) }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="flex-shrink-0">
                                        <svg
                                            class="w-5 h-5 text-gray-500 transition-transform duration-200
                                                   {{ $openFaq === $faq->id ? 'transform rotate-180' : '' }}"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </button>

                            <!-- Answer -->
                            <div class="transition-all duration-300 ease-in-out {{ $openFaq === $faq->id ? 'block' : 'hidden' }}">
                                <div class="px-6 pb-4 pt-2 border-t border-gray-100 bg-gray-50">
                                    <div class="text-gray-700 leading-relaxed">
                                        {!! nl2br(e($faq->answer)) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- No FAQs Found -->
                <div class="text-center py-12">
                    <div class="bg-white rounded-lg shadow-md p-8">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No FAQs Found</h3>
                        <p class="text-gray-600">
                            @if($selectedCategory !== 'all')
                                No questions found for the "{{ str_replace(['_', '-'], ' ', $selectedCategory) }}" category.
                            @else
                                No frequently asked questions are currently available.
                            @endif
                        </p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Contact Section -->
        <div class="mt-16 bg-white rounded-lg shadow-md p-8 max-w-2xl mx-auto text-center">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Still Have Questions?</h2>
            <p class="text-gray-600 mb-6">
                Can't find what you're looking for? Our friendly team is here to help you plan your perfect tour.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="mailto:info@rorenatours.com"
                   class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg
                          hover:bg-blue-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                    Email Us
                </a>
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center justify-center px-6 py-3 bg-green-600 text-white font-medium rounded-lg
                          hover:bg-green-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                        </path>
                    </svg>
                    Contact Us
                </a>
            </div>
        </div>
    </div>

    <!-- Loading State -->
    <div wire:loading class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 shadow-xl">
            <div class="flex items-center space-x-3">
                <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
                <span class="text-gray-700 font-medium">Loading...</span>
            </div>
        </div>
    </div>
</div>
