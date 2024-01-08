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
                <input wire:model.live="search" type="text" id="table-search" class="block pt-2 ps-10 text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar Ordenes">
            </div>
        </div>


        <table class="w-full text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 text-center">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        N° de la Orden
                    </th>
                    <th scope="col" class="px-6 py-3 text-left">
                        Nombre del Cliente
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fecha y Hora
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Estado de la Orden
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($orders as $order)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-center">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $order->id }}
                        </th>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $order->number }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-left">
                            {{ $order->user->name }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $order->datetime }}
                        </td>

                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">


                            @switch($order->state->id)
                                @case(4)
                                    <span
                                        class="bg-purple-100 text-purple-800 font-medium me-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">{{ $order->state->name }}</span>
                                @break

                                @case(5)
                                    <span
                                        class="bg-green-100 text-green-800 font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ $order->state->name }}</span>
                                @break

                                @case(6)
                                    <span
                                        class="bg-red-100 text-red-800 font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">{{ $order->state->name }}</span>
                                @break

                                @default
                                    <span
                                        class="bg-yellow-100 text-yellow-800 font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{ $order->state->name }}</span>
                            @endswitch

                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $order->total }}
                        </td>
                        <td class="px-6 py-4">
                            {{-- <td class="px-6 py-4"> --}}
                            <a href="{{ route('admin.orders.edit', $order) }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                Ver detalles
                            </a>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>


    </div>

    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</div>
