<?php

namespace App\Livewire\Pages;

use App\Models\Faq as FaqModel;
use Livewire\Component;

class Faq extends Component
{
    public $faqs;
    public $categories;
    public $selectedCategory = 'all';
    public $openFaq = null;

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
        $this->openFaq = null; // Close any open FAQ when filtering
        $this->loadFaqs();
    }

    public function toggleFaq($faqId)
    {
        $this->openFaq = $this->openFaq === $faqId ? null : $faqId;
    }

    public function render()
    {
        return view('livewire.pages.faq')
                ->layout('layouts.faq')
                ->title('Frequently Asked Questions - Rorena Tours');
    }
}
