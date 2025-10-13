<div>
    <!-- Hero Section -->
    <section class="relative h-screen">
        <!-- Hero Background Image -->
        <div class="absolute inset-0">
            <img src="{{ $this->getMainImageUrl() }}" alt="{{ $aboutUs->title ?? 'About Us' }}" class="w-full h-full object-cover">
        </div>
        <!-- Overlay -->
        <div class="absolute inset-0 hero-overlay"></div>

        <!-- Hero Content -->
        <div class="relative z-10 flex items-center justify-center h-full">
            <div class="text-center text-white max-w-4xl mx-auto px-4">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                    {{ $aboutUs->title ?? 'Making it real' }}
                </h1>
                <p class="text-xl md:text-2xl text-gray-200 max-w-3xl mx-auto leading-relaxed">
                    {{ $aboutUs->subtitle ?? 'We are the leading tours and safari company giving you an exceptionally new experience' }}
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="relative min-h-screen">
        <div class="absolute inset-0 bg-black"></div>
        <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
            <!-- Main Heading -->
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-12 leading-tight">
                The adventure you will have is a<br>
                life time memory that will<br>
                make you want more
            </h2>

            <!-- Description Text -->
            @if(isset($aboutUs->description) && $aboutUs->description)
            <div class="max-w-4xl mx-auto mb-16">
                <p class="text-lg text-gray-300 mb-6 leading-relaxed">
                    {{ $aboutUs->description }}
                </p>
            </div>
            @else
            <div class="max-w-4xl mx-auto mb-16">
                <p class="text-lg text-gray-300 mb-6 leading-relaxed">
                    Rorena Tours and Safaris was established to increase the number of people interested in visiting Uganda. Since then, we have expanded our itinerary to include Uganda, Rwanda, Democratic Republic of Congo (D.R.C), Tanzania and Kenya.
                </p>
                <p class="text-lg text-gray-300 leading-relaxed">
                    Rorena Tours and Safaris is a small-medium sized equipped, experienced, locally owned tours and safari company based in Kampala, Uganda. We offer quality, exceptional, affordable, budget, deluxe and luxury or highland tours to Uganda and the entire of East African countries with a personal touch.
                </p>
            </div>
            @endif

            <!-- Statistics Section -->
            @if($statistics)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-3xl mx-auto">
                @if(isset($statistics['tours_completed']))
                <div class="text-center">
                    <div class="text-6xl md:text-7xl font-bold text-white mb-4 stat-counter" data-value="{{ $statistics['tours_completed'] }}">0</div>
                    <div class="text-xl text-gray-300">Tours across East Africa</div>
                </div>
                @endif
                @if(isset($statistics['happy_customers']))
                <div class="text-center">
                    <div class="text-6xl md:text-7xl font-bold text-white mb-4 stat-counter" data-value="{{ $statistics['happy_customers'] }}">0</div>
                    <div class="text-xl text-gray-300">Happy Customers</div>
                </div>
                @endif
            </div>
            @endif
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="scroll-section relative">
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="max-w-md mx-auto">
                <div class="contact-form rounded-lg shadow-xl p-6">
                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-bold mb-2 text-white">Get In Touch With Us</h2>
                        <p class="text-sm text-gray-300">By booking your tour now</p>
                    </div>

                    <!-- Success Message -->
                    @if($showSuccess)
                    <div class="bg-green-600 text-white p-3 rounded-md mb-4 text-center relative">
                        <button wire:click="hideSuccess" type="button" class="absolute top-2 right-2 text-white hover:text-gray-200 transition-colors" aria-label="Close">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        Thank you! We'll contact you soon.
                    </div>
                    @endif

                    <!-- Error Message -->
                    @if($showError && $errorMessage)
                    <div class="bg-red-600 text-white p-3 rounded-md mb-4 relative">
                        <button wire:click="hideError" type="button" class="absolute top-2 right-2 text-white hover:text-gray-200 transition-colors" aria-label="Close">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        <div class="text-sm">{{ $errorMessage }}</div>
                    </div>
                    @endif

                    <!-- Loading Indicator -->
                    <div wire:loading wire:target="submitContact" class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-3 mb-4 rounded">
                        <div class="flex items-center text-sm">
                            <svg class="animate-spin h-4 w-4 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Sending your message...
                        </div>
                    </div>

                    <form wire:submit.prevent="submitContact" class="space-y-4">
                        <div>
                            <label for="fullName" class="block text-sm font-medium form-label mb-1">Full Name</label>
                            <input type="text" id="fullName" wire:model.blur="name" class="w-full px-3 py-2 form-input rounded-md text-sm @error('name') border-red-500 @enderror" placeholder="full name" required>
                            @error('name') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium form-label mb-1">Email Address</label>
                            <input type="email" id="email" wire:model.blur="email" class="w-full px-3 py-2 form-input rounded-md text-sm @error('email') border-red-500 @enderror" placeholder="sample@yourcompany.com" required>
                            @error('email') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium form-label mb-1">Phone Number</label>
                            <input type="tel" id="phone" wire:model.blur="phone" class="w-full px-3 py-2 form-input rounded-md text-sm @error('phone') border-red-500 @enderror" placeholder="+256 700 000000">
                            @error('phone') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="interested" class="block text-sm font-medium form-label mb-1">Interested in</label>
                            <select id="interested" wire:model="interest" class="w-full px-3 py-2 form-input rounded-md text-sm">
                                <option>Serengeti National Park tour</option>
                                <option>Kilimanjaro Trek</option>
                                <option>Ngorongoro Crater Safari</option>
                                <option>Lake Victoria Experience</option>
                                <option>Custom Safari Package</option>
                            </select>
                        </div>

                        <div>
                            <label for="persons" class="block text-sm font-medium form-label mb-1">Number of Person</label>
                            <input type="number" id="persons" wire:model.blur="persons" min="1" max="50" class="w-full px-3 py-2 form-input rounded-md text-sm @error('persons') border-red-500 @enderror" required>
                            @error('persons') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" wire:loading.attr="disabled" class="w-full bg-green-600 hover:bg-green-700 disabled:opacity-50 disabled:cursor-not-allowed text-white font-semibold py-2 px-4 rounded-md transition-colors text-sm">
                            <span wire:loading.remove wire:target="submitContact">Send Message</span>
                            <span wire:loading wire:target="submitContact">Sending...</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="scroll-section relative team-section">
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-green-400">Meet Our Team</h2>
                <p>Experience a new adventure with expert in one place</p>
            </div>
            <div class="grid md:grid-cols-3 lg:grid-cols-5 gap-8">
                <div class="team-member text-center">
                    <div class="relative mb-4">
                        <img src="https://api.dicebear.com/7.x/personas/svg?seed=JohnOpio&backgroundColor=22c55e" alt="John Opio" class="w-32 h-32 rounded-full mx-auto mb-4 bg-green-100">
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">John Opio</h3>
                    <p class="text-green-400 mb-3">CEO</p>
                </div>
                <div class="team-member text-center">
                    <div class="relative mb-4">
                        <img src="https://api.dicebear.com/7.x/personas/svg?seed=JessicaAmong&backgroundColor=34d399" alt="Jessica Among" class="w-32 h-32 rounded-full mx-auto mb-4 bg-green-100">
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Jessica Among</h3>
                    <p class="text-green-400 mb-3">Tour Expert</p>
                </div>
                <div class="team-member text-center">
                    <div class="relative mb-4">
                        <img src="https://api.dicebear.com/7.x/personas/svg?seed=DouglasAtuhaire&backgroundColor=4ade80" alt="Douglas Atuhaire" class="w-32 h-32 rounded-full mx-auto mb-4 bg-green-100">
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Douglas Atuhaire</h3>
                    <p class="text-green-400 mb-3">Tour Guide</p>
                </div>
                <div class="team-member text-center">
                    <div class="relative mb-4">
                        <img src="https://api.dicebear.com/7.x/personas/svg?seed=HassanCheptegei&backgroundColor=16a34a" alt="Hassan Cheptegei" class="w-32 h-32 rounded-full mx-auto mb-4 bg-green-100">
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Hassan Cheptegei</h3>
                    <p class="text-green-400 mb-3">Head of Transport</p>
                </div>
                <div class="team-member text-center">
                    <div class="relative mb-4">
                        <img src="https://api.dicebear.com/7.x/personas/svg?seed=JaneNankabirwa&backgroundColor=15803d" alt="Jane Nankabirwa" class="w-32 h-32 rounded-full mx-auto mb-4 bg-green-100">
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Jane Nankabirwa</h3>
                    <p class="text-green-400 mb-3">Customer Support</p>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Statistics counter animation
        document.addEventListener('DOMContentLoaded', function() {
            const stats = document.querySelectorAll('.stat-counter');
            const statsObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const stat = entry.target;
                        const finalValue = parseInt(stat.dataset.value);
                        let currentValue = 0;
                        const increment = finalValue / 100;
                        const duration = 2000;
                        const stepTime = duration / 100;

                        const counter = setInterval(() => {
                            currentValue += increment;
                            if (currentValue >= finalValue) {
                                stat.textContent = finalValue.toLocaleString();
                                clearInterval(counter);
                            } else {
                                stat.textContent = Math.floor(currentValue).toLocaleString();
                            }
                        }, stepTime);

                        statsObserver.unobserve(stat);
                    }
                });
            });

            stats.forEach(stat => statsObserver.observe(stat));
        });
    </script>
</div>
