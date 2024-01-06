<?php

namespace App\Livewire\Admin\Shipping;

use App\Models\State;
use Livewire\Component;

class ShippingEdit extends Component
{

/*     public $order;

    public $states;

    public $state_id = '';

    public function mount ($order)
    {

        $this->states = State::all();

        $this->state_id = $order->state_id;


    } */

    public function render()
    {
        return view('livewire.admin.shipping.shipping-edit');
    }
}
