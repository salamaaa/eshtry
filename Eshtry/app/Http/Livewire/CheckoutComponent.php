<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CheckoutComponent extends Component
{
    public $ship_to_different_address;
    public $fname;
    public $lname;
    public $email;
    public $mobile;
    public $country;
    public $city;
    public $province;
    public $line1;
    public $line2;
    public $zipcode;

    //s for shipping part
    public $s_fname;
    public $s_lname;
    public $s_email;
    public $s_mobile;
    public $s_country;
    public $s_city;
    public $s_province;
    public $s_line1;
    public $s_line2;
    public $s_zipcode;

    public function render()
    {
        return view('livewire.checkout-component')->layout('layouts.base');
    }
}
