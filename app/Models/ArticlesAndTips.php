<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleTip extends Model
{
    use HasFactory;

    protected $table = 'articles_tips';

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'gallery',
        'category',
        'tags',
        'author',
        'meta_title',
        'meta_description',
        'read_time',
        'is_featured',
        'is_published',
        'published_at',
        'views_count'
    ];

    protected $casts = [
        'gallery' => 'array',
        'tags' => 'array',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'views_count' => 'integer',
        'read_time' => 'integer'
    ];

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                    ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    public function scopePopular($query)
    {
        return $query->orderBy('views_count', 'desc');
    }

    // Accessors
    public function getFeaturedImageUrlAttribute()
    {
        return $this->featured_image ? asset('storage/' . $this->featured_image) : null;
    }

    public function getFormattedPublishedAtAttribute()
    {
        return $this->published_at ? $this->published_at->format('M d, Y') : null;
    }

    public function getReadTimeTextAttribute()
    {
        if (!$this->read_time) return null;
        return $this->read_time . ' min read';
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Mutators
    protected function slug(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $value ?: \Str::slug($this->title)
        );
    }

    protected function publishedAt(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $value ?: now()
        );
    }

    // Helper methods
    public function incrementViews()
    {
        $this->increment('views_count');
    }

    public function getTagsListAttribute()
    {
        return $this->tags ? implode(', ', $this->tags) : '';
    }

    public function getExcerptLimitedAttribute()
    {
        return \Str::limit($this->excerpt, 120);
    }

    // Static methods for common queries
    public static function getCategories()
    {
        return [
            'article' => 'Article',
            'tip' => 'Travel Tip',
            'guide' => 'Safari Guide',
            'news' => 'News'
        ];
    }

    public static function getPopularTags()
    {
        return [
            'Safari', 'Wildlife', 'Travel Tips', 'National Parks',
            'Big Five', 'Photography', 'Packing', 'Best Time to Visit',
            'Cultural Tours', 'Adventure', 'Family Travel', 'Luxury Safari'
        ];
    }
}
