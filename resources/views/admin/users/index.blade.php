<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Usuarios',
    ],
]">
    @role('Administrador')
    <x-slot name="action">
        <a class="btn btn-blue" href="{{ route('admin.users.create') }}">
            Añadir Usuario
        </a>
    </x-slot>
    @endrole
    <div>
        @livewire('admin.users-index')

    </div>
</x-admin-layout>
