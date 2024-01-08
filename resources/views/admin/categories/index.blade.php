<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Categorías',
    ],
]">

<x-slot name="action">
    <a class="btn btn-blue" href="{{ route('admin.categories.create') }}">
        Añadir Categoría
    </a>
</x-slot>

<div>

    @livewire('admin.categories-index')

</div>

</x-admin-layout>
