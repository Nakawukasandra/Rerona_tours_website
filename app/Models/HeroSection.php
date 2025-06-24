<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'primary_button_text',
        'primary_button_link',
        'secondary_button_text',
        'secondary_button_link',
        'background_image',
        'background_video',
        'gallery_images',
        'show_search_bar',
        'search_placeholder',
        'layout_type',
        'text_alignment',
        'overlay_color',
        'overlay_opacity',
        'content_position',
        'show_scroll_indicator',
        'is_active',
        'sort_order',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'show_search_bar' => 'boolean',
        'show_scroll_indicator' => 'boolean',
        'is_active' => 'boolean',
        'overlay_opacity' => 'integer',
        'sort_order' => 'integer',
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    // Accessors
    public function getBackgroundImageUrlAttribute()
    {
        return $this->background_image ? asset('storage/' . $this->background_image) : null;
    }

    public function getBackgroundVideoUrlAttribute()
    {
        return $this->background_video ? asset('storage/' . $this->background_video) : null;
    }

    public function getGalleryImageUrlsAttribute()
    {
        if (!$this->gallery_images) {
            return [];
        }

        return collect($this->gallery_images)->map(function ($image) {
            return asset('storage/' . $image);
        })->toArray();
    }
}
