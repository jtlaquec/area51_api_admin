<div>

    <form wire:submit="storeProduct">

        <figure class="mb-4 relative">
            <div class="absolute top-8 right-8">
                <label class="flex items-center px-4 py-2 rounded-lg bg-white cursor-pointer text-gray-700">
                    <i class="fas fa-camera mr-2"></i>
                    Actualizar imagen
                    <input type="file" class="hidden" accept="image/*" wire:model="image">
                </label>
            </div>

            <div class="max-w-[16rem] mx-auto">
                <img class="object-cover object-center max-w-full h-auto"
                    src="{{ $image ? $image->temporaryUrl() : Storage::url($productEdit['image_path']) }}" alt="">
            </div>
        </figure>
        <x-validation-errors class="mb-4">

        </x-validation-errors>

        <div class="card">
            <div class="mb-4">
                <x-label class="mb-2">
                    Código
                </x-label>

                <x-input wire:model="productEdit.sku" class="w-full"
                    placeholder="Por favor ingrese el código del producto">
                </x-input>
            </div>

            <div class="mb-4">
                <x-label class="mb-2">
                    Nombre
                </x-label>

                <x-input wire:model="productEdit.name" class="w-full"
                    placeholder="Por favor ingrese el nombre del producto">
                </x-input>
            </div>

            <div class="mb-4">
                <x-label class="mb-2">
                    Marca
                </x-label>

                <x-input wire:model="productEdit.brand" class="w-full"
                    placeholder="Por favor ingrese el nombre del producto">
                </x-input>
            </div>

            <div class="mb-4">
                <x-label class="mb-2">
                    Descripción
                </x-label>

                <x-textarea wire:model="productEdit.description" class="w-full"
                    placeholder="Por favor ingrese la descripción del producto">
                </x-textarea>
            </div>

            <div class="mb-4">
                <x-label class="mb-2">
                    Familias
                </x-label>

                <x-select class="w-full" wire:model.live="family_id">

                    <option value="" disabled>
                        Seleccione una familia
                    </option>

                    @foreach ($families as $family)
                        <option value="{{ $family->id }}">
                            {{ $family->name }}
                        </option>
                    @endforeach

                </x-select>

            </div>

            <div class="mb-4">
                <x-label class="mb-2">
                    Categorías
                </x-label>

                <x-select class="w-full" wire:model.live="category_id">

                    <option value="" disabled>
                        Seleccione una categoría
                    </option>

                    @foreach ($this->categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach

                </x-select>

            </div>

            <div class="mb-4">
                <x-label class="mb-2">
                    Subcategorías
                </x-label>

                <x-select class="w-full" wire:model.live="productEdit.subcategory_id">

                    <option value="" disabled>
                        Seleccione una subcategoría
                    </option>

                    @foreach ($this->subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">
                            {{ $subcategory->name }}
                        </option>
                    @endforeach

                </x-select>

            </div>

            {{--             <div class="mb-4">
                <x-label class="mb-2">
                    Descripción
                </x-label>

                <x-textarea wire:model="productEdit.description" class="w-full"
                    placeholder="Por favor ingrese la descripción del producto">
                </x-textarea>
            </div> --}}

            <div class="mb-4 flex flex-wrap -mx-2">

                <div class="px-2">
                    <x-label for="has_discount" class="mb-2">
                        ¿Tiene descuento?
                    </x-label>
                    <x-select class="" wire:model="productEdit.has_discount">
                        <option value="1">Con descuento</option>
                        <option value="0">Sin descuento</option>
                    </x-select>
                </div>


                <div class="px-2">
                    <x-label for="" class="mb-2">Porcentaje de Descuento</x-label>
                    <x-input wire:model="productEdit.percentage_discount" id="productEdit.percentage_discount"
                        class="w-full" placeholder="Porcentaje de Descuento" />
                </div>

                <div class="px-2">
                    <x-label for="" class="mb-2">Precio Referencial</x-label>
                    <x-input wire:model="productEdit.price" id="productEdit.price" class="w-full bg-gray-100"
                        placeholder="Porcentaje de Descuento" disabled />
                </div>
            </div>

            <div class="flex justify-end">

                <x-danger-button onclick="confirmDelete()">
                    Eliminar
                </x-danger-button>

                <x-button class="ml-2">
                    Actualizar producto
                </x-button>

            </div>
        </div>

    </form>

    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" id="delete-form">
        @csrf
        @method('DELETE')
    </form>

    @push('js')
        <script>
            function confirmDelete() {
                Swal.fire({
                    title: "¿Estas seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Sí, borralo!",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form').submit();
                    }
                });

            }
        </script>
    @endpush

</div>
