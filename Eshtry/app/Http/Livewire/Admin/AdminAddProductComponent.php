<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminAddProductComponent extends Component
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

    protected $rules = ['name' => 'required|string|unique:products',
//        'slug' => 'required|unique:products',
        'short_description' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'sale_price' => 'required|numeric',
        'quantity' => 'required|numeric',
        'featured' => 'required',
        'stock_status' => 'required',
        'image' => 'required|image',
        'category_id' => 'required'];

    public function mount()
    {
        $this->featured = 0;
        $this->stock_status = 'instock';
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function storeProduct()
    {
        $this->validate();
        $product = new Product();
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

        $imageName = time() . '.' . $this->image->extension();
        $this->image->storeAs('products', $imageName);
        $product->image = $imageName;

        $product->save();
        session()->flash('message', 'Product Added Successfully!');
        return redirect()->route('admin.products');
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-add-product-component', ['categories' => $categories])
            ->layout('layouts.base');
    }
}
