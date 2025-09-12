<?php

namespace App\Livewire\Booking;

use App\Models\Booking;
use App\Models\Tour;
use App\Models\TourSchedule;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    // Form properties
    public $schedule_id = '';
    public $number_of_people = 1;
    public $booking_date = '';
    public $special_request = '';
    public $user_name = '';
    public $user_email = '';
    public $user_phone = '';

    // Component state
    public $schedules = [];
    public $selected_schedule = null;
    public $total_amount = 0;
    public $booking_submitted = false;
    public $booking_reference = '';

    protected $rules = [
        'schedule_id' => 'required|exists:tour_schedules,schedule_id',
        'number_of_people' => 'required|integer|min:1|max:20',
        'booking_date' => 'required|date|after:today',
        'user_name' => 'required|string|min:2|max:100',
        'user_email' => 'required|email',
        'user_phone' => 'required|string|min:10',
        'special_request' => 'nullable|string|max:1000',
    ];

    protected $messages = [
        'schedule_id.required' => 'Please select a tour schedule.',
        'schedule_id.exists' => 'The selected schedule is invalid.',
        'number_of_people.required' => 'Please specify the number of people.',
        'number_of_people.min' => 'At least 1 person is required.',
        'number_of_people.max' => 'Maximum 20 people allowed.',
        'booking_date.required' => 'Please select your preferred travel date.',
        'booking_date.after' => 'Booking date must be in the future.',
        'user_name.required' => 'Please enter your full name.',
        'user_email.required' => 'Please enter your email address.',
        'user_email.email' => 'Please enter a valid email address.',
        'user_phone.required' => 'Please enter your phone number.',
    ];

    public function mount()
    {
        // Load available tour schedules
        $this->schedules = TourSchedule::with(['tour', 'tour.destination'])
            ->active()
            ->upcoming()
            ->available()
            ->orderBy('start_date')
            ->get();

        // Set default booking date to tomorrow
        $this->booking_date = now()->addDay()->format('Y-m-d');

        // Pre-fill user data if authenticated
        if (Auth::check()) {
            $user = Auth::user();
            $this->user_name = $user->name;
            $this->user_email = $user->email;
            $this->user_phone = $user->phone ?? '';
        }
    }

    public function updatedScheduleId()
    {
        if ($this->schedule_id) {
            $this->selected_schedule = TourSchedule::with(['tour', 'tour.destination'])
                ->where('schedule_id', $this->schedule_id)
                ->first();
            $this->calculateTotal();
        } else {
            $this->selected_schedule = null;
            $this->total_amount = 0;
        }
    }

    public function updatedNumberOfPeople()
    {
        $this->calculateTotal();
    }

    private function calculateTotal()
    {
        if ($this->selected_schedule && $this->number_of_people) {
            $this->total_amount = $this->selected_schedule->current_price * $this->number_of_people;
        }
    }

    public function submitBooking()
    {
        $this->validate();

        try {
            // Create or get user
            $user = $this->getOrCreateUser();

            // Generate booking reference
            $this->booking_reference = 'BK-' . strtoupper(Str::random(8));

            // Create booking
            $booking = Booking::create([
                'user_id' => $user->id,
                'schedule_id' => $this->schedule_id,
                'booking_reference' => $this->booking_reference,
                'number_of_people' => $this->number_of_people,
                'total_amount' => $this->total_amount,
                'paid_amount' => 0,
                'pending_amount' => $this->total_amount,
                'booking_status' => 'pending',
                'booking_date' => $this->booking_date,
                'special_request' => $this->special_request,
            ]);

            // Update available slots in tour schedule
            $schedule = TourSchedule::find($this->schedule_id);
            if ($schedule) {
                $schedule->available_slots = max(0, $schedule->available_slots - $this->number_of_people);
                $schedule->save();
            }

            $this->booking_submitted = true;

            // Flash success message
            session()->flash('message', 'Booking submitted successfully! Reference: ' . $this->booking_reference);

            // Optionally send email notification here
            // $this->sendBookingConfirmation($booking);

        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while processing your booking. Please try again.');
            \Log::error('Booking creation error: ' . $e->getMessage());
        }
    }

    private function getOrCreateUser()
    {
        if (Auth::check()) {
            return Auth::user();
        }

        // Check if user exists by email
        $user = User::where('email', $this->user_email)->first();

        if (!$user) {
            // Create new user
            $user = User::create([
                'name' => $this->user_name,
                'email' => $this->user_email,
                'phone' => $this->user_phone,
                'password' => bcrypt(Str::random(12)), // Random password
                'email_verified_at' => now(),
            ]);
        }

        return $user;
    }

    public function resetForm()
    {
        $this->reset([
            'schedule_id', 'number_of_people', 'booking_date', 'special_request',
            'user_name', 'user_email', 'user_phone', 'selected_schedule',
            'total_amount', 'booking_submitted', 'booking_reference'
        ]);

        $this->number_of_people = 1;
        $this->booking_date = now()->addDay()->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.booking.index')->layout('layouts.booking');
    }
}
