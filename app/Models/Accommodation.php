<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_name',
        'hotel_type',
        'address',
        'city',
        'country',
        'rating',
        'amenities',
        'contact_info',
        'price_per_night',
        'description',
        'images',
        'featured_image',
        'is_active'
    ];

    protected $casts = [
        'rating' => 'decimal:1',
        'price_per_night' => 'decimal:2',
        'images' => 'array',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'tour_accommodations');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // Scopes for frontend use
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCity($query, $city)
    {
        return $query->where('city', $city);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('hotel_type', $type);
    }

    public function scopeMinRating($query, $rating)
    {
        return $query->where('rating', '>=', $rating);
    }
}
