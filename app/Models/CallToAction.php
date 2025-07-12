<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallToAction extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'call_to_actions';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'type',
        'heading',
        'description',
        'image',
        'button_text',
        'button_link',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the full URL for the CTA image.
     */
    public function getImageUrlAttribute(): string
    {
        return asset('storage/' . $this->image);
    }

    /**
     * Get a shortened description for display purposes.
     */
    public function getShortDescriptionAttribute(): string
    {
        return strlen($this->description) > 120
            ? substr($this->description, 0, 120) . '...'
            : $this->description;
    }

    /**
     * Check if the CTA has an external link.
     */
    public function getIsExternalLinkAttribute(): bool
    {
        return $this->button_link && (
            str_starts_with($this->button_link, 'http://') ||
            str_starts_with($this->button_link, 'https://')
        );
    }

    /**
     * Get the target attribute for links (_blank for external, _self for internal).
     */
    public function getLinkTargetAttribute(): string
    {
        return $this->is_external_link ? '_blank' : '_self';
    }

    /**
     * Scope to filter CTAs by type (e.g., 'booking', 'contact', 'newsletter').
     */
    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope to get CTAs that have button links.
     */
    public function scopeWithLinks($query)
    {
        return $query->whereNotNull('button_link');
    }

    /**
     * Scope to order CTAs by creation date (newest first).
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Get common CTA types for safari/tour websites.
     */
    public static function getCommonTypes(): array
    {
        return [
            'booking' => 'Booking CTA',
            'contact' => 'Contact CTA',
            'newsletter' => 'Newsletter Signup',
            'consultation' => 'Free Consultation',
            'brochure' => 'Download Brochure',
            'quote' => 'Get Quote',
            'safari' => 'Safari Booking',
            'adventure' => 'Adventure Tours',
            'cultural' => 'Cultural Experience',
        ];
    }

    /**
     * Boot method to handle model events.
     */
    protected static function boot()
    {
        parent::boot();

        // Delete the image file when the model is deleted
        static::deleting(function ($callToAction) {
            if ($callToAction->image && \Storage::disk('public')->exists($callToAction->image)) {
                \Storage::disk('public')->delete($callToAction->image);
            }
        });
    }
}
