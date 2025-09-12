<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = [
        'session_id',
        'user_id',
        'product_id',
        'product_type',
        'product_name',
        'product_description',
        'product_image',
        'price',
        'quantity',
        'no_of_people',
        'total_price',
        'tour_date',
        'additional_options',
        'status'
    ];

    protected $casts = [
        'additional_options' => 'array',
        'price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'tour_date' => 'date'
    ];

    /**
     * Get the user that owns the cart item
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Scope for active cart items
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for current user/session cart items
     */
    public function scopeForCurrentUser($query)
    {
        if (auth()->check()) {
            return $query->where('user_id', auth()->id());
        } else {
            return $query->where('session_id', Session::getId());
        }
    }

    /**
     * Get cart items for current session/user
     */
    public static function getCartItems()
    {
        return self::active()->forCurrentUser()->get();
    }

    /**
     * Get cart total
     */
    public static function getCartTotal()
    {
        return self::getCartItems()->sum('total_price');
    }

    /**
     * Get cart count
     */
    public static function getCartCount()
    {
        return self::getCartItems()->count();
    }

    /**
     * Add item to cart
     */
    public static function addToCart($productData)
    {
        $cartItem = new self();
        $cartItem->session_id = auth()->check() ? null : Session::getId();
        $cartItem->user_id = auth()->check() ? auth()->id() : null;
        $cartItem->product_id = $productData['product_id'];
        $cartItem->product_type = $productData['product_type'] ?? 'tour';
        $cartItem->product_name = $productData['product_name'];
        $cartItem->product_description = $productData['product_description'] ?? null;
        $cartItem->product_image = $productData['product_image'] ?? null;
        $cartItem->price = $productData['price'];
        $cartItem->quantity = $productData['quantity'] ?? 1;
        $cartItem->no_of_people = $productData['no_of_people'] ?? 1;
        $cartItem->tour_date = $productData['tour_date'] ?? null;
        $cartItem->additional_options = $productData['additional_options'] ?? null;
        $cartItem->total_price = $cartItem->price * $cartItem->quantity * $cartItem->no_of_people;

        return $cartItem->save();
    }

    /**
     * Update cart item quantity
     */
    public function updateQuantity($quantity, $noPeople = null)
    {
        $this->quantity = $quantity;
        if ($noPeople) {
            $this->no_of_people = $noPeople;
        }
        $this->total_price = $this->price * $this->quantity * $this->no_of_people;
        return $this->save();
    }

    /**
     * Remove item from cart
     */
    public function removeFromCart()
    {
        return $this->delete();
    }

    /**
     * Clear cart for current user/session
     */
    public static function clearCart()
    {
        return self::active()->forCurrentUser()->delete();
    }

    /**
     * Transfer guest cart to user account
     */
    public static function transferGuestCartToUser($userId, $sessionId)
    {
        return self::where('session_id', $sessionId)
                  ->where('user_id', null)
                  ->update([
                      'user_id' => $userId,
                      'session_id' => null
                  ]);
    }

    /**
     * Mark cart items as ordered
     */
    public static function markAsOrdered($cartIds = null)
    {
        $query = self::active();

        if ($cartIds) {
            $query->whereIn('id', $cartIds);
        } else {
            $query->forCurrentUser();
        }

        return $query->update(['status' => 'ordered']);
    }
}
