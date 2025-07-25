<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticlesTip extends Model
{
    use HasFactory;

    protected $table = 'articles_tips';

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'type',
        'category',
        'featured',
        'published',
        'views',
        'tags',
        'meta_title',
        'meta_description',
        'sort_order'
    ];

    protected $casts = [
        'featured' => 'boolean',
        'published' => 'boolean',
        'tags' => 'array',
        'views' => 'integer',
        'sort_order' => 'integer'
    ];

    // Scopes for your safari website
    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}
