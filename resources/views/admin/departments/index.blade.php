<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Costos de Envío',
    ],
]">

<div>

    @livewire('admin.departments-index')

</div>


</x-admin-layout>
