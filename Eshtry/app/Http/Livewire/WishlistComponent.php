<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class WishlistComponent extends Component
{
    public function store($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')
            ->add($product_id, $product_name, 1, $product_price)
            ->associate(Product::class);
        session()->flash('success_message', 'Item added successfully');
        return redirect()->route('cart');
    }
    public function deleteFromWishList($product_id){
        foreach (Cart::instance('wishlist')->content() as $witem){
            if ($witem->id == $product_id){
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('wishlist-count-component','refreshComponent');
                return;
            }
        }
    }
    public function render()
    {
        return view('livewire.wishlist-component')
            ->layout('layouts.base');
    }
}
