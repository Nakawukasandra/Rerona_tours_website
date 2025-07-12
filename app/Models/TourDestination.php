<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourDestination extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'tour_destinations';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'tour_id',
        'destination_id',
        'visit_order',
        'days_spent',
        'activities',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'visit_order' => 'integer',
        'days_spent' => 'integer',
    ];

    /**
     * Get the tour that this destination belongs to.
     */
    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }

    /**
     * Get the destination details.
     */
    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    /**
     * Scope to filter by tour.
     */
    public function scopeForTour($query, $tourId)
    {
        return $query->where('tour_id', $tourId);
    }

    /**
     * Scope to filter by destination.
     */
    public function scopeForDestination($query, $destinationId)
    {
        return $query->where('destination_id', $destinationId);
    }

    /**
     * Scope to order by visit order.
     */
    public function scopeOrderedByVisit($query)
    {
        return $query->orderBy('visit_order');
    }

    /**
     * Scope to get destinations for a specific tour in visit order.
     */
    public function scopeTourItinerary($query, $tourId)
    {
        return $query->where('tour_id', $tourId)->orderBy('visit_order');
    }

    /**
     * Get activities as an array (in case you want to store JSON).
     */
    public function getActivitiesListAttribute()
    {
        if (is_string($this->activities)) {
            return explode("\n", $this->activities);
        }
        return [];
    }
}
