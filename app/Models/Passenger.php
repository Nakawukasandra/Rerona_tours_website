<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'passport_number',
        'nationality',
        'dietary_requirements',
        'medical_conditions',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    // Relationships
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    // Accessors
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getAgeAttribute()
    {
        return $this->date_of_birth->age;
    }

    // Scopes for safari-specific queries
    public function scopeWithDietaryNeeds($query)
    {
        return $query->whereNotNull('dietary_requirements');
    }

    public function scopeWithMedicalConditions($query)
    {
        return $query->whereNotNull('medical_conditions');
    }

    public function scopeMinors($query)
    {
        return $query->whereDate('date_of_birth', '>', now()->subYears(18));
    }
}
