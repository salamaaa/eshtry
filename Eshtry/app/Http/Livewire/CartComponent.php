<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use App\Models\Product;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartComponent extends Component
{
    public $haveCouponCode;
    public $couponCode;
    public $discount;
    public $subtotalAfterDiscount;
    public $taxAfterDiscount;
    public $totalAfterDiscount;


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
        $this->emitTo('cart-count-component', 'refreshComponent');
        session()->flash('success_message_later', 'Product Saved for Later');
    }

    public function moveToCart($rowId)
    {
        $item = Cart::instance('save_for_later')->get($rowId);
        Cart::instance('save_for_later')->remove($rowId);
        Cart::instance('cart')
            ->add($item->id, $item->name, 1, $item->price)
            ->associate(Product::class);
        $this->emitTo('cart-count-component', 'refreshComponent');
        session()->flash('success_message_later', 'Product Added to Cart');
    }

    public function deleteFormSavedForLater($rowId)
    {
        Cart::instance('save_for_later')->remove($rowId);
        //$this->emitTo('cart-count-component', 'refreshComponent');  //fire refresh event when committing changes to  cart
        session()->flash('success_message_later', 'Item successfully removed!');
    }

    public function applyCouponCode()
    {
        $coupon = Coupon::where('code', $this->couponCode)
            ->where('expiry_date','>=',Carbon::today())
            ->first();
        if (!$coupon) {
            session()->flash('coupon_message', 'Coupon is invalid');
            return;
        }
        session()->put('coupon', [
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
            'cart_value' => $coupon->cart_value
        ]);
    }

    public function calculateDiscount()
    {
        if (session()->has('coupon')) {
            if (session()->get('coupon')['type'] == 'fixed') {
                $this->discount = session()->get('coupon')['value'];
            } else {
                $this->discount = ((Cart::instance('cart')->subtotal()) * session()->get('coupon')['value']) / 100;
            }
            $this->subtotalAfterDiscount = Cart::instance('cart')->subtotal() - $this->discount;
            $this->taxAfterDiscount = $this->subtotalAfterDiscount * (config('cart.tax') / 100);
            $this->totalAfterDiscount = $this->subtotalAfterDiscount + $this->taxAfterDiscount;
        }
    }

    public function removeCoupon(){
        session()->forget('coupon');
    }

    public function render()
    {
        if (session()->has('coupon')) {
            if (Cart::instance('cart')->subtotal() < session()->get('coupon')['cart_value']) {
                session()->forget('coupon');
            } else {
                $this->calculateDiscount();
            }
        }
        return view('livewire.cart-component')->layout('layouts.base');
    }
}
