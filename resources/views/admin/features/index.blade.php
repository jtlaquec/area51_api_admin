<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Colores y Tallas',
    ],
]">


<div class="mb-12">
    @livewire('admin.colors.manage-options')
</div>

<div class="mb-12">
    @livewire('admin.sizes.manage-options')
</div>



</x-admin-layout>
