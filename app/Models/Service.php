<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'price',
        'discount_price',
        'duration_days',
        'duration_nights',
        'max_guests',
        'min_guests',
        'difficulty_level',
        'inclusions',
        'exclusions',
        'itinerary',
        'gallery',
        'featured_image',
        'category',
        'locations',
        'pickup_location',
        'dropoff_location',
        'pickup_time',
        'dropoff_time',
        'is_featured',
        'is_active',
        'requirements',
        'cancellation_policy',
        'sort_order',
        'meta_data',
    ];

    protected $casts = [
        'inclusions' => 'array',
        'exclusions' => 'array',
        'itinerary' => 'array',
        'gallery' => 'array',
        'locations' => 'array',
        'requirements' => 'array',
        'meta_data' => 'array',
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'pickup_time' => 'datetime:H:i',
        'dropoff_time' => 'datetime:H:i',
    ];

    protected $attributes = [
        'difficulty_level' => 'easy',
        'category' => 'safari',
        'duration_days' => 1,
        'duration_nights' => 0,
        'max_guests' => 10,
        'min_guests' => 1,
        'is_featured' => false,
        'is_active' => true,
        'sort_order' => 0,
    ];

    // Boot method to auto-generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->name);
            }
        });

        static::updating(function ($service) {
            if ($service->isDirty('name') && empty($service->slug)) {
                $service->slug = Str::slug($service->name);
            }
        });
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeOrderBySort($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    // Accessors
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2);
    }

    public function getFormattedDiscountPriceAttribute()
    {
        return $this->discount_price ? number_format($this->discount_price, 2) : null;
    }

    public function getHasDiscountAttribute()
    {
        return $this->discount_price && $this->discount_price < $this->price;
    }

    public function getDiscountPercentageAttribute()
    {
        if (!$this->has_discount) {
            return 0;
        }

        return round((($this->price - $this->discount_price) / $this->price) * 100);
    }

    public function getEffectivePriceAttribute()
    {
        return $this->has_discount ? $this->discount_price : $this->price;
    }

    public function getDurationTextAttribute()
    {
        if ($this->duration_nights > 0) {
            return "{$this->duration_days} Days / {$this->duration_nights} Nights";
        }

        return $this->duration_days . ' Day' . ($this->duration_days > 1 ? 's' : '');
    }

    public function getFirstImageAttribute()
    {
        if ($this->featured_image) {
            return $this->featured_image;
        }

        if ($this->gallery && is_array($this->gallery) && count($this->gallery) > 0) {
            return $this->gallery[0];
        }

        return null;
    }

    // Relationships (if you have related models like bookings, reviews, etc.)
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Helper methods
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function toArray()
    {
        $array = parent::toArray();

        // Add computed attributes to array
        $array['formatted_price'] = $this->formatted_price;
        $array['formatted_discount_price'] = $this->formatted_discount_price;
        $array['has_discount'] = $this->has_discount;
        $array['discount_percentage'] = $this->discount_percentage;
        $array['effective_price'] = $this->effective_price;
        $array['duration_text'] = $this->duration_text;
        $array['first_image'] = $this->first_image;

        return $array;
    }
}
