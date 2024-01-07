<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Reseñas y Calificaciones',
        'route' => route('admin.comments.index'),
    ],
    [
        'name' => $comment->name,
    ],
]">

    <x-validation-errors class="mb-4">

    </x-validation-errors>
    <div class="card">

        <form action="{{ route('admin.comments.update', $comment) }}" method="POST">
            @csrf

            @method('PUT')


            <div class ="mb-4">
                <x-label class="mb-2">
                    SKU Producto
                </x-label>
                <x-input class="w-full bg-gray-100" placeholder="Ingrese el DNI del Usuario" name="sku"
                    value="{{ $comment->product->sku }}" disabled>
                </x-input>
            </div>

            <div class ="mb-4">
                <x-label class="mb-2">
                    Nombre de Producto
                </x-label>
                <x-input class="w-full bg-gray-100" placeholder="Ingrese el DNI del Usuario" name="product-name"
                    value="{{ $comment->product->name }}" disabled>
                </x-input>
            </div>

            <div class ="mb-4">
                <x-label class="mb-2">
                    Fecha y Hora de la calificación y reseña
                </x-label>
                <x-input type="datetime-local" class="w-full bg-gray-100" placeholder="Ingrese el email del Usuario"
                    name="email" value="{{ $comment->created_at }}" disabled>
                </x-input>
            </div>


            <div class ="mb-4">
                <x-label class="mb-2">
                    Nombre del Cliente
                </x-label>
                <x-input class="w-full bg-gray-100" placeholder="Ingrese el nombre del Usuario" name="name"
                    value="{{ $comment->name }}" disabled>
                </x-input>
            </div>

            <div class ="mb-4">
                <x-label class="mb-2">
                    Calificación
                </x-label>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <div class="flex items-center">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="w-4 h-4 ms-1 {{ $i <= $comment->rating ? 'text-yellow-300' : 'text-gray-300 dark:text-gray-500' }}"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                        @endfor
                    </div>
                </td>

            </div>

            <div class ="mb-4">
                <x-label class="mb-2">
                    Comentario
                </x-label>
                <textarea id="message" rows="4"
                    class="block p-2.5 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="" disabled>{{ $comment->comment }}</textarea>

            </div>

            <div class ="mb-4">
                <x-label class="mb-2">
                    Respuesta
                </x-label>

                <textarea id="response" rows="4" name="response"
                    class="block p-2.5 w-full text-gray-900  rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Ingrese una respuesta al comentario">{{ $comment->response }}</textarea>
            </div>


            <div>
                <div class="flex justify-start">

                    <x-button class="" type="submit">
                        Responder Comentario
                    </x-button>

                    <x-danger-button onclick="confirmDelete()" class="ml-2" type="button">
                        Eliminar Calificación y Reseña
                    </x-danger-button>


                </div>
            </div>

        </form>

        <div>


        </div>


    </div>

    <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST" id="delete-form">
        @csrf
        @method('DELETE')
    </form>

    @push('js')
        <script>
            function confirmDelete() {
                Swal.fire({
                    title: "¿Estas seguro de borrar el comentario y la reseña?",
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
        </script>
    @endpush

</x-admin-layout>
