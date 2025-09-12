<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class AboutUs extends Model
{
    use HasFactory, Translatable;

    /**
     * The table associated with the model.
     */
    protected $table = 'about_us';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'mission',
        'vision',
        'values',
        'main_image',
        'gallery_images',
        'years_experience',
        'happy_clients',
        'tours_completed',
        'destinations',
        'phone',
        'email',
        'address',
        'latitude',
        'longitude',
        'social_media',
        'meta_description',
        'meta_keywords',
        'is_active',
        'sort_order'
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'values' => 'array',
        'gallery_images' => 'array',
        'social_media' => 'array',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'is_active' => 'boolean',
        'years_experience' => 'integer',
        'happy_clients' => 'integer',
        'tours_completed' => 'integer',
        'destinations' => 'integer',
        'sort_order' => 'integer'
    ];

    /**
     * The attributes that should be translatable.
     */
    protected $translatable = [
        'title',
        'subtitle',
        'description',
        'mission',
        'vision',
        'values',
        'address',
        'meta_description',
        'meta_keywords'
    ];

    /**
     * The attributes that should be mutated to dates.
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * Scope a query to only include active records.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order by sort order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    /**
     * Get the main image URL.
     */
    public function getMainImageUrlAttribute()
    {
        if ($this->main_image) {
            return asset('storage/' . $this->main_image);
        }
        return null;
    }

    /**
     * Get gallery images URLs.
     */
    public function getGalleryImagesUrlsAttribute()
    {
        if ($this->gallery_images && is_array($this->gallery_images)) {
            return array_map(function($image) {
                return asset('storage/' . $image);
            }, $this->gallery_images);
        }
        return [];
    }

    /**
     * Get social media links with default structure.
     */
    public function getSocialMediaLinksAttribute()
    {
        $default = [
            'facebook' => '',
            'twitter' => '',
            'instagram' => '',
            'linkedin' => '',
            'youtube' => '',
            'whatsapp' => ''
        ];

        if ($this->social_media && is_array($this->social_media)) {
            return array_merge($default, $this->social_media);
        }

        return $default;
    }

    /**
     * Get company values as array.
     */
    public function getCompanyValuesAttribute()
    {
        if ($this->values && is_array($this->values)) {
            return $this->values;
        }
        return [];
    }

    /**
     * Get the full address with coordinates.
     */
    public function getLocationAttribute()
    {
        return [
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude
        ];
    }

    /**
     * Get contact information.
     */
    public function getContactInfoAttribute()
    {
        return [
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address
        ];
    }

    /**
     * Get statistics for the about us page.
     */
    public function getStatsAttribute()
    {
        return [
            'years_experience' => $this->years_experience ?? 0,
            'happy_clients' => $this->happy_clients ?? 0,
            'tours_completed' => $this->tours_completed ?? 0,
            'destinations' => $this->destinations ?? 0
        ];
    }
}
