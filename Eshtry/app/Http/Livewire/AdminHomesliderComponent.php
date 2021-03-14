<?php

namespace App\Http\Livewire;

use App\Models\Homeslider;
use Livewire\Component;
use Livewire\WithPagination;

class AdminHomesliderComponent extends Component
{
    use WithPagination;

    public function deleteSlider($id){
        Homeslider::destroy($id);
        session()->flash('message','Slider Deleted Successfully!');
    }

    public function render()
    {
        $sliders = Homeslider::paginate(1);
        return view('livewire.admin-homeslider-component',['sliders'=>$sliders])
            ->layout('layouts.base');
    }
}
