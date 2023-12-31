<?php

namespace App\Livewire\Admin\Orders;

use App\Models\State;
use Livewire\Component;

class OrderEdit extends Component
{

    public $order;

    public $states;

    public $state_id = '';

    protected $listeners = ['save' => 'save', 'orderUpdated' => 'handleOrderUpdated'];


    public function mount($order)
    {
        $this->order = $order;

        $this->states = State::all();

        $this->state_id = $order->state_id;
    }



    public function handleOrderUpdated($orderId)
    {
        if ($this->order->id == $orderId) {
            $this->order->refresh();
            $this->state_id = $this->order->state_id;
        }
    }

    public function save()
    {
        $this->validate([
            'state_id' => 'required|exists:states,id', // Asegúrate de que el estado exista.
        ]);

        $this->order->update([
            'state_id' => $this->state_id,
        ]);

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Estado de Orden actualizada correctamente.',
        ]);
    }







    public function render()
    {
        return view('livewire.admin.orders.order-edit');
    }
}
