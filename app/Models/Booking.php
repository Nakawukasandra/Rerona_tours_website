<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    use HasFactory;

    protected $primaryKey = 'booking_id';
    public $incrementing = true;

    protected $fillable = [
        'user_id',
        'schedule_id',
        'booking_reference',
        'number_of_people',
        'total_amount',
        'paid_amount',
        'pending_amount',
        'booking_status',
        'booking_date',
        'special_request',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'pending_amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(TourSchedule::class, 'schedule_id', 'schedule_id');
    }

    public function passengers(): HasMany
    {
        return $this->hasMany(Passenger::class, 'booking_id', 'booking_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'booking_id', 'booking_id');
    }

    // Accessors
    public function getBalanceAttribute(): float
    {
        return $this->total_amount - $this->paid_amount;
    }

    public function getIsFullyPaidAttribute(): bool
    {
        return $this->paid_amount >= $this->total_amount;
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('booking_status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('booking_status', 'confirmed');
    }

    public function scopeForDate($query, $date)
    {
        return $query->whereDate('booking_date', $date);
    }

    // Mutators
    public function setPendingAmountAttribute($value): void
    {
        $this->attributes['pending_amount'] = $this->total_amount - $this->paid_amount;
    }
}
