<div>

    <section class="rounded-lg bg-white shadow-lg">






            <div class="space-y-6">

                <div class="p-6 rounded-lg border border-gray-200 relative" wire:key="">

                    <div class="absolute -top-3 px-4 bg-white">

                        <span>
                            Colores
                        </span>
                    </div>
                    <div class="flex flex-wrap mb-4">
                        @foreach ($colors as $color)
                            <div class="relative">
                                <span class="inline-block h-6 w-6 shadow-lg rounded-full border-2 border-gray-300 mr-4"
                                    style="background-color:{{ $color->value }}">

                                </span>

 {{--                                <button
                                    class="absolute z-10 left-3 -top-2 rounded-full bg-red-500 hover:bg-red-600 h-4 w-4 flex justify-center items-center"
                                    onclick="confirmColorDelete({{ $color->id }})">
                                    <i class="fa-solid fa-xmark text-white text-xs">

                                    </i>

                                </button> --}}


                                <button wire:click="deleteColor({{ $color->id }})" class="absolute z-10 left-3 -top-2 rounded-full bg-red-500 hover:bg-red-600 h-4 w-4 flex justify-center items-center">
                                    <i class="fa-solid fa-xmark text-white text-xs"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <form wire:submit.prevent="save">

                        <x-validation-errors class="mb-4">

                        </x-validation-errors>
                        <div class="flex flex-wrap mb-4 gap-4">
                            <div class="flex-none">
                                <x-label class="mb-2">Valor</x-label>
                                <div class="border border-gray-300 rounded-md h-[42px] w-40 flex">
                                    <input type="text" wire:model.defer="colorValue" class="w-full h-full border-0 pl-2" readonly>
                                    <input type="color" wire:model.defer="colorValue" class="w-16 h-full border-0 cursor-pointer rounded-l-md">
                                </div>
                            </div>
                            <div class="flex-grow">
                                <x-label class="mb-2">Nombre del Color</x-label>
                                <x-input wire:model.defer="description" class="w-2/5" placeholder="Ingrese el nombre del color"></x-input>
                            </div>

                        </div>

                        <div class="mb-2">
                            <x-button class="justify-center">Agregar</x-button>
                        </div>
                    </form>
                </div>
            </div>




    </section>

</div>
