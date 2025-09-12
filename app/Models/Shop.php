<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'price',
        'sale_price',
        'sku',
        'stock_quantity',
        'manage_stock',
        'in_stock',
        'status',
        'images',
        'featured_image',
        'category',
        'tags',
        'weight',
        'dimensions',
        'material',
        'origin',
        'care_instructions',
        'is_featured',
        'is_handmade',
        'sort_order',
        'meta'
    ];

    protected $casts = [
        'images' => 'array',
        'tags' => 'array',
        'meta' => 'array',
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'weight' => 'decimal:2',
        'manage_stock' => 'boolean',
        'in_stock' => 'boolean',
        'is_featured' => 'boolean',
        'is_handmade' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($shop) {
            if (empty($shop->slug)) {
                $shop->slug = Str::slug($shop->name);
            }

            if (empty($shop->sku)) {
                $shop->sku = 'RT-' . strtoupper(Str::random(8));
            }
        });
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('in_stock', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Accessors
    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price, 2);
    }

    public function getFormattedSalePriceAttribute()
    {
        return $this->sale_price ? '$' . number_format($this->sale_price, 2) : null;
    }

    public function getIsOnSaleAttribute()
    {
        return $this->sale_price && $this->sale_price < $this->price;
    }

    public function getDiscountPercentageAttribute()
    {
        if (!$this->is_on_sale) {
            return 0;
        }

        return round((($this->price - $this->sale_price) / $this->price) * 100);
    }

    public function getEffectivePriceAttribute()
    {
        return $this->sale_price ?? $this->price;
    }

    public function getFeaturedImageUrlAttribute()
    {
        if ($this->featured_image) {
            return asset('storage/' . $this->featured_image);
        }

        if ($this->images && count($this->images) > 0) {
            return asset('storage/' . $this->images[0]);
        }

        return asset('images/placeholder-product.jpg');
    }

    public function getImageUrlsAttribute()
    {
        if (!$this->images) {
            return [];
        }

        return array_map(function ($image) {
            return asset('storage/' . $image);
        }, $this->images);
    }

    // Methods
    public function updateStock($quantity, $operation = 'subtract')
    {
        if (!$this->manage_stock) {
            return;
        }

        if ($operation === 'subtract') {
            $this->stock_quantity = max(0, $this->stock_quantity - $quantity);
        } else {
            $this->stock_quantity += $quantity;
        }

        $this->in_stock = $this->stock_quantity > 0;
        $this->save();
    }

    public function hasStock($quantity = 1)
    {
        if (!$this->manage_stock) {
            return $this->in_stock;
        }

        return $this->stock_quantity >= $quantity;
    }

    // Static methods for categories (you can move this to a config file later)
    public static function getCategories()
    {
        return [
            'art' => 'Traditional Art',
            'crafts' => 'Handmade Crafts',
            'jewelry' => 'Jewelry',
            'textiles' => 'Textiles',
            'pottery' => 'Pottery',
            'wood' => 'Wood Carvings',
            'masks' => 'Traditional Masks',
            'baskets' => 'Baskets',
            'instruments' => 'Musical Instruments',
            'books' => 'Books & Maps',
            'souvenirs' => 'Souvenirs'
        ];
    }
}

