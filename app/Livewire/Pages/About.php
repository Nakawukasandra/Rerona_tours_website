<?php

namespace App\Livewire\Pages;

use App\Models\AboutUs;
use Livewire\Component;
use Livewire\Attributes\Title;

class About extends Component
{
    public $aboutUs;

    // Contact form properties
    public $name = '';
    public $email = '';
    public $phone = '';
    public $interest = '';
    public $persons = 1;

    public function mount()
    {
        // Get the first active About Us record
        $this->aboutUs = AboutUs::active()->ordered()->first();

        // If no record exists, create a default one or handle gracefully
        if (!$this->aboutUs) {
            $this->aboutUs = new AboutUs([
                'title' => 'Making it real',
                'subtitle' => 'We are the leading tours and safari company giving you an exceptionally new experience',
                'description' => 'Rorena Tours and Safaris was established to increase the number of people interested in visiting Uganda. Since then, we have expanded our Itinerary to include Uganda, Rwanda, Democratic Republic of Congo (D.R.C), Tanzania and Kenya.',
                'mission' => 'Rorena Tours and Safaris is a small-medium sized equipped, experienced, locally owned tours and safari company based in Kampala, Uganda. We offer quality, exceptional, affordable budget, deluxe and luxury or highland tours to Uganda and the entire of East African countries with a personal touch.',
                'years_experience' => 10,
                'happy_clients' => 1315,
                'tours_completed' => 768,
                'destinations' => 25
            ]);
        }
    }

    public function submitContact()
    {
        $this->validate([
            'name' => 'required|min:2',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'interest' => 'nullable|string',
            'persons' => 'required|integer|min:1'
        ]);

        // Here you can save the contact form data to database
        // Or send an email notification
        // For now, we'll just show a success message

        session()->flash('contact-success', 'Thank you for your interest! We will contact you soon.');

        // Reset form fields
        $this->reset(['name', 'email', 'phone', 'interest', 'persons']);
    }

    #[Title('About Us - Rorena Tours')]

    public function render()
    {
        return view('livewire.pages.about', [
            'aboutUs' => $this->aboutUs
        ])->layout('layouts.about');
    }
}
