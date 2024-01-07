<?php

namespace App\Livewire\Admin\Variants;

use App\Models\Size;
use App\Models\Color;
use Livewire\Component;
use App\Models\ProductVariant;

class VariantEdit extends Component
{

    public $product;

    public $colors;

    public $sizes;

    public $discount_price = [];

    public $variant = [];

    public $variants = [];

    public $currentVariant;

    public $showAddVariantModal = false;
    public $showMovementsModal = false;
    public $currentVariantId = null;

    public function mount($product)
    {

        $this->colors = Color::all();
        $this->sizes = Size::all();

        $this->product = $product;
        foreach ($product->productvariants as $index => $var) {
            $this->variants[$index] = [
                'name' => $var->name,
                'color_id' => $var->color_id,
                'size_id' => $var->size_id,
                'sku' => $var->sku,
                'price' => $var->price,
                'stock' => $var->stock,
                'discount_price' => $var->discount_price,
            ];
        }

        foreach ($this->variants as $index => $variant) {
            $this->discount_price[$index] = $variant['discount_price'];
        }
    }


    public function saveVariant($index)
    {
        $variant = $this->product->productvariants->get($index) ?? null;
        if ($variant) {
            $validatedData = $this->validate([
                "variants.$index.color_id" => 'required|exists:colors,id',
                "variants.$index.size_id" => 'required|exists:sizes,id',
                "variants.$index.sku" => 'required|unique:product_variants,sku,' . $variant->id,
                "variants.$index.price" => 'required|numeric',
                "variants.$index.stock" => 'required|numeric',
                "variants.$index.discount_price" => 'nullable|numeric'
            ])['variants'][$index];

            $existingVariant = $this->product->productvariants()
                ->where('color_id', $validatedData['color_id'])
                ->where('size_id', $validatedData['size_id'])
                ->where('id', '!=', $variant->id)
                ->first();

            if ($existingVariant) {
                $this->dispatch('swal', [
                    'icon' => 'error',
                    'title' => '¡Error!',
                    'text' => 'Ya existe una variante con la misma combinación de color y talla.',
                ]);
                return;
            }

            $colorName = Color::find($validatedData['color_id'])->description ?? '';
            $sizeValue = Size::find($validatedData['size_id'])->value ?? '';

            $validatedData['name'] = "{$this->product->name} $colorName $sizeValue";

            if ($this->product->has_discount == true) {
                $validatedData['discount_price'] = $validatedData['price'] - ($validatedData['price'] * $this->product->percentage_discount) / 100;
            } else {
                $validatedData['discount_price'] = $validatedData['price'];
            }

            $variant->update($validatedData);

            $this->discount_price[$index] = $variant->discount_price;

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => '¡Bien hecho!',
                'text' => 'Variante actualizada correctamente.',
            ]);
        }
    }


    public function openAddVariantModal()
    {
        $this->resetInputFields();
        $this->showAddVariantModal = true;
    }

    public function closeAddVariantModal()
    {
        $this->showAddVariantModal = false;
    }

    public function openMovementsModal($variantId)
    {
        $this->currentVariant = ProductVariant::with('order_details')->find($variantId); // Asegúrate de que 'order_details' es una relación definida
        $this->showMovementsModal = true;
    }

    public function closeMovementsModal()
    {
        $this->showMovementsModal = false;
        $this->currentVariantId = null;
    }

    public function resetInputFields()
    {
        $this->variant = [];
    }


    public function render()
    {
        return view('livewire.admin.variants.variant-edit');
    }
}
