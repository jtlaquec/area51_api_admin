<div>

    <div class="mb-2">
        <x-button wire:click="openAddVariantModal">
            AGREGAR VARIANTE
        </x-button>

    </div>



    @if ($product->productvariants->count())

        @foreach ($product->productvariants as $index => $var)
            <div class="p-6">

                <x-label class="mb-2">
                    <div class="text-xl font-bold">{{ $var->name }}
                        <span class="inline-block h-6 w-6 shadow-lg rounded-full border-2 border-gray-300 mr-4"
                            style="background-color:{{ $var->color->value }}">
                        </span>
                    </div>

                </x-label>



                <form wire:submit.prevent="saveVariant({{ $index }})">

                    <x-validation-errors class="mb-4" />

                    <div class="card">

                        <div class="mb-4 flex flex-wrap -mx-2">

                            <div class="px-2">
                                <x-label for="color_id-{{ $index }}" class="mb-2">Color</x-label>
                                <x-select wire:model.defer="variants.{{ $index }}.color_id"
                                    id="color_id-{{ $index }}">
                                    <option value="" disabled>Seleccione un color</option>
                                    @foreach ($colors as $color)
                                        <option value="{{ $color->id }}">{{ $color->description }}</option>
                                    @endforeach
                                </x-select>
                            </div>

                            <div class="px-2">
                                <x-label for="size_id-{{ $index }}" class="mb-2">Talla</x-label>
                                <x-select wire:model.defer="variants.{{ $index }}.size_id"
                                    id="size_id-{{ $index }}">
                                    <option value="" disabled>Seleccione una talla</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}">{{ $size->value }}</option>
                                    @endforeach
                                </x-select>
                            </div>
                        </div>

                        <div class="mb-4 flex flex-wrap -mx-2">
                            <div class="px-2">
                                <x-label for="sku-{{ $index }}" class="mb-2">SKU</x-label>
                                <x-input wire:model.defer="variants.{{ $index }}.sku"
                                    id="sku-{{ $index }}" class="w-full" placeholder="SKU" />
                            </div>

                            <div class="px-2">
                                <x-label for="stock-{{ $index }}" class="mb-2">Stock</x-label>
                                <x-input wire:model.defer="variants.{{ $index }}.stock"
                                    id="stock-{{ $index }}" class="w-full" placeholder="Stock" />
                            </div>

                            <div class="px-2">
                                <x-label for="price-{{ $index }}" class="mb-2">Precio</x-label>
                                <x-input wire:model.defer="variants.{{ $index }}.price"
                                    id="price-{{ $index }}" class="w-full" placeholder="Precio" />
                            </div>

                            <div class="px-2">
                                <x-label for="discount_price-{{ $index }}" class="mb-2">Precio con
                                    Descuento</x-label>
                                <x-input wire:model="discount_price.{{ $index }}"
                                    id="discount_price.{{ $index }}" class="w-full bg-gray-100"
                                    placeholder="Precio con Descuento" disabled />
                            </div>

                        </div>


                        <div class="flex justify-start">


                            <x-button type="button" onclick="confirmVariantEdit({{ $index }})"
                                class="">Editar Variante</x-button>
                            <x-button type="button" wire:click="openMovementsModal({{ $var->id }})"
                                class="ml-2">
                                Ver Movimientos
                            </x-button>
                            <x-danger-button type="button" onclick="confirmVariantDelete({{ $var->id }})"
                                class="ml-2">
                                Eliminar Variante
                            </x-danger-button>


                        </div>

                    </div>

                </form>

                <form action="{{ route('admin.variants.destroy', $var->id) }}" method="POST"
                    id="delete-formVariant-{{ $var->id }}">
                    @csrf
                    @method('DELETE')
                </form>

            </div>
        @endforeach



        <div>

            <!-- Modal Agregar Nueva Variante -->
            <x-dialog-modal wire:model="showAddVariantModal">
                <x-slot name="title">
                    Agregar Nueva Variante
                </x-slot>

                <x-slot name="content">
                    <x-validation-errors class="mb-4" />

                    <div class="mb-4">
                        <x-label for="color_id" class="mb-2">Color</x-label>
                        <x-select wire:model.defer="variant.color_id" id="color_id">
                            <option value="">Seleccione un color</option>
                            @foreach ($colors as $color)
                                <option value="{{ $color->id }}">{{ $color->description }}</option>
                            @endforeach
                        </x-select>
                    </div>

                    <div class="mb-4">
                        <x-label for="size_id" class="mb-2">Talla</x-label>
                        <x-select wire:model.defer="variant.size_id" id="size_id">
                            <option value="">Seleccione una talla</option>
                            @foreach ($sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->value }}</option>
                            @endforeach
                        </x-select>
                    </div>

                    <div class="mb-4">
                        <x-label for="sku" class="mb-2">SKU</x-label>
                        <x-input wire:model.defer="variant.sku" id="sku" class="w-full" placeholder="SKU" />
                    </div>
                    <div class="mb-4">
                        <x-label for="price" class="mb-2">Precio</x-label>
                        <x-input wire:model.defer="variant.price" id="price" class="w-full" placeholder="Precio"
                            type="number" />
                    </div>
                    <div class="mb-4">
                        <x-label for="stock" class="mb-2">Stock</x-label>
                        <x-input wire:model.defer="variant.stock" id="stock" class="w-full" placeholder="Stock"
                            type="number" />
                    </div>
                </x-slot>

                <x-slot name="footer">
                    <x-danger-button type="button" wire:click="$set('showAddVariantModal', false)">
                        Cancelar
                    </x-danger-button>
                    <x-button class="ml-2" type="button" wire:click="saveNewVariant">
                        Guardar
                    </x-button>
                </x-slot>
            </x-dialog-modal>



            <x-dialog-modal wire:model="showMovementsModal">
                <x-slot name="title">
                    Movimientos de la Variante
                </x-slot>

                <x-slot name="content">


                    @if ($currentVariant)



                        <div class="relative overflow-x-auto">
                            <table class="w-full text-left rtl:text-right0">
                                <thead class="bg-gray-50 ">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            N°
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Fecha y Hora
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            N° Orden
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Cantidad
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($currentVariant->order_details as $detail)
                                        <tr class="bg-white border-b">
                                            <td class="px-6 py-4">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $detail->created_at }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="{{ route('admin.orders.edit', $detail->order_id) }}"
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                                    target="_blank">
                                                    {{ $detail->order->number }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $detail->quantity }}
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="flex items-center p-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                            role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium"></span> No hay movimientos para esta variante
                            </div>
                        </div>


                    @endif


                </x-slot>

                <x-slot name="footer">
                </x-slot>
            </x-dialog-modal>
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
                <span class="font-medium"></span> No hay variantes para este producto.
            </div>
        </div>
    @endif



    @push('js')
        <script>
            function confirmVariantEdit(index) {
                Swal.fire({
                    title: "¿Estás seguro de editar la variante?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Sí, editar!",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.call('saveVariant', index);
                    }
                });
            }




            function confirmVariantDelete(variantId) {
                Swal.fire({
                    title: "¿Estás seguro de eliminar la variante?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Sí, borralo!",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-formVariant-' + variantId).submit();
                    }
                });
            }
        </script>
    @endpush



</div>
