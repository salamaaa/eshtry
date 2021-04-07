<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Sale;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class DetailsComponent extends Component
{
    public $slug;
    public $qty;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->qty = 1;
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, $this->qty, $product_price)
            ->associate(Product::class);
        session()->flash('success_message', 'Item added to Cart');
        return redirect()->route('cart');
    }
    public function wish($product_id, $product_name, $product_price){
        Cart::instance('wishlist')
            ->add($product_id, $product_name, 1, $product_price)
            ->associate(Product::class);
        $this->emitTo('wishlist-count-component','refreshComponent');  //fire refresh event when adding to wishlist
    }

    public function increaseQty()
    {
        $this->qty++;
    }

    public function decreaseQty()
    {
        if ($this->qty > 1)
            $this->qty--;
    }

    public function render()
    {
        $product = Product::where('slug', $this->slug)
            ->first();
        $popular_products = Product::inRandomOrder()
            ->limit(4)
            ->get();
        $related_products = Product::where('category_id', $product->category_id)
            ->inRandomOrder()
            ->limit(5)
            ->get();
        $sale = Sale::find(1);
        return view('livewire.details-component', [
            'product' => $product,
            'popular_products' => $popular_products,
            'related_products' => $related_products,
            'sale' => $sale
        ])->layout('layouts.base');
    }
}
