<!-- Main Content Area with Sidebar -->
<div class="container mx-auto px-4 py-12">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main FAQ Content -->
        <div class="lg:w-2/3">
            @if($faqs->count() > 0)
                <div class="space-y-4">
                    @foreach($faqs as $faq)
                        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden transition-all duration-200 hover:shadow-lg">
                            <!-- Question -->
                            <button
                                wire:click="toggleFaq({{ $faq->id }})"
                                class="w-full px-6 py-4 text-left focus:outline-none hover:bg-gray-50 transition-colors duration-200">
                                <div class="flex justify-between items-center gap-4">
                                    <div class="flex items-center flex-1 min-w-0">
                                        <div class="w-6 h-6 bg-green-600 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-900 break-words">{{ $faq->question }}</h3>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200 flex-shrink-0
                                               {{ $openFaq === $faq->id ? 'transform rotate-180' : '' }}"
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </button>

                            <!-- Answer -->
                            @if($openFaq === $faq->id)
                                <div class="px-6 pb-4 pt-2 border-t border-gray-100 bg-gray-50">
                                    <div class="text-gray-700 leading-relaxed">
                                        {!! nl2br(e($faq->answer)) !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-lg shadow-md p-8 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No FAQs Found</h3>
                    <p class="text-gray-600">No frequently asked questions are currently available.</p>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:w-1/3">
            <!-- Can't Find Answer? Ask Us -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Can't Find Answer? Ask Us</h3>

                @if(session('message'))
                    <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded-md text-sm">
                        {{ session('message') }}
                    </div>
                @endif

                <form wire:submit.prevent="sendMessage" class="space-y-4">
                    <!-- Full Name -->
                    <div>
                        <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" id="full_name" wire:model="form.full_name" placeholder="Full Name"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('form.full_name') border-red-500 @enderror">
                        @error('form.full_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" id="email" wire:model="form.email" placeholder="sample@yourcompany.com"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('form.email') border-red-500 @enderror">
                        @error('form.email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="tel" id="phone" wire:model="form.phone"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('form.phone') border-red-500 @enderror">
                        @error('form.phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Interested In -->
                    <div>
                        <label for="interest" class="block text-sm font-medium text-gray-700 mb-1">Interested In</label>
                        <select id="interest" wire:model="form.interest"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option value="">Select an option</option>
                            <option value="safari">Safari Tours</option>
                            <option value="cultural">Cultural Tours</option>
                            <option value="adventure">Adventure Tours</option>
                            <option value="wildlife">Wildlife Tours</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <!-- Number of Persons -->
                    <div>
                        <label for="persons" class="block text-sm font-medium text-gray-700 mb-1">Number of Person</label>
                        <input type="number" id="persons" wire:model="form.persons" placeholder="1 person" min="1"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('form.persons') border-red-500 @enderror">
                        @error('form.persons') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Send Button -->
                    <button type="submit"
                            wire:loading.attr="disabled"
                            class="w-full bg-green-600 text-white py-3 px-4 rounded-md font-medium hover:bg-green-700 transition-colors duration-200 disabled:bg-gray-400">
                        <span wire:loading.remove>Send Message</span>
                        <span wire:loading>Sending...</span>
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
