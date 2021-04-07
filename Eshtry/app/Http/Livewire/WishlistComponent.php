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
    public function moveFromWishlistToCart($rowId){
        $item = Cart::instance('wishlist')->get($rowId);
        Cart::instance('wishlist')->remove($rowId);
        Cart::instance('cart')
            ->add($item->id,$item->name,1,$item->price)
            ->associate(Product::class);
        $this->emitTo('wishlist-count-component','refreshComponent');
        $this->emitTo('cart-count-component','refreshComponent');
    }

    public function render()
    {
        return view('livewire.wishlist-component')
            ->layout('layouts.base');
    }
}
