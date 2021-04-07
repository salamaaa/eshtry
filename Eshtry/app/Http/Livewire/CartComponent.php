<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartComponent extends Component
{
    public function increaseQty($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->emitTo('cart-count-component', 'refreshComponent');  //fire refresh event when committing changes to  cart
    }

    public function decreaseQty($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->emitTo('cart-count-component', 'refreshComponent');  //fire refresh event when committing changes to  cart
    }

    public function removeItem($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        $this->emitTo('cart-count-component', 'refreshComponent');  //fire refresh event when committing changes to  cart
        session()->flash('success_message', 'Item successfully removed!');
    }

    public function removeAllItems()
    {
        Cart::instance('cart')->destroy();
        $this->emitTo('cart-count-component', 'refreshComponent');  //fire refresh event when committing changes to  cart
        session()->flash('success_message', 'All Items successfully removed!');
    }

    public function saveForLater($rowId)
    {
        $item = Cart::instance('cart')->get($rowId);
        Cart::instance('cart')->remove($rowId);
        Cart::instance('save_for_later')
            ->add($item->id, $item->name, 1, $item->price)
            ->associate(Product::class);
        $this->emitTo('cart-count-component','refreshComponent');
        session()->flash('success_message_later','Product Saved for Later');
    }

    public function moveToCart($rowId){
        $item = Cart::instance('save_for_later')->get($rowId);
        Cart::instance('save_for_later')->remove($rowId);
        Cart::instance('cart')
            ->add($item->id, $item->name, 1, $item->price)
            ->associate(Product::class);
        $this->emitTo('cart-count-component','refreshComponent');
        session()->flash('success_message_later','Product Added to Cart');
    }

    public function deleteFormSavedForLater($rowId){
        Cart::instance('save_for_later')->remove($rowId);
        //$this->emitTo('cart-count-component', 'refreshComponent');  //fire refresh event when committing changes to  cart
        session()->flash('success_message_later', 'Item successfully removed!');
    }

    public function render()
    {
        return view('livewire.cart-component')->layout('layouts.base');
    }
}
