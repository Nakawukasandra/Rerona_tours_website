<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cancellation extends Model
{
    use HasFactory;

    protected $primaryKey = 'cancellation_id';

    protected $fillable = [
        'booking_id',
        'cancellation_date',
        'reason',
        'refund_amount',
        'refund_status',
        'notes'
    ];

    protected $casts = [
        'cancellation_date' => 'date',
        'refund_amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relationships
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'booking_id');
    }

    // Through booking, get user and tour schedule
    public function user()
    {
        return $this->hasOneThrough(
            User::class,
            Booking::class,
            'booking_id', // Foreign key on bookings table
            'id', // Foreign key on users table
            'booking_id', // Local key on cancellations table
            'user_id' // Local key on bookings table
        );
    }

    public function tourSchedule()
    {
        return $this->hasOneThrough(
            TourSchedule::class,
            Booking::class,
            'booking_id', // Foreign key on bookings table
            'schedule_id', // Foreign key on tour_schedules table
            'booking_id', // Local key on cancellations table
            'schedule_id' // Local key on bookings table
        );
    }

    // Scopes
    public function scopePendingRefund($query)
    {
        return $query->where('refund_status', 'pending');
    }

    public function scopeProcessingRefund($query)
    {
        return $query->where('refund_status', 'processing');
    }

    public function scopeCompletedRefund($query)
    {
        return $query->where('refund_status', 'completed');
    }

    public function scopeRejectedRefund($query)
    {
        return $query->where('refund_status', 'rejected');
    }

    public function scopeRecentCancellations($query, $days = 30)
    {
        return $query->where('cancellation_date', '>=', now()->subDays($days));
    }

    // Accessors
    public function getFormattedRefundAmountAttribute()
    {
        return number_format($this->refund_amount, 2);
    }

    public function getIsPendingRefundAttribute()
    {
        return $this->refund_status === 'pending';
    }

    public function getIsProcessingRefundAttribute()
    {
        return $this->refund_status === 'processing';
    }

    public function getIsRefundCompletedAttribute()
    {
        return $this->refund_status === 'completed';
    }

    public function getIsRefundRejectedAttribute()
    {
        return $this->refund_status === 'rejected';
    }

    public function getCanProcessRefundAttribute()
    {
        return in_array($this->refund_status, ['pending', 'rejected']);
    }

    // Mutators
    public function setRefundAmountAttribute($value)
    {
        $this->attributes['refund_amount'] = number_format($value, 2, '.', '');
    }

    public function setReasonAttribute($value)
    {
        $this->attributes['reason'] = ucfirst(trim($value));
    }

    // Helper methods
    public function processRefund()
    {
        $this->update(['refund_status' => 'processing']);
    }

    public function completeRefund()
    {
        $this->update(['refund_status' => 'completed']);
    }

    public function rejectRefund($reason = null)
    {
        $updates = ['refund_status' => 'rejected'];

        if ($reason) {
            $updates['notes'] = $this->notes
                ? $this->notes . "\n\nRejection reason: " . $reason
                : "Rejection reason: " . $reason;
        }

        $this->update($updates);
    }
}

