<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;

class AdminAddCategoryComponent extends Component
{
    public $name;
    public $slug;
    public function generateSlug(){
        $this->slug = Str::slug($this->name);
    }
    protected $rules = [
        'name' => 'required|string|unique:categories',
//        'slug' => 'required|unique:categories',
    ];
    public function storeCategory(){
        $this->validate();
        $cat = new Category;
        $cat->name = $this->name;
        $cat->slug= $this->slug;
        $cat->save();
        session()->flash('message','Category Successfully Added!');
        return redirect()->route('admin.categories');
    }
    public function render()
    {
        return view('livewire.admin.admin-add-category-component')
            ->layout('layouts.base');
    }
}
