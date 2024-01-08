<div>
    <x-label class="mb-2">
        <div class="text-xl font-bold">DETALLES DE LA ORDEN</div>
    </x-label>

    @if ($order->order_details->count())
        <div class="card">
            <div class="relative overflow-x-auto">
                <table class="w-full text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class=" text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                N°
                            </th>
                            <th scope="col" class="px-6 py-3">
                                SKU
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Color
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Talla
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Cantidad
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Precio
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Totales
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        @php
                            $total = 0;
                        @endphp

                        @foreach ($order->order_details as $variant)
                            <tr class="bg-white border-b text-black dark:bg-gray-800 dark:border-gray-700">

                                <td class="px-6 py-4">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $variant->product_variant->sku }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $variant->product_variant->name }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $variant->product_variant->color->description }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $variant->product_variant->size->value }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $variant->quantity }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $variant->price }}
                                </td>


                                @php
                                    $subtotal = $variant->quantity * $variant->price;
                                    $total += $subtotal;
                                @endphp


                                <td class="px-6 py-4">
                                    {{ number_format($subtotal, 2) }}
                                </td>

                            </tr>
                        @endforeach

                        <tr class=" bg-white border-b text-black dark:bg-gray-800 dark:border-gray-700">

                            <td class="px-6 py-4">
                            </td>

                            <td class="px-6 py-4">
                            </td>

                            <td class="px-6 py-4 text-center uppercase font-bold">
                                Totales
                            </td>

                            <td class="px-6 py-4">
                            </td>

                            <td class="px-6 py-4">
                            </td>

                            <td class="px-6 py-4">
                            </td>

                            <td class="px-6 py-4">
                            </td>



                            <td class="px-6 py-4 uppercase font-bold">
                                {{ number_format($total, 2) }}
                            </td>

                        </tr>


                    </tbody>

                </table>
            </div>

        </div>
    @else
        <div class="flex items-center p-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium"></span> No hay envíos programados para esta Orden
            </div>
        </div>
    @endif



</div>
