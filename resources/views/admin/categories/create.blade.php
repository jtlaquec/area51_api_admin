<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Categorías',
        'route' => route('admin.categories.index'),
    ],
    [
        'name' => 'Nuevo',
    ],
]">

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        <div class="card">

            <x-validation-errors class="mb-4">

            </x-validation-errors>

            <div class="mb-4">
                <x-label class="mb-2">

                    Familia

                </x-label>

                <x-select name="family_id" class="w-full">
                    @foreach ($families as $family)
                        <option value="{{ $family->id }}"
                        @selected(old('family_id')== $family->id)>
                            {{ $family->name }}
                        </option>
                    @endforeach

                </x-select>


            </div>

            <div class ="mb-4">
                <x-label class="mb-2">
                    Nombre
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el nombre de la categoría" name="name"
                    value="{{ old('name') }}">
                </x-input>
            </div>

            <div class ="flex justify-end">
                <x-button>
                    Guardar
                </x-button>
            </div>
        </div>

    </form>





</x-admin-layout>
