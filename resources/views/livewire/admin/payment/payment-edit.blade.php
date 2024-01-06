<div>
    <x-label class="mb-2">
        DATOS DE PAGO
    </x-label>



    @if ($order->payment_detail->count())

        @foreach ($order->payment_detail as $index => $payment)
            <form wire:submit.prevent="save({{ $index }})">

                <x-validation-errors class="mb-4" />

                <div class="card">
                    <div class="mb-4 flex flex-wrap -mx-2">
                        <div class="px-2">
                            <x-label for="method-{{ $index }}" class="mb-2">Método de Pago</x-label>
                            <x-input id="method-{{ $index }}" class="w-full bg-gray-100"
                                value="{{ $payment->payment->payment_method->name }}" disabled />
                        </div>

                        <div class="px-2">
                            <x-label for="method-{{ $index }}" class="mb-2">Medio de Pago</x-label>
                            <x-input id="method-{{ $index }}" class="w-full bg-gray-100"
                                value="{{ $payment->payment->name }}" disabled />
                        </div>
                    </div>

                    <div class="mb-4 flex flex-wrap -mx-2">
                        <div class="px-2">
                            <x-label for="method-{{ $index }}" class="mb-2">Fecha de Pago</x-label>
                            <x-input id="method-{{ $index }}" class="w-full bg-gray-100"
                                value="{{ $payment->date }}" disabled />
                        </div>

                        <div class="px-2">
                            <x-label for="method-{{ $index }}" class="mb-2">Total</x-label>
                            <x-input id="method-{{ $index }}" class="w-full bg-gray-100"
                                value="{{ $payment->pay }}" disabled />
                        </div>

                        <div class="px-2">
                            <x-label for="method-{{ $index }}" class="mb-2">Boucher</x-label>
                            <x-input id="method-{{ $index }}" class="w-full bg-gray-100"
                                value="{{ $payment->image_path }}" disabled />
                        </div>
                    </div>

                    <div class="mb-4 flex flex-wrap -mx-2">
                        <div class="px-2" >
                            <x-label for="method-{{ $index }}" class="mb-2">Total</x-label>
                            <x-input id="method-{{ $index }}" class="w-full bg-gray-100"
                                value="{{ $payment->pay }}" disabled />
                        </div>


                        <div class="px-2">
                            <x-label for="state_id" class="mb-2">
                                Estado
                            </x-label>
                            <x-select class="" wire:model.live="state_id">

                                <option value="" disabled>
                                    Seleccione una estado de orden
                                </option>

                                @foreach ($payment_states as $payment_state)
                                    <option value="{{ $payment_state->id }}">
                                        {{ $payment_state->name }}
                                    </option>
                                @endforeach
                            </x-select>



                        </div>




                    </div>


                    <div class="mb-4 -mx-2">
                        <div class="px-2">
                            <x-label for="notes-{{ $index }}" class="mb-2">Observaciones</x-label>
                            <x-textarea wire:model.defer="payment.{{ $index }}.notes"
                                id="notes-{{ $index }}" class="w-full"
                                placeholder="Ingrese alguna observación sobre el pago" />
                        </div>
                    </div>




{{--                         <div class="mb-4 flex flex-wrap -mx-2">
                            <div class="px-2">
                                <x-label for="department-{{ $index }}">Departamento</x-label>
                                <x-input id="department-{{ $index }}" class="w-full bg-gray-100"
                                    value="{{ $payment->district->department->name }}" disabled />
                            </div>

                            <div class="px-2">
                                <x-label for="province-{{ $index }}">Provincia</x-label>
                                <x-input id="province-{{ $index }}" class="w-full bg-gray-100"
                                    value="{{ $payment->district->province->name }}" disabled />
                            </div>

                            <div class="px-2">
                                <x-label for="district-{{ $index }}">Distrito</x-label>
                                <x-input id="district-{{ $index }}" class="w-full bg-gray-100"
                                    value="{{ $payment->district->name }}" disabled />
                            </div>
                        </div> --}}

{{--                         <div class="mb-4 flex flex-wrap -mx-2">
                            <div class="px-2">
                                <x-label for="shipping_number-{{ $index }}">Número de Orden</x-label>
                                <x-input wire:model.defer="shippings.{{ $index }}.shipping_number"
                                    id="shipping_number-{{ $index }}" class="w-full"
                                    placeholder="Número de Orden" />
                            </div>

                            <div class="px-2">
                                <x-label for="shipping_code-{{ $index }}">Código de Orden</x-label>
                                <x-input wire:model.defer="shippings.{{ $index }}.shipping_code"
                                    id="shipping_code-{{ $index }}" class="w-full"
                                    placeholder="Código de Orden" />
                            </div>

                            <div class="px-2">
                                <x-label for="estimated_delivery_date-{{ $index }}">Fecha estimada de
                                    envío</x-label>
                                <x-input wire:model.defer="shippings.{{ $index }}.estimated_delivery_date"
                                    id="estimated_delivery_date-{{ $index }}" class="w-full"
                                    placeholder="Fecha Estimada" />
                            </div>
                        </div> --}}



                        <div class="flex justify-start">
                            <x-button type="button" onclick="confirmShippingEdit({{ $index }})" class="btn btn-warning">Editar Envío</x-button>
                        </div>






                </div>

            </form>
        @endforeach
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
                <span class="font-medium"></span> No hay pagos realizados para esta Orden
            </div>
        </div>
    @endif



    @push('js')
    <script>
        function confirmShippingEdit(index) {
            Swal.fire({
                title: "¿Estás seguro de editar el envío?",
                text: "¡No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "¡Sí, editar!",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('save', index);
                }
            });
        }
    </script>
    @endpush



</div>
