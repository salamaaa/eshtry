<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Gloudemans\Shoppingcart\Facades\Cart;

class CategoryComponent extends Component
{
    use WithPagination;

    public $sorting;
    public $pageSize;
    public $categorySlug;

    public function mount($category_slug)
    {
        $this->sorting = 'default';
        $this->pageSize = 12;
        $this->categorySlug = $category_slug;
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)
            ->associate(Product::class);
        session()->flash('success_message', 'Item added successfully');
        return redirect()->route('cart');
    }

    public function render()
    {
        $category = Category::where('slug',$this->categorySlug)->first();
        if ($this->sorting == 'date') {
            $products = Product::where('category_id',$category->id)->orderBy('created_at', 'DESC')->paginate($this->pageSize);
        } elseif ($this->sorting == 'price') {
            $products = Product::where('category_id',$category->id)->orderBy('regular_price', 'ASC')->paginate($this->pageSize);
        } elseif ($this->sorting == 'price-desc') {
            $products = Product::where('category_id',$category->id)->orderBy('regular_price', 'DESC')->paginate($this->pageSize);
        } else {
            $products = Product::where('category_id',$category->id)->paginate($this->pageSize);
        }
        $categories = Category::all();
        return view('livewire.category-component',['products'=>$products,'categories'=>$categories,'category'=>$category])
            ->layout('layouts.base');
    }
}
