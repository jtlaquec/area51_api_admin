<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Usuarios',
        'route' => route('admin.users.index'),
    ],
    [
        'name' => 'Nuevo Usuario',
    ],
]">

    <div class="card">

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <x-validation-errors class="mb-4">
            </x-validation-errors>

{{--             <div class ="mb-4">
                <x-label class="mb-2">
                    Nombre
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el nombre de la familia" name="name"
                    value="{{ old('name') }}">
                </x-input>
            </div> --}}


            <div class ="mb-4">
                <x-label class="mb-2">
                    Nombre
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el nombre del Usuario" name="name"
                    value="{{ old('name')}}">
                </x-input>
            </div>

            <div class ="mb-4">
                <x-label class="mb-2">
                    DNI
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el DNI del Usuario" name="document"
                    value="{{ old('document') }}">
                </x-input>
            </div>

            <div class ="mb-4">
                <x-label class="mb-2">
                    Correo Electrónico
                </x-label>
                <x-input type="email" class="w-full" placeholder="Ingrese el email del Usuario" name="email"
                    value="{{ old('email') }}">
                </x-input>
            </div>

            <div class ="mb-4">
                <x-label class="mb-2">
                    Celular
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el celular del Usuario" name="phone"
                    value="{{ old('phone') }}">
                </x-input>
            </div>

            <div class ="mb-4">
                <x-label class="mb-2">
                    Fecha de Nacimiento
                </x-label>
                <x-input class="w-full" type="date" placeholder="Ingrese la fecha de nacimiento del Usuario" name="birth_date"
                    value="{{ old('birth_date') }}">
                </x-input>
            </div>

            <div class ="mb-4">
                <x-label class="mb-2">
                    Contraseña
                </x-label>
                <x-input class="w-full" type="password" placeholder="Ingrese la contraseña del Usuario" name="password"
                    value="{{ old('password') }}">
                </x-input>
            </div>

            <div class="mb-4">
                <x-label class="mb-2">
                    Estado
                </x-label>
                <x-select name="status" class="w-full">

                    <option value="1" selected>Activado</option>
                    <option value="0">Desactivado</option>
                </x-select>
            </div>











            <div class ="flex justify-start">
                <x-button>
                    Guardar
                </x-button>
            </div>

        </form>

    </div>




</x-admin-layout>
