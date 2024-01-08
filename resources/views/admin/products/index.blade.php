<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Productos',
    ],
]">

    <x-slot name="action">
        <a class="btn btn-blue" href="{{ route('admin.products.create') }}">
            Añadir Producto
        </a>
    </x-slot>

    <div>

        @livewire('admin.products-index')

    </div>

</x-admin-layout>
