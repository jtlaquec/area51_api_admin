<div>
    <x-label class="mb-2">
        ORDEN DE PRODUCTO
    </x-label>
    <form wire:submit="save">

        <x-validation-errors class="mb-4">

        </x-validation-errors>

        <div class="card">
            <div class="mb-4 flex flex-wrap -mx-2">
                <div class="px-2">
                    <x-label for="order_id" class="mb-2">
                        ID
                    </x-label>
                    <x-input id="order_id" class="w-full" value="{{ $order->id }}" disabled />
                </div>

                <div class="px-2">
                    <x-label for="order_number" class="mb-2">
                        Número de la Orden
                    </x-label>
                    <x-input id="order_number" class="w-full" value="00000000000000" disabled />
                </div>

                <div class="px-2">
                    <x-label for="order_datetime" class="mb-2">
                        Fecha y Hora
                    </x-label>
                    <x-input id="order_datetime" class="w-full" value="{{ $order->datetime }}" disabled />
                </div>

            </div>

            <div class="mb-4">
                <x-label class="mb-2">
                    Nombre del Cliente
                </x-label>

                <x-input id="order_client" class="w-full" value="{{ $order->user->name }}" disabled />
            </div>

            <div class="mb-4 flex flex-wrap -mx-2">
                <div class="px-2">
                    <x-label for="order_id" class="mb-2">
                        Total
                    </x-label>
                    <x-input id="order_id" class="w-full" value="{{ $order->total }}" disabled />
                </div>

                <div class="px-2">
                    <x-label for="order_number" class="mb-2">
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
                <x-button class="">
                    Actualizar Estado
                </x-button>

            </div>
        </div>

    </form>


    <div class="card">
        <div class="mb-4 flex flex-wrap -mx-2">
            <div class="px-2">
                <x-label for="order_id" class="mb-2">
                    Método de Envío
                </x-label>
                <x-input id="order_id" class="w-full" value="{{ $order->shipping->id }}" disabled />
            </div>

            <div class="px-2">
                <x-label for="order_number" class="mb-2">
                    Número de la Orden
                </x-label>
                <x-input id="order_number" class="w-full" value="00000000000000" disabled />
            </div>

            <div class="px-2">
                <x-label for="order_datetime" class="mb-2">
                    Fecha y Hora
                </x-label>
                <x-input id="order_datetime" class="w-full" value="{{ $order->datetime }}" disabled />
            </div>

        </div>

        <div class="mb-4">
            <x-label class="mb-2">
                Nombre del Cliente
            </x-label>

            <x-input id="order_client" class="w-full" value="{{ $order->user->name }}" disabled />
        </div>

    </div>

</div>
