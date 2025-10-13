<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'gallery_images',
        'category',
        'location',
        'sort_order',
        'featured',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'featured' => 'boolean',
        'status' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($gallery) {
            if (empty($gallery->slug)) {
                $gallery->slug = Str::slug($gallery->title);
            }
        });

        static::updating(function ($gallery) {
            if ($gallery->isDirty('title') && empty($gallery->slug)) {
                $gallery->slug = Str::slug($gallery->title);
            }
        });
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('created_at', 'desc');
    }

    // Accessors
    public function getMainImageAttribute()
    {
        return $this->image ?: (
            !empty($this->gallery_images)
                ? $this->gallery_images[0]
                : null
        );
    }

    public function getImageCountAttribute()
    {
        return is_array($this->gallery_images) ? count($this->gallery_images) : 0;
    }

    // Methods
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getUrlAttribute()
    {
        return route('gallery.show', $this->slug);
    }
}
