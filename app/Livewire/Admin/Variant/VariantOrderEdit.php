<?php

namespace App\Livewire\Admin\Variant;

use Livewire\Component;

class VariantOrderEdit extends Component
{
    public $order;

    public function mount ($order)
    {




    }
    public function render()
    {
        return view('livewire.admin.variant.variant-order-edit');
    }
}
