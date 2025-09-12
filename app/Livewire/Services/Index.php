<?php

namespace App\Livewire\Services;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $difficultyLevel = '';
    public $priceRange = '';
    public $sortBy = 'name';
    public $sortDirection = 'asc';

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
        'difficultyLevel' => ['except' => ''],
        'priceRange' => ['except' => ''],
        'sortBy' => ['except' => 'name'],
        'sortDirection' => ['except' => 'asc']
    ];

    public function mount()
    {
        // Any initialization logic
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingDifficultyLevel()
    {
        $this->resetPage();
    }

    public function updatingPriceRange()
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
        $this->search = '';
        $this->category = '';
        $this->difficultyLevel = '';
        $this->priceRange = '';
        $this->sortBy = 'name';
        $this->sortDirection = 'asc';
        $this->resetPage();
    }

    public function render()
    {
        $query = Service::active()
            ->when($this->search, function($q) {
                $q->where(function($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                          ->orWhere('description', 'like', '%' . $this->search . '%')
                          ->orWhere('short_description', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->category, function($q) {
                $q->byCategory($this->category);
            })
            ->when($this->difficultyLevel, function($q) {
                $q->where('difficulty_level', $this->difficultyLevel);
            })
            ->when($this->priceRange, function($q) {
                switch($this->priceRange) {
                    case 'under_100':
                        $q->where('price', '<', 100);
                        break;
                    case '100_500':
                        $q->whereBetween('price', [100, 500]);
                        break;
                    case '500_1000':
                        $q->whereBetween('price', [500, 1000]);
                        break;
                    case 'over_1000':
                        $q->where('price', '>', 1000);
                        break;
                }
            });

        // Apply sorting
        if ($this->sortBy === 'price') {
            $query->orderBy('price', $this->sortDirection);
        } elseif ($this->sortBy === 'duration') {
            $query->orderBy('duration_days', $this->sortDirection)
                  ->orderBy('duration_nights', $this->sortDirection);
        } elseif ($this->sortBy === 'featured') {
            $query->orderBy('is_featured', 'desc')
                  ->orderBy('name', 'asc');
        } else {
            $query->orderBy($this->sortBy, $this->sortDirection);
        }

        $services = $query->paginate(12);

        // Get filter options
        $categories = Service::active()
            ->distinct()
            ->pluck('category')
            ->filter()
            ->sort();

        $difficultyLevels = Service::active()
            ->distinct()
            ->pluck('difficulty_level')
            ->filter()
            ->sort();

        return view('livewire.services.index', [
            'services' => $services,
            'categories' => $categories,
            'difficultyLevels' => $difficultyLevels,
        ])
        ->layout('layouts.services')  // Changed from layouts.app to layouts.services
        ->title('Our Services - Rorena Tours');
    }
}
