<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'inquiry_type',
        'status',
        'preferred_contact_method',
        'preferred_travel_date',
        'number_of_travelers',
        'budget_range',
        'country',
        'ip_address',
        'replied_at',
        'admin_notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'preferred_travel_date' => 'date',
        'budget_range' => 'decimal:2',
        'replied_at' => 'datetime',
        'number_of_travelers' => 'integer',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'ip_address',
        'admin_notes',
    ];

    /**
     * Scope for filtering by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope for filtering by inquiry type
     */
    public function scopeByInquiryType($query, $type)
    {
        return $query->where('inquiry_type', $type);
    }

    /**
     * Scope for new/unread contacts
     */
    public function scopeUnread($query)
    {
        return $query->where('status', 'new');
    }

    /**
     * Scope for recent contacts (within last 30 days)
     */
    public function scopeRecent($query)
    {
        return $query->where('created_at', '>=', now()->subDays(30));
    }

    /**
     * Mark contact as read
     */
    public function markAsRead()
    {
        $this->update(['status' => 'read']);
    }

    /**
     * Mark contact as replied
     */
    public function markAsReplied()
    {
        $this->update([
            'status' => 'replied',
            'replied_at' => now()
        ]);
    }

    /**
     * Mark contact as resolved
     */
    public function markAsResolved()
    {
        $this->update(['status' => 'resolved']);
    }

    /**
     * Get the inquiry type in a human-readable format
     */
    public function getInquiryTypeAttribute($value)
    {
        $types = [
            'general' => 'General Inquiry',
            'booking' => 'Booking Request',
            'safari' => 'Safari Information',
            'tour' => 'Tour Information',
            'support' => 'Customer Support'
        ];

        return $types[$value] ?? ucfirst($value);
    }

    /**
     * Get the status in a human-readable format
     */
    public function getStatusLabelAttribute()
    {
        $statuses = [
            'new' => 'New',
            'read' => 'Read',
            'replied' => 'Replied',
            'resolved' => 'Resolved'
        ];

        return $statuses[$this->status] ?? ucfirst($this->status);
    }

    /**
     * Get formatted budget range
     */
    public function getFormattedBudgetAttribute()
    {
        if (!$this->budget_range) {
            return null;
        }

        return '$' . number_format($this->budget_range, 0);
    }

    /**
     * Check if contact is urgent (multiple criteria)
     */
    public function getIsUrgentAttribute()
    {
        // Consider urgent if booking inquiry with travel date within 30 days
        if ($this->inquiry_type === 'booking' && $this->preferred_travel_date) {
            return $this->preferred_travel_date->diffInDays(now()) <= 30;
        }

        return false;
    }
}
