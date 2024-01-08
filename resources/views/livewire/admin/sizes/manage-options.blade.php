<div>
    <section class="rounded-lg bg-white shadow-lg">



        <div class="space-y-6">

            <div class="p-6 rounded-lg border border-gray-200 relative" wire:key="">

                <div class="absolute -top-3 px-4 bg-white">

                    <span>
                        Tallas
                    </span>
                </div>
                <div class="flex flex-wrap mb-4">
                    @foreach ($sizes as $size)
                        <div class="relative">

                            <span
                                class="bg-gray-100 text-gray-800 text-xs font-medium me-2 pl-2.5 pr-1.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-500">
                                {{ $size->description }}

                                <button wire:click="deleteSize({{ $size->id }})"
                                    class="absolute z-10 right-1 -top-1 rounded-full bg-red-500 hover:bg-red-600 h-4 w-4 flex justify-center items-center">
                                    <i class="fa-solid fa-xmark text-white text-xs"></i>
                                </button>

                            </span>



                        </div>
                    @endforeach
                </div>

                <form wire:submit.prevent="saveSize">

                    <x-validation-errors class="mb-4">

                    </x-validation-errors>
                    <div class="flex flex-wrap mb-4 gap-4">
                        <div class="flex-none">
                            <x-label class="mb-2">Valor</x-label>
                            <x-input type="text" wire:model.defer="sizeValue" class=""
                                placeholder="Valor de la talla"></x-input>
                        </div>
                        <div class="flex-grow">
                            <x-label class="mb-2">Nombre de la Talla</x-label>
                            <x-input wire:model.defer="description" class="w-2/5"
                                placeholder="Ingrese el nombre de la talla"></x-input>
                        </div>

                    </div>

                    <div class="mb-2">
                        <x-button class="justify-center">Agregar Talla</x-button>
                    </div>
                </form>
            </div>
        </div>




    </section>

</div>
