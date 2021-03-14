<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\HomeCategory;
use App\Models\Homeslider;
use App\Models\Product;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $sliders = Homeslider::where('status',1)->get();
        $latest_products = Product::orderBy('created_at','DESC')->get()->take(8);
        $homeCategory = HomeCategory::find(1);
        $cats = explode(',',$homeCategory);
        $categories = Category::whereIn('id',$cats)->get();
        $products_no = $homeCategory->products_no;
        return view('livewire.home-component',
            ['sliders'=>$sliders,
            'latest_products'=>$latest_products,
            'categories'=>$categories,
            'products_no'=>$products_no])
            ->layout('layouts.base');
    }
}

