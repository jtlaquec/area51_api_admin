<div>
    <form wire:submit.prevent="save">


        <div class="card">

            <x-validation-errors class="mb-4">

            </x-validation-errors>

            <div class ="mb-4">
                <x-label class="mb-2" for="departmentName">
                    Departamento
                </x-label>
                <x-input wire:model="departmentName" id="departmentName" class="w-full bg-gray-100" disabled>

                </x-input>
            </div>


            <div class="mb-4">
                <x-label for="province_id" class="mb-2">

                    Provincia

                </x-label>

                <x-select class="w-full" wire:model.live="provinceId" id="province_id" name="province_id">

                    <option value="" disabled>
                        Seleccione una provincia
                    </option>

                    @foreach ($provinces as $province)
                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                    @endforeach

                </x-select>

            </div>

            <div class="mb-4">
                <x-label class="mb-2" for="district_id">

                    Distrito

                </x-label>

                <x-select class="w-full" wire:model.live="districtId" id="district_id">

                    <option value="" disabled>
                        Seleccione un distrito
                    </option>

                    @foreach ($this->districts as $district)
                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                    @endforeach
                </x-select>



            </div>

            <div class ="mb-4">
                <x-label class="mb-2" for="shipping_cost">
                    Costo de envío
                </x-label>
                <x-input wire:model.live="shippingCost" id="shipping_cost" class="w-full"
                placeholder="Ingrese el costo de envío">

                </x-input>
            </div>


            <div class ="flex justify-start">

                <x-button class="">
                    Actualizar Costo de Envío
                </x-button>
            </div>
        </div>

    </form>
</div>
