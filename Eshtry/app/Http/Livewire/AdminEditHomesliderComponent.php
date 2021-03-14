<?php

namespace App\Http\Livewire;

use App\Models\Homeslider;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminEditHomesliderComponent extends Component
{
    use WithFileUploads;

    public $title;
    public $subtitle;
    public $price;
    public $status;
    public $image;
    public $link;
    public $newImage;
    public $slider_id;


    public function mount($id){
        $slider = Homeslider::find($id);
        $this->title = $slider->title;
        $this->subtitle = $slider->subtitle;
        $this->price = $slider->price;
        $this->status = $slider->status;
        $this->link = $slider->link;
        $this->image = $slider->image;
        $this->slider_id = $slider->id;
    }

    public function updateSlider(){
        $slider = Homeslider::find($this->slider_id);
        $slider->title = $this->title;
        $slider->subtitle = $this->subtitle;
        $slider->price = $this->price;
        $slider->status = $this->status;
        $slider->link = $this->link;

        if ($this->newImage) {
            $imageName = time() . '.' . $this->newImage->extension();
            $this->newImage->storeAs('sliders', $imageName);
            $slider->image = $imageName;
        }
        $slider->save();
        session()->flash('message','Slider Updated Successfully!');
    }

    public function render()
    {
        return view('livewire.admin-edit-homeslider-component')
            ->layout('layouts.base');
    }
}
