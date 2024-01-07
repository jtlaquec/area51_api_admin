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
        'name' => $user->name,
    ],
]">

<x-validation-errors class="mb-4">

</x-validation-errors>
    <div class="card">

        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf

            @method('PUT')

            <div class ="mb-4">
                <x-label class="mb-2">
                    Nombre
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el nombre del Usuario" name="name"
                    value="{{ old('name', $user->name) }}">
                </x-input>
            </div>

            <div class ="mb-4">
                <x-label class="mb-2">
                    DNI
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el DNI del Usuario" name="document"
                    value="{{ old('document', $user->document) }}">
                </x-input>
            </div>

            <div class ="mb-4">
                <x-label class="mb-2">
                    Correo Electrónico
                </x-label>
                <x-input type="email" class="w-full" placeholder="Ingrese el email del Usuario" name="email"
                    value="{{ old('email', $user->email) }}">
                </x-input>
            </div>





            <div class ="mb-4">
                <x-label class="mb-2">
                    Celular
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el celular del Usuario" name="phone"
                    value="{{ old('phone', $user->phone) }}">
                </x-input>
            </div>

            <div class ="mb-4">
                <x-label class="mb-2">
                    Fecha de Nacimiento
                </x-label>
                <x-input class="w-full" type="date" placeholder="Ingrese la fecha de nacimiento del Usuario" name="birth_date"
                    value="{{ old('birth_date', $user->birth_date) }}">
                </x-input>
            </div>

            <div class="mb-4">
                <x-label class="mb-2">
                    Estado
                </x-label>
                <x-select name="status" class="w-full">
                    <option value="1" {{ old('status', $user->status) == 1 ? 'selected' : '' }}>Activado</option>
                    <option value="0" {{ old('status', $user->status) == 0 ? 'selected' : '' }}>Desactivado
                    </option>
                </x-select>
            </div>




            <div>
                <div class="flex justify-start">

                    <x-button class="" type="submit">
                        Actualizar
                    </x-button>

                    <x-danger-button onclick="confirmDelete()" class="ml-2" type="button">
                        Eliminar Usuario
                    </x-danger-button>

                    <x-button onclick="confirmPassword()" class="ml-2" type="button">
                        Reestablecer Contraseña
                    </x-button>

                </div>
            </div>

        </form>

        <div>


        </div>


    </div>

    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" id="delete-form">
        @csrf
        @method('DELETE')
    </form>

    <form action="{{ route('admin.users.generatePassword', $user) }}" method="POST" id="generate-form">
        @csrf
        @method('POST')
    </form>

    @push('js')
        <script>
            function confirmDelete() {
                Swal.fire({
                    title: "¿Estas seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Sí, borralo!",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form').submit();
                    }
                });

            }

            function confirmPassword() {
                Swal.fire({
                    title: "¿Estas seguro de reestablecer la contraseña?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Sí, borralo!",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('generate-form').submit();
                    }
                });

            }
        </script>
    @endpush

</x-admin-layout>
