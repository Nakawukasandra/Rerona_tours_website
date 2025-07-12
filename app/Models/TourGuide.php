<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourGuide extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'tour_guides';

    /**
     * The primary key for the model.
     */
    protected $primaryKey = 'guide_id';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'bio',
        'language',
        'rating',
        'years_experience',
        'is_available',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'rating' => 'decimal:2',
        'years_experience' => 'integer',
        'is_available' => 'boolean',
        'created_at' => 'datetime',
    ];

    /**
     * Get the tour assignments for this guide.
     */
    public function tourAssignments(): HasMany
    {
        return $this->hasMany(TourAssignment::class, 'guide_id');
    }

    /**
     * Get the full name attribute.
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the experience level based on years of experience.
     */
    public function getExperienceLevelAttribute(): string
    {
        if ($this->years_experience >= 10) {
            return 'Expert';
        } elseif ($this->years_experience >= 5) {
            return 'Experienced';
        } elseif ($this->years_experience >= 2) {
            return 'Intermediate';
        } else {
            return 'Beginner';
        }
    }

    /**
     * Scope to filter available guides.
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    /**
     * Scope to filter by language.
     */
    public function scopeByLanguage($query, $language)
    {
        return $query->where('language', $language);
    }

    /**
     * Scope to filter by minimum rating.
     */
    public function scopeWithMinRating($query, $minRating)
    {
        return $query->where('rating', '>=', $minRating);
    }

    /**
     * Scope to filter by minimum experience.
     */
    public function scopeWithMinExperience($query, $minYears)
    {
        return $query->where('years_experience', '>=', $minYears);
    }

    /**
     * Scope to order by rating (highest first).
     */
    public function scopeOrderByRating($query, $direction = 'desc')
    {
        return $query->orderBy('rating', $direction);
    }

    /**
     * Scope to order by experience (most experienced first).
     */
    public function scopeOrderByExperience($query, $direction = 'desc')
    {
        return $query->orderBy('years_experience', $direction);
    }

    /**
     * Scope to search by name.
     */
    public function scopeSearchByName($query, $name)
    {
        return $query->where(function ($q) use ($name) {
            $q->where('first_name', 'like', "%{$name}%")
              ->orWhere('last_name', 'like', "%{$name}%");
        });
    }

    /**
     * Check if guide is highly rated (4.0+ rating).
     */
    public function isHighlyRated(): bool
    {
        return $this->rating >= 4.0;
    }

    /**
     * Check if guide is experienced (5+ years).
     */
    public function isExperienced(): bool
    {
        return $this->years_experience >= 5;
    }
}
