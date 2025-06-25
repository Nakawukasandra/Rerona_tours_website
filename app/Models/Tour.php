<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'destination_id',
        'description',
        'price',
        'duration',
        'available_months',
        'start_date',
        'end_date',
        'departure_dates',
        'featured_image',
        'is_featured',
        'is_active'
    ];

    protected $casts = [
        'available_months' => 'array',
        'departure_dates' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    // Relationship with destination
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    // Relationship with tour features
    public function features()
    {
        return $this->hasOne(TourFeature::class);
    }
}
