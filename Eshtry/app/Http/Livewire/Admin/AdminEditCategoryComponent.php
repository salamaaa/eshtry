<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;

class AdminEditCategoryComponent extends Component
{
    public $category_id;
    public $category_slug;
    public $slug;
    public $name;

    public function mount($slug){
        $this->category_slug = $slug;
        $category = Category::where('slug',$slug)->first();
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
    }
    public function generateSlug(){
        $this->slug = Str::slug($this->name);
    }
    public function EditCategory(){
        $category = Category::find($this->category_id);
        $category->name = $this->name;
        $category->slug= $this->slug;
        $category->save();
        session()->flash('message','Category Successfully Updated!');
    }
    public function render()
    {
        return view('livewire.admin.admin-edit-category-component')
            ->layout('layouts.base');
    }
}
