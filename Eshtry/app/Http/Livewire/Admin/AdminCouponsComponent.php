<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coupon;
use Livewire\Component;

class AdminCouponsComponent extends Component
{

    public function deleteCoupon($id){
        Coupon::destroy($id);
        session()->flash('message','Coupon Deleted Successfully!');
    }

    public function render()
    {
        $coupons = Coupon::paginate(1);
        return view('livewire.admin.admin-coupons-component',['coupons'=>$coupons])
            ->layout('layouts.base');
    }
}
