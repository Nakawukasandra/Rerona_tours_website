<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Traits\Translatable;

class Post extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'image',
        'featured_image',
        'status',
        'featured',
        'author_id',
        'category_id',
        'seo_title',
        'meta_description',
        'meta_keywords',
        'tags',
        'read_time',
        'published_at',
    ];

    protected $casts = [
        'featured' => 'boolean',
        // Removed 'tags' => 'array' cast since data is stored as comma-separated strings
        'published_at' => 'datetime',
    ];

    protected $dates = [
        'published_at',
        'created_at',
        'updated_at',
    ];

    // Automatically generate slug when creating/updating
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }

            // Ensure author_id is always set (required field)
            if (empty($post->author_id)) {
                if (Auth::check()) {
                    $post->author_id = Auth::id();
                } else {
                    // Fallback to first admin user if no auth context
                    $adminUser = \App\Models\User::where('role_id', 1)->first();
                    if ($adminUser) {
                        $post->author_id = $adminUser->id;
                    } else {
                        // Last resort - use first user
                        $firstUser = \App\Models\User::first();
                        if ($firstUser) {
                            $post->author_id = $firstUser->id;
                        }
                    }
                }
            }
        });

        static::updating(function ($post) {
            if ($post->isDirty('title') && empty($post->getOriginal('slug'))) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    // Relationships
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Scopes for common queries
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    // Mutators
    public function setFeaturedAttribute($value)
    {
        // Handle checkbox values from forms
        if ($value === 'on' || $value === '1' || $value === 1 || $value === true) {
            $this->attributes['featured'] = 1;
        } else {
            $this->attributes['featured'] = 0;
        }
    }

    // Accessors
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getExcerptAttribute($value)
    {
        return $value ?: Str::limit(strip_tags($this->body), 150);
    }

    public function getReadTimeAttribute($value)
    {
        if ($value) {
            return $value;
        }

        // Calculate read time based on word count (average 200 words per minute)
        $wordCount = str_word_count(strip_tags($this->body));
        return max(1, ceil($wordCount / 200));
    }

    // Helper method to get tags as array
    public function getTagsArray()
    {
        if (!$this->tags) {
            return [];
        }

        if (is_string($this->tags)) {
            // Split by comma and clean up whitespace
            return array_map('trim', explode(',', $this->tags));
        }

        // If it's already an array (future-proof)
        return $this->tags;
    }

    // Helper methods for tourism content
    public function getTourismTags()
    {
        $tourismKeywords = ['safari', 'wildlife', 'adventure', 'gorilla', 'chimpanzee', 'national park', 'uganda', 'rwanda', 'kenya', 'tanzania'];

        if (!$this->tags) {
            return [];
        }

        // Get tags as array and make them lowercase for comparison
        $tagsArray = array_map('strtolower', $this->getTagsArray());
        $tourismKeywordsLower = array_map('strtolower', $tourismKeywords);

        return array_intersect($tagsArray, $tourismKeywordsLower);
    }

    public function isAboutSafari()
    {
        $content = strtolower($this->title . ' ' . $this->body);

        // Handle tags properly - convert to string for search
        $tagsString = '';
        if ($this->tags) {
            if (is_string($this->tags)) {
                $tagsString = $this->tags;
            } else {
                $tagsString = implode(' ', $this->tags);
            }
        }

        $content .= ' ' . strtolower($tagsString);

        $safariKeywords = ['safari', 'wildlife', 'game drive', 'national park', 'animals'];

        foreach ($safariKeywords as $keyword) {
            if (strpos($content, $keyword) !== false) {
                return true;
            }
        }

        return false;
    }
}
