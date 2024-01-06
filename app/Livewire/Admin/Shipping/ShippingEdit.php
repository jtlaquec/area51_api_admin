<?php

namespace App\Livewire\Admin\Shipping;

use Livewire\Component;

class ShippingEdit extends Component
{

    public $order;

    public $shippings = [];


    public function mount ($order)
    {

        $this->order = $order;
        foreach ($order->shipping as $index => $shipp) {
            $this->shippings[$index] = [
                'cost' => $shipp->cost,
                'estimated_delivery_date' => $shipp->estimated_delivery_date,
                'shipping_number' => $shipp->shipping_number,
                'shipping_code' => $shipp->shipping_code,
                'notes' => $shipp->notes,
            ];
        }
    }

    public function save($index)
    {
        $shipping = $this->order->shipping->get($index) ?? null;
        if ($shipping) {
            $validatedData = $this->validate([
                "shippings.$index.estimated_delivery_date" => 'required|date',
                "shippings.$index.shipping_number" => 'sometimes',
                "shippings.$index.shipping_code" => 'sometimes',
                "shippings.$index.notes" => 'sometimes',
            ])['shippings'][$index];

            $shipping->update($validatedData);

            $this->dispatch('swal',[
                'icon' => 'success',
                'title' => '¡Bien hecho!',
                'text' => 'Envio actualizado correctamente.',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.shipping.shipping-edit');
    }
}
