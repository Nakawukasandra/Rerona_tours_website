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

    public $selectedImage = null;
    public $showLightbox = false;

    public function clearFilters()
    {
        $this->search = '';
        $this->selectedCategory = '';
    }

    public function openLightbox($imagePath)
    {
        $this->selectedImage = $imagePath;
        $this->showLightbox = true;
    }

    public function closeLightbox()
    {
        $this->selectedImage = null;
        $this->showLightbox = false;
    }

    public function getGalleriesProperty()
    {
        return GalleryModel::active()->ordered()->get();
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

    public function getCategoriesProperty()
    {
        return GalleryModel::active()
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category')
            ->filter()
            ->sort();
    }

    public function getAllImagesProperty()
    {
        $allImages = [];

        foreach ($this->filteredGalleries as $gallery) {
            // Add main image
            if ($gallery->image) {
                // Convert Windows backslashes to forward slashes for web URLs
                $imagePath = str_replace('\\', '/', $gallery->image);
                $allImages[] = [
                    'src' => asset('storage/' . $imagePath),
                    'title' => $gallery->title,
                    'description' => $gallery->description,
                    'category' => $gallery->category,
                    'location' => $gallery->location,
                ];
            }

            // Add gallery images (handle the raw JSON string from database)
            if (!empty($gallery->getRawOriginal('gallery_images'))) {
                $rawGalleryImages = $gallery->getRawOriginal('gallery_images');

                // Clean up the JSON string (remove extra quotes and decode)
                $cleanJson = trim($rawGalleryImages, '"');
                $galleryImages = json_decode($cleanJson, true);

                if (is_array($galleryImages)) {
                    foreach ($galleryImages as $image) {
                        $imagePath = is_array($image) ? ($image['download_link'] ?? $image) : $image;
                        // Convert Windows backslashes to forward slashes for web URLs
                        $imagePath = str_replace('\\', '/', $imagePath);

                        $allImages[] = [
                            'src' => asset('storage/' . $imagePath),
                            'title' => $gallery->title,
                            'description' => $gallery->description,
                            'category' => $gallery->category,
                            'location' => $gallery->location,
                        ];
                    }
                }
            }
        }

        return collect($allImages);
    }

    public function render()
    {
        return view('livewire.pages.gallery', [
            'galleries' => $this->galleries,
            'featuredGalleries' => $this->featuredGalleries,
            'filteredGalleries' => $this->filteredGalleries,
            'categories' => $this->categories,
            'allImages' => $this->allImages,
        ])->layout('layouts.gallery')->title('Gallery - Rorena Tours');
    }
}
