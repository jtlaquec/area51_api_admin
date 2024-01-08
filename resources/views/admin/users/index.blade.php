<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Usuarios',
    ],
]">

    <x-slot name="action">
        <a class="btn btn-blue" href="{{ route('admin.users.create') }}">
            Añadir Usuario
        </a>

    </x-slot>




    <div>

        @livewire('admin.users-index')

    </div>


</x-admin-layout>
