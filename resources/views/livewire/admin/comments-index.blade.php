<div>

    <div class="relative overflow-x-auto">

        <div class="pb-4 bg-white dark:bg-gray-900">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative mt-1">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input wire:model.live="search" type="text" id="table-search" class="block pt-2 ps-10 text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar Comentarios o Reseñas">
            </div>
        </div>


        <table class="w-full text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 text-center">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3 text-left">
                        Nombre del Cliente
                    </th>
                    <th scope="col" class="px-6 py-3 text-left">
                        Producto
                    </th>
                    <th scope="col" class="px-6 py-3 text-left">
                        Calificación
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Respuesta
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($comments as $comment)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-center">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $comment->id }}
                        </th>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-left">
                            {{ $comment->user->name }}

                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-left">
                            {{ $comment->product->name }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="flex items-center ">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 ms-1 {{ $i <= $comment->rating ? 'text-yellow-300' : 'text-gray-300 dark:text-gray-500' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                @endfor
                            </div>
                        </td>

                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                            @if ($comment->response == null)

                            <span class="bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Sin Respuesta</span>

                            @else

                            <span class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Respondido</span>

                            @endif

                        </td>

                        <td class="px-6 py-4">
                            <a href="{{ route('admin.comments.edit', $comment) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                Editar
                            </a>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>


    </div>

    <div class="mt-4">
        {{ $comments->links() }}
    </div>
</div>
