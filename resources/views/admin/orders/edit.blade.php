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
        'name' => $order->id ,
    ],

]">

<div class="mb-12">
    @livewire('admin.orders.order-edit', ['order' => $order], key('order-edit-' . $order->id))
</div>

{{-- <div class="mb-12">
    @livewire('admin.shipping.shipping-edit', ['order' => $order], key('shipping-edid-' . $order->id))
</div> --}}


</x-admin-layout>
