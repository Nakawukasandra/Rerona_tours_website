<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Shopping Cart</h1>
            <p class="text-gray-600">Review your selected tours and proceed to booking</p>
        </div>

        <!-- Flash Messages -->
        @if (session()->has('message'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded" role="alert">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if($cartCount > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-md">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900">Cart Items ({{ $cartCount }})</h2>
                        </div>

                        <div class="divide-y divide-gray-200">
                            @foreach($cartItems as $item)
                                <div class="p-6" wire:key="cart-item-{{ $item->id }}">
                                    <div class="flex flex-col sm:flex-row gap-4">
                                        <!-- Product Image -->
                                        <div class="flex-shrink-0">
                                            @if($item->product_image)
                                                <img src="{{ $item->product_image }}"
                                                     alt="{{ $item->product_name }}"
                                                     class="w-24 h-24 rounded-lg object-cover">
                                            @else
                                                <div class="w-24 h-24 bg-gray-300 rounded-lg flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Product Details -->
                                        <div class="flex-1 min-w-0">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $item->product_name }}</h3>

                                            @if($item->product_description)
                                                <p class="text-sm text-gray-600 mb-2">{{ Str::limit($item->product_description, 100) }}</p>
                                            @endif

                                            <div class="flex flex-wrap gap-4 text-sm text-gray-600 mb-3">
                                                <span class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                                    </svg>
                                                    ${{ number_format($item->price, 2) }} per person
                                                </span>

                                                @if($item->tour_date)
                                                    <span class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                        {{ $item->tour_date->format('M d, Y') }}
                                                    </span>
                                                @endif
                                            </div>

                                            <!-- Additional Options -->
                                            @if($item->additional_options && is_array($item->additional_options))
                                                <div class="mb-3">
                                                    <p class="text-sm font-medium text-gray-700 mb-1">Additional Options:</p>
                                                    <div class="flex flex-wrap gap-2">
                                                        @foreach($item->additional_options as $option => $value)
                                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                                {{ ucfirst($option) }}: {{ $value }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif

                                            <!-- Quantity and People Controls -->
                                            <div class="flex flex-wrap items-center gap-4">
                                                <!-- Quantity -->
                                                <div class="flex items-center">
                                                    <label class="text-sm font-medium text-gray-700 mr-2">Quantity:</label>
                                                    <div class="flex items-center border border-gray-300 rounded">
                                                        <button type="button"
                                                                wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})"
                                                                class="px-2 py-1 text-gray-600 hover:bg-gray-100">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                            </svg>
                                                        </button>
                                                        <span class="px-3 py-1 text-sm">{{ $item->quantity }}</span>
                                                        <button type="button"
                                                                wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})"
                                                                class="px-2 py-1 text-gray-600 hover:bg-gray-100">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>

                                                <!-- Number of People -->
                                                <div class="flex items-center">
                                                    <label class="text-sm font-medium text-gray-700 mr-2">People:</label>
                                                    <div class="flex items-center border border-gray-300 rounded">
                                                        <button type="button"
                                                                wire:click="updatePeople({{ $item->id }}, {{ $item->no_of_people - 1 }})"
                                                                class="px-2 py-1 text-gray-600 hover:bg-gray-100">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                            </svg>
                                                        </button>
                                                        <span class="px-3 py-1 text-sm">{{ $item->no_of_people }}</span>
                                                        <button type="button"
                                                                wire:click="updatePeople({{ $item->id }}, {{ $item->no_of_people + 1 }})"
                                                                class="px-2 py-1 text-gray-600 hover:bg-gray-100">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>

                                                <!-- Remove Button -->
                                                <button type="button"
                                                        wire:click="removeItem({{ $item->id }})"
                                                        wire:confirm="Are you sure you want to remove this item from your cart?"
                                                        class="text-red-600 hover:text-red-800 text-sm font-medium">
                                                    Remove
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Item Total -->
                                        <div class="text-right">
                                            <p class="text-lg font-bold text-gray-900">${{ number_format($item->total_price, 2) }}</p>
                                            <p class="text-sm text-gray-600">
                                                {{ $item->quantity }} × {{ $item->no_of_people }} people
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Order Summary</h2>

                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Items ({{ $cartCount }})</span>
                                <span class="font-medium">${{ number_format($cartTotal, 2) }}</span>
                            </div>

                            <div class="border-t border-gray-200 pt-3">
                                <div class="flex justify-between">
                                    <span class="text-lg font-semibold text-gray-900">Total</span>
                                    <span class="text-lg font-bold text-gray-900">${{ number_format($cartTotal, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <button type="button"
                                    wire:click="proceedToCheckout"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition duration-200">
                                Proceed to Booking
                            </button>

                            <button type="button"
                                    wire:click="clearCart"
                                    wire:confirm="Are you sure you want to clear your entire cart?"
                                    class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg transition duration-200">
                                Clear Cart
                            </button>
                        </div>

                        <div class="mt-6 text-center">
                            <a href="{{ route('tours') }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                                ← Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="text-center py-16">
                <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-semibold text-gray-900 mb-2">Your cart is empty</h2>
                <p class="text-gray-600 mb-6">Looks like you haven't added any tours to your cart yet.</p>
                <a href="{{ route('tours') }}"
                   class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                    </svg>
                    Browse Tours
                </a>
            </div>
        @endif
    </div>
</div>
