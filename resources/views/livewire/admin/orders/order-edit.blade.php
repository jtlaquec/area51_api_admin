<div>
    <x-label class="mb-2">
        ORDEN DE PRODUCTO
    </x-label>
    <form wire:submit.prevent="save">

        <x-validation-errors class="mb-4">

        </x-validation-errors>

        <div class="card">
            <div class="mb-4 flex flex-wrap -mx-2">
                <div class="px-2">
                    <x-label for="order_id" class="mb-2">
                        ID
                    </x-label>
                    <x-input id="order_id" class="w-full bg-gray-100" value="{{ $order->id }}" disabled />
                </div>

                <div class="px-2">
                    <x-label for="order_number" class="mb-2">
                        Número de la Orden
                    </x-label>
                    <x-input id="order_number" class="w-full bg-gray-100" value="{{ $order->number }}" disabled />
                </div>

                <div class="px-2">
                    <x-label for="order_datetime" class="mb-2">
                        Fecha y Hora de Pedido
                    </x-label>
                    <x-input id="order_datetime" class="w-full bg-gray-100" value="{{ $order->datetime }}" disabled />
                </div>


            </div>


            <div class="mb-4 flex flex-wrap -mx-2">

                <div class="px-2">
                    <x-label for="order_datetime" class="mb-2">
                        DNI de Cliente
                    </x-label>
                    <x-input id="order_datetime" class="w-full bg-gray-100" value="{{ $order->user->document }}"
                        disabled />
                </div>

                <div class="px-2">
                    <x-label for="order_datetime" class="mb-2">
                        Celular
                    </x-label>
                    <x-input id="order_datetime" class="w-full bg-gray-100" value="{{ $order->user->phone }}"
                        disabled />
                </div>

                <div class="px-2">
                    <x-label for="order_datetime" class="mb-2">
                        Correo
                    </x-label>
                    <x-input id="order_datetime" class="w-full bg-gray-100" value="{{ $order->user->email }}"
                        disabled />
                </div>

            </div>


            <div class="mb-4">


                <x-label class="mb-2">
                    Nombre del Cliente
                </x-label>

                <x-input id="order_client" class="w-full bg-gray-100" value="{{ $order->user->name }}" disabled />
            </div>

            <div class="mb-4 flex flex-wrap -mx-2">
                <div class="px-2">
                    <x-label for="order_id" class="mb-2">
                        Total
                    </x-label>
                    <x-input id="order_id" class="w-full bg-gray-100" value="{{ $order->total }}" disabled />
                </div>

                <div class="px-2">
                    <x-label for="state_id" class="mb-2">
                        Estado
                    </x-label>
                    <x-select class="" wire:model.live="state_id">

                        <option value="" disabled>
                            Seleccione una estado de orden
                        </option>

                        @foreach ($states as $state)
                            <option value="{{ $state->id }}">
                                {{ $state->name }}
                            </option>
                        @endforeach
                    </x-select>



                </div>


            </div>


            <div class="flex justify-start">


                <x-button type="button" onclick="confirmOrderEdit()" class="">Actualizar Estado</x-button>




            </div>
        </div>

    </form>


    @push('js')
        <script>
            function confirmOrderEdit() {
                Swal.fire({
                    title: "¿Estás seguro de cambiar el estado de la orden?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Sí, editar!",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log("Confirmado");
                        @this.call('save');
                    }
                });
            }
        </script>
    @endpush

</div>
