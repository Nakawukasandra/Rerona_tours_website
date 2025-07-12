<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourTransport extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'tour_transports';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'tour_id',
        'transport_id',
        'route',
        'departure_time',
        'arrival_time',
        'cost',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'departure_time' => 'datetime',
        'arrival_time' => 'datetime',
        'cost' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the tour that this transport belongs to.
     */
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id', 'id');
    }

    /**
     * Get the transport for this tour.
     */
    public function transport()
    {
        return $this->belongsTo(Transport::class, 'transport_id', 'id');
    }

    /**
     * Get the duration of the transport in hours.
     */
    public function getDurationAttribute(): float
    {
        return $this->departure_time->diffInHours($this->arrival_time);
    }

    /**
     * Get formatted cost with currency.
     */
    public function getFormattedCostAttribute(): string
    {
        return '$' . number_format($this->cost, 2);
    }

    /**
     * Get a display name for the transport route.
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->transport->display_name . ' - ' . $this->route;
    }

    /**
     * Scope to filter by tour.
     */
    public function scopeForTour($query, int $tourId)
    {
        return $query->where('tour_id', $tourId);
    }

    /**
     * Scope to filter by transport.
     */
    public function scopeForTransport($query, int $transportId)
    {
        return $query->where('transport_id', $transportId);
    }

    /**
     * Scope to filter by departure date.
     */
    public function scopeDepartingOn($query, $date)
    {
        return $query->whereDate('departure_time', $date);
    }

    /**
     * Scope to get upcoming transports.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('departure_time', '>', now());
    }

    /**
     * Check if transport is currently active (between departure and arrival).
     */
    public function getIsActiveAttribute(): bool
    {
        $now = now();
        return $now->between($this->departure_time, $this->arrival_time);
    }

    /**
     * Get status based on current time.
     */
    public function getStatusAttribute(): string
    {
        $now = now();

        if ($now < $this->departure_time) {
            return 'Scheduled';
        } elseif ($now->between($this->departure_time, $this->arrival_time)) {
            return 'In Transit';
        } else {
            return 'Completed';
        }
    }
}
