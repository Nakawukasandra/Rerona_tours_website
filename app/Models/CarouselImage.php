<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarouselImage extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'carousel_images';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'description',
        'image_path',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the full URL for the image.
     */
    public function getImageUrlAttribute(): string
    {
        return asset('storage/' . $this->image_path);
    }

    /**
     * Get a shortened description for display purposes.
     */
    public function getShortDescriptionAttribute(): string
    {
        return strlen($this->description) > 150
            ? substr($this->description, 0, 150) . '...'
            : $this->description;
    }

    /**
     * Scope to get active/published carousel images.
     * Note: You might want to add an 'is_active' column to the migration for this.
     */
    public function scopeActive($query)
    {
        // Uncomment the line below if you add an 'is_active' boolean column
        // return $query->where('is_active', true);
        return $query;
    }

    /**
     * Scope to order carousel images by creation date (newest first).
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Boot method to handle model events.
     */
    protected static function boot()
    {
        parent::boot();

        // Delete the image file when the model is deleted
        static::deleting(function ($carouselImage) {
            if ($carouselImage->image_path && \Storage::disk('public')->exists($carouselImage->image_path)) {
                \Storage::disk('public')->delete($carouselImage->image_path);
            }
        });
    }
}
