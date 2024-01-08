<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Reseñas y Calificaciones',
    ],
]">

<div>

    @livewire('admin.comments-index')

</div>



</x-admin-layout>
