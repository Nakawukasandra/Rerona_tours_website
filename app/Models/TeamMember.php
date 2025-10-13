<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $table = 'team_members';

    protected $fillable = [
        'name',
        'position',
        'bio',
        'profile_image',
        'social_links',
        'email',
        'phone',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'social_links' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected $attributes = [
        'sort_order' => 0,
        'is_active' => true,
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    // Accessors
    public function getProfileImageUrlAttribute()
    {
        if ($this->profile_image) {
            return asset('storage/' . $this->profile_image);
        }

        return asset('images/default-profile.png'); // fallback image
    }

    public function getFormattedSocialLinksAttribute()
    {
        if (!$this->social_links) {
            return [];
        }

        $formatted = [];
        foreach ($this->social_links as $platform => $url) {
            $formatted[] = [
                'platform' => $platform,
                'url' => $url,
                'icon' => $this->getSocialIcon($platform),
            ];
        }

        return $formatted;
    }

    // Mutators
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = $value ? strtolower(trim($value)) : null;
    }

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = $value ? preg_replace('/[^0-9+\-\s()]/', '', $value) : null;
    }

    // Helper methods
    public function getSocialIcon($platform)
    {
        $icons = [
            'facebook' => 'fab fa-facebook-f',
            'twitter' => 'fab fa-twitter',
            'linkedin' => 'fab fa-linkedin-in',
            'instagram' => 'fab fa-instagram',
            'github' => 'fab fa-github',
            'youtube' => 'fab fa-youtube',
            'tiktok' => 'fab fa-tiktok',
            'whatsapp' => 'fab fa-whatsapp',
        ];

        return $icons[strtolower($platform)] ?? 'fas fa-link';
    }

    public function hasProfileImage()
    {
        return !empty($this->profile_image);
    }

    public function hasSocialLinks()
    {
        return !empty($this->social_links) && is_array($this->social_links);
    }

    public function getSocialLink($platform)
    {
        if (!$this->hasSocialLinks()) {
            return null;
        }

        return $this->social_links[strtolower($platform)] ?? null;
    }

    // Boot method for default ordering
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('ordered', function ($builder) {
            $builder->orderBy('sort_order', 'asc')->orderBy('name', 'asc');
        });
    }
}
