<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;


class AdminEditProductComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $slug;
    public $short_description;
    public $description;
    public $price;
    public $sale_price;
    public $quantity;
    public $featured;
    public $stock_status;
    public $image;
    public $category_id;
    public $newImage;
    public $product_id;

    public function mount($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->short_description = $product->short_description;
        $this->description = $product->description;
        $this->price = $product->regular_price;
        $this->sale_price = $product->sale_price;
        $this->quantity = $product->quantity;
        $this->featured = $product->featured;
        $this->stock_status = $product->stock_status;
        $this->image = $product->image;
        $this->category_id = $product->category_id;
        $this->product_id = $product->id;
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function updateProduct()
    {
        $product = Product::find($this->product_id);

        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->regular_price = $this->price;
        $product->sale_price = $this->sale_price;
        $product->featured = $this->featured;
        $product->stock_status = $this->stock_status;
        $product->category_id = $this->category_id;
        $product->quantity = $this->quantity;
        $product->short_description = $this->short_description;
        $product->description = $this->description;

        if ($this->newImage) {
            $imageName = time() . '.' . $this->newImage->extension();
            $this->newImage->storeAs('products', $imageName);
            $product->image = $imageName;
        }
        $product->save();
        session()->flash('message', 'Product Updated Successfully!');
    }

    function render()
    {
        $categories = Category::all();
        return view('livewire.admin-edit-product-component',['categories'=>$categories])
            ->layout('layouts.base');
    }
}
