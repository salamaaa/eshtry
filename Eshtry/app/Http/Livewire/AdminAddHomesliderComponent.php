<?php

namespace App\Http\Livewire;

use App\Models\Homeslider;
use Livewire\Component;
use Livewire\WithFileUploads;
class AdminAddHomesliderComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $subtitle;
    public $price;
    public $status;
    public $image;
    public $link;

    protected $rules = ['title'=>'required|string|unique:homesliders',
        'subtitle'=>'required|string',
        'price'=>'required|numeric',
        'status'=>'required',
        'link'=>'required|url'];

    public function mount(){
        $this->status = 0;
    }

    public function storeSlider()
    {
        $this->validate();
        $slider = new Homeslider();
        $slider->title = $this->title;
        $slider->subtitle = $this->subtitle;
        $slider->price = $this->price;
        $slider->status = $this->status;
        $slider->link = $this->link;

        $imageName = time().'.'.$this->image->extension();
        $this->image->storeAs('sliders',$imageName);
        $slider->image = $imageName;

        $slider->save();
        session()->flash('message','Slider Added Successfully!');
        return redirect()->route('admin.homeslider');
    }

    public function render()
    {
        return view('livewire.admin-add-homeslider-component')
            ->layout('layouts.base');
    }
}
