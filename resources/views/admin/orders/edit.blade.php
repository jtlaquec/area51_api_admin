<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Ordenes',
        'route' => route('admin.orders.index'),
    ],
    [
        'name' => 'Orden N° '.$order->number,
    ],

]">

<div class="mb-12">
    @livewire('admin.orders.order-edit', ['order' => $order], key('order-edit-' . $order->id))
</div>

<div class="mb-12">
    @livewire('admin.shipping.shipping-edit', ['order' => $order], key('shipping-edit-' . $order->id))
</div>

<div class="mb-12">
    @livewire('admin.payment.payment-edit', ['order' => $order], key('payment-edit-' . $order->id))
</div>


</x-admin-layout>
