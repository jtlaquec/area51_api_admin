@php
    $links = [
        [
            'name' => 'Dashboard',
            'icon' => 'fa-solid fa-gauge',
            'route' => route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard')
        ],

        [
            //Opciones
            'name' => 'Opciones',
            'icon' => 'fa-solid fa-cog',
            'route' => route('admin.options.index'),
            'active' => request()->routeIs('admin.options.*')
        ],

        [
            //Familia de productos
            'name' => 'Familias',
            'icon' => 'fa-solid fa-box-open',
            'route' => route('admin.families.index'),
            'active' => request()->routeIs('admin.families.*')
        ],

        [
            //Familia de categorias
            'name' => 'Categorías',
            'icon' => 'fa-solid fa-tags',
            'route' => route('admin.categories.index'),
            'active' => request()->routeIs('admin.categories.*')
        ],

        [
            //Familia de subcategorías
            'name' => 'Subcategorías',
            'icon' => 'fa-solid fa-tag',
            'route' => route('admin.subcategories.index'),
            'active' => request()->routeIs('admin.subcategories.*')
        ],

        [
            //Familia de productos
            'name' => 'Productos',
            'icon' => 'fa-solid fa-box',
            'route' => route('admin.products.index'),
            'active' => request()->routeIs('admin.products.*')
        ],

        [
            //Familia de orders
            'name' => 'Ordenes',
            'icon' => 'fa-solid fa-box',
            'route' => route('admin.orders.index'),
            'active' => request()->routeIs('admin.orders.*')
        ],

        [
            //Familia de usuarios
            'name' => 'Usuarios',
            'icon' => 'fa-solid fa-box',
            'route' => route('admin.users.index'),
            'active' => request()->routeIs('admin.users.*')
        ],




    ];

@endphp

<aside id="logo-sidebar"
{{-- cambiado h-screen por h-[100dvh] --}}
class="fixed top-0 left-0 z-40 w-64 h-[100dvh] pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
:class="{
    'translate-x-0 ease-out': sidebarOpen,
    '-translate-x-full ease-in': !sidebarOpen

}"


aria-label="Sidebar">
<div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
    <ul class="space-y-2 font-medium">
        @foreach ($links as $link )
            <li>
                <a href="{{ $link['route'] }}"
                    {{-- aca cambiamos color activo --}}
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $link['active'] ? 'bg-gray-100': '' }}">

                    <span class = "inline-flex w-6 h-6 justify-center items-center">
                        <i class = "{{ $link['icon'] }} text-gray-500"></i>

                    </span>
                    <span class="ml-2">

                        {{ $link['name'] }}

                    </span>
                </a>
            </li>
        @endforeach

    </ul>
</div>
</aside>
