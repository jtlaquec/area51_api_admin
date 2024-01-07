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

    public $showModal = false;

    public $selectedImagePath = '';


    public $openModal = false;
    public $selectedItem = null;

    public function mount($order)
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

    public function openModalWithItem($index)
    {
        $this->selectedItem = $index;
        $this->selectedImagePath = 'storage/' . $this->order->payment_detail[$index]->image_path;
        $this->openModal = true;
    }

    public function showModal($index)
    {
        $this->selectedImagePath = $this->order->payment_detail[$index]->image_path ?? ''; // Asegúrate de que la ruta sea correcta
        $this->showModal = true;
    }

    public function save($index)
    {
        $payment_detail = $this->order->payment_detail->get($index) ?? null;
        if ($payment_detail) {
            $validatedData = $this->validate([
                "payments.$index.payment_state_id" => 'required|exists:payment_states,id',
                "payments.$index.notes" => 'sometimes',
            ])['payments'][$index];

            $payment_detail->update($validatedData);

            if ($validatedData['payment_state_id'] == 2) {
                $this->order->update(['state_id' => 2]);
            }

            $this->dispatch('orderUpdated', $this->order->id);

            $this->dispatch('swal', [
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
