<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Ordenes',
    ],
]">

    {{--     <x-slot name="action">
        <a class="btn btn-blue" href="{{ route('admin.orders.create') }}">
            Nuevo
        </a>

    </x-slot> --}}

    <div>

        @livewire('admin.orders-index')

    </div>

</x-admin-layout>
