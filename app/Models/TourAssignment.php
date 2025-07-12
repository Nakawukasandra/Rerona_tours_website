<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourAssignment extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'tour_assignments';

    /**
     * The primary key for the model.
     */
    protected $primaryKey = 'assignment_id';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'schedule_id',
        'guide_id',
        'assignment_date',
        'note',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'assignment_date' => 'date',
    ];

    /**
     * Get the schedule that this assignment belongs to.
     */
    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    /**
     * Get the guide assigned to this tour.
     */
    public function guide(): BelongsTo
    {
        return $this->belongsTo(Guide::class);
    }

    /**
     * Scope to filter by schedule.
     */
    public function scopeForSchedule($query, $scheduleId)
    {
        return $query->where('schedule_id', $scheduleId);
    }

    /**
     * Scope to filter by guide.
     */
    public function scopeForGuide($query, $guideId)
    {
        return $query->where('guide_id', $guideId);
    }

    /**
     * Scope to filter by assignment date.
     */
    public function scopeForDate($query, $date)
    {
        return $query->whereDate('assignment_date', $date);
    }

    /**
     * Scope to filter by date range.
     */
    public function scopeForDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('assignment_date', [$startDate, $endDate]);
    }

    /**
     * Scope to get upcoming assignments.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('assignment_date', '>=', Carbon::today());
    }

    /**
     * Scope to get past assignments.
     */
    public function scopePast($query)
    {
        return $query->where('assignment_date', '<', Carbon::today());
    }

    /**
     * Scope to order by assignment date.
     */
    public function scopeOrderedByDate($query, $direction = 'asc')
    {
        return $query->orderBy('assignment_date', $direction);
    }

    /**
     * Check if the assignment is in the future.
     */
    public function isUpcoming(): bool
    {
        return $this->assignment_date >= Carbon::today();
    }

    /**
     * Check if the assignment is in the past.
     */
    public function isPast(): bool
    {
        return $this->assignment_date < Carbon::today();
    }

    /**
     * Check if the assignment is today.
     */
    public function isToday(): bool
    {
        return $this->assignment_date->isToday();
    }
}
