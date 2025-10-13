<?php

namespace App\Livewire\Pages;

use App\Models\Faq as FaqModel;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Mail;

#[Layout('layouts.faq')]
class Faq extends Component
{
    public $faqs = [];
    public $categories = [];
    public $selectedCategory = 'all';
    public $openFaq = null;

    public $form = [
        'full_name' => '',
        'email' => '',
        'phone' => '',
        'interest' => '',
        'persons' => 1,
    ];

    public function mount()
    {
        $this->loadFaqs();
        $this->loadCategories();
    }

    public function loadFaqs()
    {
        $query = FaqModel::where('is_active', true)
                    ->orderBy('sort_order')
                    ->orderBy('created_at');

        if ($this->selectedCategory !== 'all') {
            $query->where('category', $this->selectedCategory);
        }

        $this->faqs = $query->get();
    }

    public function loadCategories()
    {
        $this->categories = FaqModel::where('is_active', true)
                              ->distinct()
                              ->pluck('category')
                              ->filter()
                              ->sort();
    }

    public function filterByCategory($category)
    {
        $this->selectedCategory = $category;
        $this->openFaq = null;
        $this->loadFaqs();
    }

    public function toggleFaq($faqId)
    {
        $this->openFaq = $this->openFaq === $faqId ? null : $faqId;
    }

    public function sendMessage()
    {
        $validated = $this->validate([
            'form.full_name' => 'required|string|min:2|max:255',
            'form.email' => 'required|email|max:255',
            'form.phone' => 'required|string|min:7|max:20',
            'form.interest' => 'required|string',
            'form.persons' => 'required|integer|min:1|max:100',
        ]);

        try {
            $adminEmail = config('mail.from.address', 'admin@rorenatours.com');

            Mail::raw(
                "New FAQ Inquiry\n\n" .
                "Name: {$this->form['full_name']}\n" .
                "Email: {$this->form['email']}\n" .
                "Phone: {$this->form['phone']}\n" .
                "Interested In: {$this->form['interest']}\n" .
                "Number of Persons: {$this->form['persons']}\n",
                function($message) use ($adminEmail) {
                    $message->to($adminEmail)
                            ->subject('New FAQ Inquiry from ' . $this->form['full_name']);
                }
            );

            Mail::raw(
                "Hello {$this->form['full_name']},\n\n" .
                "Thank you for your inquiry. We have received your message and will get back to you shortly.\n\n" .
                "Best regards,\nRorena Tours and Safaris",
                function($message) {
                    $message->to($this->form['email'])
                            ->subject('We received your inquiry - Rorena Tours');
                }
            );

            $this->form = [
                'full_name' => '',
                'email' => '',
                'phone' => '',
                'interest' => '',
                'persons' => 1,
            ];

            session()->flash('message', 'Thank you! Your message has been sent successfully. We will contact you soon.');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to send message. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.pages.faq');
    }
}
