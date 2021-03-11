<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartComponent extends Component
{
    public function increaseQty($rowId){
        $product = Cart::get($rowId);
        $qty = $product->qty + 1;
        Cart::update($rowId,$qty);
    }
    public function decreaseQty($rowId){
        $product = Cart::get($rowId);
        $qty = $product->qty - 1;
        Cart::update($rowId,$qty);
    }
    public function removeItem($rowId){
        Cart::remove($rowId);
        session()->flash('success_message','Item successfully removed!');
    }
    public function removeAllItems(){
        Cart::destroy();
        session()->flash('success_message','All Items successfully removed!');
    }

    public function render()
    {
        return view('livewire.cart-component')->layout('layouts.base');
    }
}
