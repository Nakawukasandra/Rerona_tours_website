<?php

namespace App\Livewire\Destinations;

use App\Models\Destination;
use Livewire\Component;

class Index extends Component
{
    public $destinations;
    public $searchTerm = '';
    public $selectedCountry = '';
    public $countries = [];

    public function mount()
    {
        $this->loadDestinations();
        $this->loadCountries();
    }

    public function loadDestinations()
    {
        $query = Destination::where('is_active', true)->orderBy('sort_order');

        if ($this->searchTerm) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('city', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $this->searchTerm . '%');
            });
        }

        if ($this->selectedCountry) {
            $query->where('country', $this->selectedCountry);
        }

        $this->destinations = $query->get();
    }

    public function loadCountries()
    {
        $this->countries = Destination::where('is_active', true)
            ->distinct()
            ->pluck('country')
            ->filter()
            ->sort()
            ->values()
            ->toArray();
    }

    public function updatedSearchTerm()
    {
        $this->loadDestinations();
    }

    public function updatedSelectedCountry()
    {
        $this->loadDestinations();
    }

    public function clearFilters()
    {
        $this->searchTerm = '';
        $this->selectedCountry = '';
        $this->loadDestinations();
    }

    public function render()
    {
        return view('livewire.destinations.index')->layout('layouts.destinations');
    }
}
