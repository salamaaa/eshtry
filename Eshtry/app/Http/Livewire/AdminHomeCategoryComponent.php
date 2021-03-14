<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\HomeCategory;
use Livewire\Component;

class AdminHomeCategoryComponent extends Component
{
    public $select_categories;
    public $products_no;
    public function mount(){
        $category = HomeCategory::find(1);
        $this->select_categories = explode(',',$category->select_categories);
        $this->products_no = $category->products_no;
    }
    public function updateHomeCategory(){
        $category = HomeCategory::find(1);
        $category->select_categories = implode(',',$this->select_categories);
        $category->products_no = $this->products_no;
        $category->save();
        session()->flash('message','Home Category Updated Successfully!');
    }
    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin-home-category-component',['categories'=>$categories])
            ->layout('layouts.base');
    }
}
