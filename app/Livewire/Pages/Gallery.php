<?php

namespace App\Livewire\Pages;

use App\Models\Gallery as GalleryModel;
use Livewire\Component;
use Livewire\Attributes\Url;

class Gallery extends Component
{
    #[Url(as: 'search')]
    public $search = '';
    
    #[Url(as: 'category')]
    public $selectedCategory = '';
    
    public function clearFilters()
    {
        $this->search = '';
        $this->selectedCategory = '';
    }
    
    public function getGalleriesProperty()
    {
        return GalleryModel::active()
            ->ordered()
            ->get();
    }
    
    public function getFeaturedGalleriesProperty()
    {
        $query = GalleryModel::active()->featured()->ordered();
        
        // Apply search filter
        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
                  ->orWhere('location', 'like', '%' . $this->search . '%');
            });
        }
        
        // Apply category filter
        if (!empty($this->selectedCategory)) {
            $query->byCategory($this->selectedCategory);
        }
        
        return $query->get();
    }
    
    public function getFilteredGalleriesProperty()
    {
        $query = GalleryModel::active()->ordered();
        
        // Apply search filter
        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
                  ->orWhere('location', 'like', '%' . $this->search . '%');
            });
        }
        
        // Apply category filter
        if (!empty($this->selectedCategory)) {
            $query->byCategory($this->selectedCategory);
        }
        
        return $query->get();
    }
    
    public function render()
    {
        return view('livewire.pages.gallery', [
            'galleries' => $this->galleries,
            'featuredGalleries' => $this->featuredGalleries,
            'filteredGalleries' => $this->filteredGalleries,
        ])->layout('layouts.gallery')->title('Gallery - Rorena Tours');
    }
}