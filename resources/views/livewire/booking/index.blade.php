<div class="container mx-auto px-4 py-8" id="booking-form">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">Book Your Adventure</h1>

        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        @if (!$booking_submitted)
            <div class="bg-white rounded-lg shadow-lg p-8">
                <form wire:submit.prevent="submitBooking" class="space-y-6">

                    <!-- Tour Schedule Selection -->
                    <div>
                        <label for="schedule_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Select Tour & Schedule *
                        </label>
                        <select id="schedule_id" wire:model.live="schedule_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('schedule_id') border-red-500 @enderror">
                            <option value="">Choose a tour schedule...</option>
                            @foreach($schedules as $schedule)
                                <option value="{{ $schedule->schedule_id }}">
                                    {{ $schedule->tour->title ?? 'Tour' }} -
                                    {{ $schedule->tour->destination->name ?? 'Destination' }} -
                                    {{ $schedule->start_date->format('M j, Y') }} to {{ $schedule->end_date->format('M j, Y') }} -
                                    ${{ number_format($schedule->current_price, 2) }}/person
                                    ({{ $schedule->available_slots }} spots available)
                                </option>
                            @endforeach
                        </select>
                        @error('schedule_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Schedule Details Display -->
                    @if($selected_schedule)
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h3 class="font-semibold text-blue-800 mb-2">Selected Tour Details:</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <strong>Tour:</strong> {{ $selected_schedule->tour->title ?? 'N/A' }}
                                </div>
                                <div>
                                    <strong>Destination:</strong> {{ $selected_schedule->tour->destination->name ?? 'N/A' }}
                                </div>
                                <div>
                                    <strong>Start Date:</strong> {{ $selected_schedule->start_date->format('F j, Y') }}
                                </div>
                                <div>
                                    <strong>End Date:</strong> {{ $selected_schedule->end_date->format('F j, Y') }}
                                </div>
                                <div>
                                    <strong>Price per person:</strong> ${{ number_format($selected_schedule->current_price, 2) }}
                                </div>
                                <div>
                                    <strong>Available spots:</strong> {{ $selected_schedule->available_slots }}
                                </div>
                            </div>
                            @if($selected_schedule->tour->description)
                                <div class="mt-3">
                                    <strong>Description:</strong>
                                    <p class="text-sm text-gray-700 mt-1">{{ Str::limit($selected_schedule->tour->description, 200) }}</p>
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Personal Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="user_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Full Name *
                            </label>
                            <input type="text" id="user_name" wire:model="user_name"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('user_name') border-red-500 @enderror">
                            @error('user_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="user_email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address *
                            </label>
                            <input type="email" id="user_email" wire:model="user_email"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('user_email') border-red-500 @enderror">
                            @error('user_email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="user_phone" class="block text-sm font-medium text-gray-700 mb-2">
                            Phone Number *
                        </label>
                        <input type="tel" id="user_phone" wire:model="user_phone"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('user_phone') border-red-500 @enderror">
                        @error('user_phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Booking Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="booking_date" class="block text-sm font-medium text-gray-700 mb-2">
                                Preferred Travel Date *
                            </label>
                            <input type="date" id="booking_date" wire:model="booking_date"
                                   min="{{ now()->addDay()->format('Y-m-d') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('booking_date') border-red-500 @enderror">
                            @error('booking_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="number_of_people" class="block text-sm font-medium text-gray-700 mb-2">
                                Number of People *
                            </label>
                            <select id="number_of_people" wire:model.live="number_of_people"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('number_of_people') border-red-500 @enderror">
                                @for($i = 1; $i <= 20; $i++)
                                    <option value="{{ $i }}">{{ $i }} {{ $i == 1 ? 'Person' : 'People' }}</option>
                                @endfor
                            </select>
                            @error('number_of_people') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Total Amount Display -->
                    @if($total_amount > 0)
                        <div class="bg-green-50 p-4 rounded-lg">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-semibold text-green-800">Total Amount:</span>
                                <span class="text-2xl font-bold text-green-600">${{ number_format($total_amount, 2) }}</span>
                            </div>
                            <p class="text-sm text-green-700 mt-1">
                                {{ $number_of_people }} {{ $number_of_people == 1 ? 'person' : 'people' }} ×
                                ${{ number_format($selected_schedule->current_price ?? 0, 2) }} per person
                            </p>
                        </div>
                    @endif

                    <!-- Special Requirements -->
                    <div>
                        <label for="special_request" class="block text-sm font-medium text-gray-700 mb-2">
                            Special Requirements or Requests
                        </label>
                        <textarea id="special_request" wire:model="special_request" rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('special_request') border-red-500 @enderror"
                                  placeholder="Please let us know about any dietary restrictions, accessibility needs, or special requests..."></textarea>
                        @error('special_request') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit"
                                wire:loading.attr="disabled"
                                wire:loading.class="opacity-50 cursor-not-allowed"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg transition duration-300 transform hover:scale-105 disabled:transform-none">
                            <span wire:loading.remove>Submit Booking Request</span>
                            <span wire:loading>Processing...</span>
                        </button>
                    </div>

                    <p class="text-sm text-gray-600 text-center mt-4">
                        * Required fields. We'll contact you within 24 hours to confirm your booking details and payment information.
                    </p>
                </form>
            </div>
        @else
            <!-- Booking Success Message -->
            <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                <div class="mb-6">
                    <svg class="mx-auto h-16 w-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>

                <h2 class="text-3xl font-bold text-green-600 mb-4">Booking Submitted Successfully!</h2>

                <div class="bg-green-50 p-4 rounded-lg mb-6">
                    <p class="text-lg font-semibold text-green-800">Your Booking Reference:</p>
                    <p class="text-2xl font-bold text-green-600">{{ $booking_reference }}</p>
                </div>

                <p class="text-gray-700 mb-6">
                    Thank you for choosing Rorena Tours! We have received your booking request and will contact you within 24 hours to confirm the details and provide payment instructions.
                </p>

                <div class="space-y-2 text-sm text-gray-600 mb-6">
                    <p><strong>Email:</strong> A confirmation email has been sent to {{ $user_email }}</p>
                    <p><strong>Next Steps:</strong> Our team will review your request and contact you with payment details</p>
                </div>

                <button wire:click="resetForm"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
                    Make Another Booking
                </button>
            </div>
        @endif
    </div>
</div>
