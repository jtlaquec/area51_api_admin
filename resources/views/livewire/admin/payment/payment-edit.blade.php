<div>
    <x-label class="mb-2">
        <div class="text-xl font-bold">DATOS DE PAGO</div>
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
                            <x-label for="date-{{ $index }}" class="mb-2">Fecha de Pago</x-label>
                            <x-input id="method-{{ $index }}" class="w-full bg-gray-100"
                                value="{{ $payment->date }}" disabled />
                        </div>

                        <div class="px-2">
                            <x-label for="pay-{{ $index }}" class="mb-2">Total</x-label>
                            <x-input id="method-{{ $index }}" class="w-full bg-gray-100"
                                value="{{ $payment->pay }}" disabled />
                        </div>

                        <div class="px-2">
                            <x-label for="image-{{ $index }}" class="mb-2">Boucher</x-label>
                            <button type="button" wire:click="openModalWithItem({{ $index }})" class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Ver Boucher</button>
{{--                             <x-button wire:click="openModalWithItem({{ $index }})" type="button" class="bg-gray-100 hover:bg-red-700 text-white">
                                Ver Boucher
                            </x-button> --}}
                        </div>

                    </div>

                    <div class="mb-4 flex flex-wrap -mx-2">

                        <div class="px-2">
                            <x-label for="state_id-{{ $index }}" class="mb-2">Estado</x-label>
                            <x-select wire:model.defer="payments.{{ $index }}.payment_state_id"
                                id="state_id-{{ $index }}">
                                <option value="" disabled>Seleccione una estado de orden</option>
                                @foreach ($payment_states as $payment_state)
                                    <option value="{{ $payment_state->id }}">{{ $payment_state->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>

                    <div class="mb-4 -mx-2">
                        <div class="px-2">
                            <x-label for="notes-{{ $index }}" class="mb-2">Observaciones</x-label>
                            <x-textarea wire:model.defer="payments.{{ $index }}.notes"
                                id="notes-{{ $index }}" class="w-full"
                                placeholder="Ingrese alguna observación sobre el pago" />
                        </div>

                    </div>

                    <div class="flex justify-start">
                        <x-button type="button" onclick="confirmPaymentEdit({{ $index }})"
                            class="btn btn-warning">Editar Pago</x-button>
                    </div>
                </div>

            </form>
        @endforeach
        @if ($openModal)
        <x-dialog-modal wire:model="openModal">
            <x-slot name="title">
                Boucher del Pago
            </x-slot>

            <x-slot name="content">
                <img src="{{ asset($selectedImagePath) }}" alt="Imagen de Boucher" style="width: 100%; height: auto;"/>
            </x-slot>

            <x-slot name="footer">
                <x-button wire:click="$set('openModal', false)">
                    Cerrar
                </x-button>
            </x-slot>
        </x-dialog-modal>
        @endif

    @else
    <div class="flex items-center p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div>
          <span class="font-medium"></span> No hay pagos realizados para esta Orden.
        </div>
      </div>
    @endif



    @push('js')
        <script>
            function confirmPaymentEdit(index) {
                Swal.fire({
                    title: "¿Estás seguro de editar el pago?",
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
