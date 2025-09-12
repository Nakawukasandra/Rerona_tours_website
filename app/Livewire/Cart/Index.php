<?php

namespace App\Livewire\Cart;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;

class Index extends Component
{
    public $cartItems = [];
    public $cartTotal = 0;
    public $cartCount = 0;

    protected $listeners = [
        'cartUpdated' => 'loadCart'
    ];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cartItems = Cart::getCartItems();
        $this->cartTotal = Cart::getCartTotal();
        $this->cartCount = Cart::getCartCount();
    }

    public function updateQuantity($cartId, $quantity)
    {
        if ($quantity < 1) {
            $this->removeItem($cartId);
            return;
        }

        $cartItem = Cart::find($cartId);
        if ($cartItem) {
            $cartItem->updateQuantity($quantity);
            $this->loadCart();
            $this->dispatch('cartUpdated');
            session()->flash('message', 'Cart updated successfully!');
        }
    }

    public function updatePeople($cartId, $noPeople)
    {
        if ($noPeople < 1) {
            return;
        }

        $cartItem = Cart::find($cartId);
        if ($cartItem) {
            $cartItem->updateQuantity($cartItem->quantity, $noPeople);
            $this->loadCart();
            $this->dispatch('cartUpdated');
            session()->flash('message', 'Number of people updated successfully!');
        }
    }

    public function removeItem($cartId)
    {
        $cartItem = Cart::find($cartId);
        if ($cartItem) {
            $cartItem->removeFromCart();
            $this->loadCart();
            $this->dispatch('cartUpdated');
            session()->flash('message', 'Item removed from cart successfully!');
        }
    }

    public function clearCart()
    {
        Cart::clearCart();
        $this->loadCart();
        $this->dispatch('cartUpdated');
        session()->flash('message', 'Cart cleared successfully!');
    }

    public function proceedToCheckout()
    {
        if ($this->cartCount === 0) {
            session()->flash('error', 'Your cart is empty!');
            return;
        }

        // Redirect to checkout page or booking page
        return redirect()->route('booking');
    }

    public function render()
    {
        return view('livewire.cart.index')
            ->layout('layouts.cart')
            ->title('Shopping Cart');
    }
}
