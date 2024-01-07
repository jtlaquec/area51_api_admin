<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Productos',
        'route' => route('admin.products.index'),
    ],
    [
        'name' => $product->name ,
    ],

]">

<div class="mb-12">
    @livewire('admin.products.product-edit', ['product' => $product], key('product-edit-' . $product->id))
</div>

<div class="mb-12">
    @livewire('admin.variants.variant-edit', ['product' => $product], key('variant-edit-' . $product->id))
</div>

{{-- <div class="mb-12">
    @livewire('admin.products.product-variants', ['product' => $product], key('variants-' . $product->id))
</div> --}}



</x-admin-layout>
