<?php

namespace App\Livewire\Shop;

use Livewire\Component;
use App\Models\Shop; // Use Shop model, not Product
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $selectedCategory = '';
    public $search = '';
    public $sortBy = 'name';
    public $sortDirection = 'asc';
    public $showFeaturedOnly = false;

    protected $queryString = [
        'selectedCategory' => ['except' => ''],
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'name'],
        'sortDirection' => ['except' => 'asc'],
        'showFeaturedOnly' => ['except' => false],
    ];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedSelectedCategory()
    {
        $this->resetPage();
    }

    public function updatedShowFeaturedOnly()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->selectedCategory = '';
        $this->search = '';
        $this->showFeaturedOnly = false;
        $this->sortBy = 'name';
        $this->sortDirection = 'asc';
        $this->resetPage();
    }

    public function render()
    {
        $query = Shop::active(); // Use Shop model with active scope

        // Apply search filter
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
                  ->orWhere('short_description', 'like', '%' . $this->search . '%');
            });
        }

        // Apply category filter
        if ($this->selectedCategory) {
            $query->byCategory($this->selectedCategory);
        }

        // Apply featured filter
        if ($this->showFeaturedOnly) {
            $query->featured();
        }

        // Apply sorting
        $query->orderBy($this->sortBy, $this->sortDirection);

        $products = $query->paginate(12);
        $categories = Shop::getCategories();

        return view('livewire.shop.index', [
            'products' => $products,
            'categories' => $categories
        ])->layout('layouts.shop', [
            'title' => 'Shop - Rorena Tours & Safari',
            'metaDescription' => 'Browse our collection of authentic African crafts, safari gear, and memorable souvenirs. Shop quality products from Rorena Tours & Safari.',
            'metaKeywords' => 'african crafts, safari gear, souvenirs, shop, rorena tours'
        ]);
    }
}
