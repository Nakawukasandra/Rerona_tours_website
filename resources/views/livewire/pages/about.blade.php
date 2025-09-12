<div>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto">
            <!-- Hero Section -->
            <div class="text-center mb-12">
                <h1 class="text-5xl font-bold text-gray-800 mb-4">{{ $aboutUs->title ?? 'About Rorena Tours' }}</h1>
                @if($aboutUs->subtitle)
                    <p class="text-xl text-gray-600 mb-6">{{ $aboutUs->subtitle }}</p>
                @endif

                @if($aboutUs->main_image_url)
                    <div class="relative mx-auto max-w-4xl mb-8">
                        <img src="{{ $aboutUs->main_image_url }}"
                             alt="{{ $aboutUs->title }}"
                             class="w-full h-96 object-cover rounded-lg shadow-lg">
                        <div class="absolute inset-0 bg-black bg-opacity-30 rounded-lg"></div>
                    </div>
                @endif
            </div>

            <!-- Description Section -->
            @if($aboutUs->description)
                <div class="text-center mb-16">
                    <div class="prose prose-lg mx-auto">
                        <p class="text-lg text-gray-600 leading-relaxed">
                            {!! nl2br(e($aboutUs->description)) !!}
                        </p>
                    </div>
                </div>
            @endif

            <!-- Statistics Section -->
            @php
                $stats = $aboutUs->stats;
            @endphp
            @if(array_sum($stats) > 0)
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-16 px-8 rounded-lg mb-16">
                    <h2 class="text-3xl font-bold text-center mb-12">Our Achievements</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                        @if($stats['years_experience'] > 0)
                            <div class="text-center">
                                <div class="text-4xl font-bold mb-2">{{ $stats['years_experience'] }}+</div>
                                <div class="text-blue-100">Years Experience</div>
                            </div>
                        @endif

                        @if($stats['happy_clients'] > 0)
                            <div class="text-center">
                                <div class="text-4xl font-bold mb-2">{{ number_format($stats['happy_clients']) }}+</div>
                                <div class="text-blue-100">Happy Clients</div>
                            </div>
                        @endif

                        @if($stats['tours_completed'] > 0)
                            <div class="text-center">
                                <div class="text-4xl font-bold mb-2">{{ number_format($stats['tours_completed']) }}+</div>
                                <div class="text-blue-100">Tours Completed</div>
                            </div>
                        @endif

                        @if($stats['destinations'] > 0)
                            <div class="text-center">
                                <div class="text-4xl font-bold mb-2">{{ $stats['destinations'] }}+</div>
                                <div class="text-blue-100">Destinations</div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Mission & Vision Section -->
            @if($aboutUs->mission || $aboutUs->vision)
                <div class="grid md:grid-cols-2 gap-8 mb-16">
                    @if($aboutUs->mission)
                        <div class="bg-white p-8 rounded-lg shadow-lg border-l-4 border-blue-500">
                            <h3 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                                <svg class="w-8 h-8 text-blue-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Our Mission
                            </h3>
                            <p class="text-gray-600 leading-relaxed">{!! nl2br(e($aboutUs->mission)) !!}</p>
                        </div>
                    @endif

                    @if($aboutUs->vision)
                        <div class="bg-white p-8 rounded-lg shadow-lg border-l-4 border-purple-500">
                            <h3 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                                <svg class="w-8 h-8 text-purple-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                Our Vision
                            </h3>
                            <p class="text-gray-600 leading-relaxed">{!! nl2br(e($aboutUs->vision)) !!}</p>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Company Values Section -->
            @php
                $values = $aboutUs->company_values;
            @endphp
            @if(!empty($values))
                <div class="mb-16">
                    <h2 class="text-3xl font-bold text-gray-800 text-center mb-12">Our Values</h2>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($values as $value)
                            <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-6 rounded-lg hover:shadow-lg transition duration-300">
                                @if(is_array($value))
                                    <h4 class="font-bold text-gray-800 mb-3">{{ $value['title'] ?? 'Our Value' }}</h4>
                                    <p class="text-gray-600 text-sm">{{ $value['description'] ?? '' }}</p>
                                @else
                                    <p class="text-gray-700 font-medium">{{ $value }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Gallery Section -->
            @php
                $galleryImages = $aboutUs->gallery_images_urls;
            @endphp
            @if(!empty($galleryImages))
                <div class="mb-16">
                    <h2 class="text-3xl font-bold text-gray-800 text-center mb-12">Our Gallery</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach($galleryImages as $image)
                            <div class="relative overflow-hidden rounded-lg shadow-md hover:shadow-lg transition duration-300">
                                <img src="{{ $image }}"
                                     alt="Gallery Image"
                                     class="w-full h-48 object-cover hover:scale-105 transition duration-300">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Contact Section -->
            @php
                $contactInfo = $aboutUs->contact_info;
                $socialMedia = $aboutUs->social_media_links;
            @endphp
            @if($contactInfo['phone'] || $contactInfo['email'] || $contactInfo['address'])
                <div class="bg-gray-50 p-8 rounded-lg mb-16">
                    <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">Get In Touch</h2>
                    <div class="grid md:grid-cols-3 gap-8 text-center">
                        @if($contactInfo['phone'])
                            <div class="flex flex-col items-center">
                                <svg class="w-8 h-8 text-blue-600 mb-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                </svg>
                                <h4 class="font-semibold text-gray-800 mb-2">Phone</h4>
                                <p class="text-gray-600">{{ $contactInfo['phone'] }}</p>
                            </div>
                        @endif

                        @if($contactInfo['email'])
                            <div class="flex flex-col items-center">
                                <svg class="w-8 h-8 text-blue-600 mb-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                </svg>
                                <h4 class="font-semibold text-gray-800 mb-2">Email</h4>
                                <p class="text-gray-600">{{ $contactInfo['email'] }}</p>
                            </div>
                        @endif

                        @if($contactInfo['address'])
                            <div class="flex flex-col items-center">
                                <svg class="w-8 h-8 text-blue-600 mb-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"/>
                                </svg>
                                <h4 class="font-semibold text-gray-800 mb-2">Address</h4>
                                <p class="text-gray-600">{{ $contactInfo['address'] }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- Social Media Links -->
                    @if(array_filter($socialMedia))
                        <div class="text-center mt-8">
                            <h4 class="font-semibold text-gray-800 mb-4">Follow Us</h4>
                            <div class="flex justify-center space-x-4">
                                @foreach($socialMedia as $platform => $url)
                                    @if($url)
                                        <a href="{{ $url }}"
                                           target="_blank"
                                           class="w-10 h-10 bg-gray-600 hover:bg-blue-600 text-white rounded-full flex items-center justify-center transition duration-300">
                                            <span class="sr-only">{{ ucfirst($platform) }}</span>
                                            @switch($platform)
                                                @case('facebook')
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                                    @break
                                                @case('twitter')
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                                                    @break
                                                @case('instagram')
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987 6.62 0 11.987-5.367 11.987-11.987C24.014 5.367 18.637.001 12.017.001zM8.449 16.988c-2.289 0-4.149-1.86-4.149-4.149s1.86-4.149 4.149-4.149 4.149 1.86 4.149 4.149-1.86 4.149-4.149 4.149zm7.718 0c-2.289 0-4.149-1.86-4.149-4.149s1.86-4.149 4.149-4.149 4.149 1.86 4.149 4.149-1.86 4.149-4.149 4.149z"/></svg>
                                                    @break
                                                @default
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.374 0 0 5.373 0 12s5.374 12 12 12 12-5.373 12-12S18.626 0 12 0z"/></svg>
                                            @endswitch
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Call to Action -->
            <div class="text-center bg-gradient-to-r from-blue-600 to-purple-600 text-white p-12 rounded-lg">
                <h3 class="text-3xl font-bold mb-4">Ready to Start Your Adventure?</h3>
                <p class="text-xl mb-8 text-blue-100">
                    Join thousands of satisfied travelers who have discovered the magic of authentic experiences with Rorena Tours.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('tours') }}"
                       class="bg-white text-blue-600 px-8 py-3 rounded-lg font-bold text-lg hover:bg-blue-50 transition duration-300">
                        Browse Tours
                    </a>
                    <a href="{{ route('contact') }}"
                       class="border-2 border-white text-white px-8 py-3 rounded-lg font-bold text-lg hover:bg-white hover:text-blue-600 transition duration-300">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
