<?php

namespace App\Livewire\Pages;

use App\Models\Contact as ContactModel; // Add alias here
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Title;

#[Title('Contact Us - Rorena Tours')]
class Contact extends Component
{
    #[Validate('required|string|max:255')]
    public $name = '';

    #[Validate('required|email|max:255')]
    public $email = '';

    #[Validate('nullable|string|max:20')]
    public $phone = '';

    #[Validate('required|string|max:255')]
    public $subject = '';

    #[Validate('required|string|min:10')]
    public $message = '';

    #[Validate('required|in:general,booking,safari,tour,support')]
    public $inquiry_type = '';

    #[Validate('nullable|in:email,phone,whatsapp')]
    public $preferred_contact_method = 'email';

    #[Validate('nullable|date|after:today')]
    public $preferred_travel_date = '';

    #[Validate('nullable|integer|min:1|max:50')]
    public $number_of_travelers = '';

    #[Validate('nullable|numeric|min:0')]
    public $budget_range = '';

    #[Validate('nullable|string|max:100')]
    public $country = '';

    public $showSuccessMessage = false;

    public function mount()
    {
        // Set default values
        $this->preferred_contact_method = 'email';
        $this->country = 'Uganda'; // Default since you're in Uganda
    }

    public function submit()
    {
        try {
            // Validate the form
            $validated = $this->validate();

            // Create the contact record using the aliased model
            ContactModel::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'subject' => $this->subject,
                'message' => $this->message,
                'inquiry_type' => $this->inquiry_type,
                'preferred_contact_method' => $this->preferred_contact_method,
                'preferred_travel_date' => $this->preferred_travel_date ?: null,
                'number_of_travelers' => $this->number_of_travelers ?: null,
                'budget_range' => $this->budget_range ?: null,
                'country' => $this->country,
                'ip_address' => request()->ip(),
                'status' => 'new',
                'admin_notes' => null, // Will be filled by admin later
                'replied_at' => null, // Will be set when admin replies
            ]);

            // Reset form fields after successful submission
            $this->reset([
                'name',
                'email',
                'phone',
                'subject',
                'message',
                'inquiry_type',
                'preferred_travel_date',
                'number_of_travelers',
                'budget_range'
            ]);

            // Reset country and preferred contact method to defaults
            $this->country = 'Uganda';
            $this->preferred_contact_method = 'email';

            // Show success message
            $this->showSuccessMessage = true;

            // Optional: Send notification email to admin
            // You can implement this later using Laravel's notification system
            // Mail::to('admin@rorenatours.com')->send(new NewContactInquiry($contact));

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Re-throw validation exceptions so they display properly
            throw $e;
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Contact form submission error: ' . $e->getMessage(), [
                'email' => $this->email,
                'name' => $this->name,
                'inquiry_type' => $this->inquiry_type
            ]);

            $this->addError('form', 'Something went wrong. Please try again.');
        }
    }

    public function hideSuccessMessage()
    {
        $this->showSuccessMessage = false;
    }

    public function getInquiryTypesProperty()
    {
        return [
            'general' => 'General Inquiry',
            'booking' => 'Booking Request',
            'safari' => 'Safari Information',
            'tour' => 'Tour Information',
            'support' => 'Customer Support'
        ];
    }

    public function getContactMethodsProperty()
    {
        return [
            'email' => 'Email',
            'phone' => 'Phone Call',
            'whatsapp' => 'WhatsApp'
        ];
    }

    public function render()
    {
        return view('livewire.pages.contact')
            ->layout('layouts.contact');
    }
}
