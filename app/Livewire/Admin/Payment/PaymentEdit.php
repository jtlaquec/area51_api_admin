<?php

namespace App\Livewire\Admin\Payment;

use Livewire\Component;
use App\Models\PaymentState;

class PaymentEdit extends Component
{

    public $order;

    public $payments = [];

    public $payment_states;

    public $payment_state_id = '';

    public function mount ($order)
    {


        $this->order = $order;
        foreach ($order->payment_detail as $index => $payment) {
            $this->payments[$index] = [
                'payment_state_id' => $payment->payment_state_id,
                'notes' => $payment->notes,
            ];
        }

        $this->payment_states = PaymentState::all();

    }

    public function save($index)
    {
        $payment_detail = $this->order->payment_detail->get($index) ?? null;
        if ($payment_detail) {
            $validatedData = $this->validate([
                "payments.$index.payment_state_id" => 'required|date',
            ])['payments'][$index];

            $payment_detail->update($validatedData);

            $this->dispatch('swal',[
                'icon' => 'success',
                'title' => '¡Bien hecho!',
                'text' => 'Estado de pago actualizado correctamente.',
            ]);
        }
    }


    public function render()
    {
        return view('livewire.admin.payment.payment-edit');
    }
}
