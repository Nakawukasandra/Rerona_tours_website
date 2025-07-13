<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyChooseUs extends Model
{
    use HasFactory;

    protected $table = 'why_choose_us';

    protected $fillable = [
        'title',
        'description',
        'icon',
        'image',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    // Scope for active items
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for ordered items
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    // Accessor for image URL (if using storage)
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
