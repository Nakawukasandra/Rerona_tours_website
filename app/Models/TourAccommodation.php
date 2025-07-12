<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourAccommodation extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'tour_accommodations';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'tour_id',
        'accommodation_id',
        'night_count',
        'room_type',
        'cost_per_night',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'night_count' => 'integer',
        'cost_per_night' => 'decimal:2',
    ];

    /**
     * Get the tour that this accommodation belongs to.
     */
    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }

    /**
     * Get the accommodation details.
     */
    public function accommodation(): BelongsTo
    {
        return $this->belongsTo(Accommodation::class);
    }

    /**
     * Calculate total cost for this accommodation.
     */
    public function getTotalCostAttribute(): float
    {
        return $this->night_count * $this->cost_per_night;
    }

    /**
     * Scope to filter by tour.
     */
    public function scopeForTour($query, $tourId)
    {
        return $query->where('tour_id', $tourId);
    }

    /**
     * Scope to filter by accommodation.
     */
    public function scopeForAccommodation($query, $accommodationId)
    {
        return $query->where('accommodation_id', $accommodationId);
    }
}
