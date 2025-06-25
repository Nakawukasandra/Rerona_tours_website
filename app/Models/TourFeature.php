<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id',
        'gorilla_trekking',
        'wildlife_safari',
        'cultural_experience',
        'birding',
        'photography',
        'adventure_activities',
        'family_friendly'
    ];

    protected $casts = [
        'gorilla_trekking' => 'boolean',
        'wildlife_safari' => 'boolean',
        'cultural_experience' => 'boolean',
        'birding' => 'boolean',
        'photography' => 'boolean',
        'adventure_activities' => 'boolean',
        'family_friendly' => 'boolean'
    ];

    // Relationship with tour
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
