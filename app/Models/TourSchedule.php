<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourSchedule extends Model
{
    use HasFactory;

    protected $primaryKey = 'schedule_id';

    protected $fillable = [
        'tour_id',
        'start_date',
        'end_date',
        'available_slots',
        'current_price',
        'status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'current_price' => 'decimal:2',
        'available_slots' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relationships
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', now()->toDateString());
    }

    public function scopeAvailable($query)
    {
        return $query->where('available_slots', '>', 0);
    }

    // Accessors
    public function getFormattedPriceAttribute()
    {
        return number_format($this->current_price, 2);
    }

    public function getIsActiveAttribute()
    {
        return $this->status === 'active';
    }

    public function getIsUpcomingAttribute()
    {
        return $this->start_date >= now()->toDateString();
    }

    public function getHasAvailableSlotsAttribute()
    {
        return $this->available_slots > 0;
    }

    // Mutators
    public function setCurrentPriceAttribute($value)
    {
        $this->attributes['current_price'] = number_format($value, 2, '.', '');
    }
}
