<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartComponent extends Component
{
    public function increaseQty($rowId){
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId,$qty);
        $this->emitTo('cart-count-component','refreshComponent');  //fire refresh event when committing changes to  cart
    }
    public function decreaseQty($rowId){
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId,$qty);
        $this->emitTo('cart-count-component','refreshComponent');  //fire refresh event when committing changes to  cart
    }
    public function removeItem($rowId){
        Cart::instance('cart')->remove($rowId);
        $this->emitTo('cart-count-component','refreshComponent');  //fire refresh event when committing changes to  cart
        session()->flash('success_message','Item successfully removed!');
    }
    public function removeAllItems(){
        Cart::instance('cart')->destroy();
        $this->emitTo('cart-count-component','refreshComponent');  //fire refresh event when committing changes to  cart
        session()->flash('success_message','All Items successfully removed!');
    }

    public function render()
    {
        return view('livewire.cart-component')->layout('layouts.base');
    }
}
