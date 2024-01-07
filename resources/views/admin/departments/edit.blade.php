<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Costos de envío',
        'route' => route('admin.departments.index'),
    ],
    [
        'name' => $department->name,
    ],

]">

<div class="mb-12">
    @livewire('admin.department.department-edit', ['department' => $department], key('department-edit-' . $department->id))
</div>


</x-admin-layout>
