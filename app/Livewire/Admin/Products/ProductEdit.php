<?php

namespace App\Livewire\Admin\Products;

use App\Models\Family;
use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\WithFileUploads;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Storage;

class ProductEdit extends Component
{
    use WithFileUploads;
    public $product;
    public $productEdit;

    public $families;
    public $family_id = '';
    public $category_id = '';

    public $image;

    public function mount ($product)
    {
        $this->productEdit = $product->only('sku', 'name', 'brand', 'description', 'image_path', 'price', 'subcategory_id',
        'percentage_discount', 'has_discount');

        $this->families = Family::all();

        $this->category_id = $product->subcategory->category->id;

        $this->family_id = $product->subcategory->category->family_id;
    }

    public function boot()
    {
        $this->withValidator(
            function ($validator) {
                if ($validator->fails()) {
                    $this->dispatch('swal', [
                        'icon' => 'error',
                        'tittle' => '¡Error!',
                        'text' => 'El formulario contiene errores',
                    ]);
                }
            }
        );
    }

    public function updatedFamilyId($value)
    {
        $this->category_id = '';
        $this->productEdit['subcategory_id'] = '';
    }

    public function updatedCategoryId($value)
    {
        $this->productEdit['subcategory_id'] = '';
    }

    #[Computed()]
    public function categories()
    {
        return Category::where('family_id', $this->family_id)->get();
    }

    #[Computed()]
    public function subcategories()
    {
        return Subcategory::where('category_id', $this->category_id)->get();
    }


    public function storeProduct()
    {
        $this->validate([
            'image' => 'nullable|image|max:1024',
            'productEdit.sku' => 'required|unique:products,sku,' . $this->product->id,
            'productEdit.name' => 'required|max:255',
            'productEdit.brand' => 'required|max:255',
            'productEdit.description' => 'nullable',
            'productEdit.has_discount' => 'required|boolean',
            'productEdit.percentage_discount' => 'required',
            'productEdit.subcategory_id' => 'required|exists:subcategories,id',
        ],
        [

        ],
        [
/*             'image' => 'imagen',
            'productEdit.sku' => 'código de producto (SKU)',
            'productEdit.name' => 'nombre',
            'productEdit.description' => 'descripción',
            'productEdit.price' => 'precio',
            'productEdit.subcategory_id' => 'subcategoría', */
        ]);

        if ($this->image) {
            Storage::delete($this->productEdit['image_path']);
            $this->productEdit['image_path'] = $this->image->store('products');
        }

        $this->product->update($this->productEdit);



        if ($this->productEdit['has_discount'] == 1) {
            foreach ($this->product->productvariants as $variant) {
                $variant->update([
                    'discount_price' => $variant->price - ($variant->price * $this->product->percentage_discount) / 100,
                    'name' => $this->product->name ." ". $variant->color->description. " ".$variant->size->value,
                ]);
            }
        } else {
            foreach ($this->product->productvariants as $variant) {
                $variant->update([
                    'discount_price' => $variant->price,
                    'name' => $this->product->name ." ". $variant->color->description. " ".$variant->size->value,
                ]);
                $this->product->update([
                    'percentage_discount' => 0,
                ]);
            }
        }

        $firstVariant = $this->product->productvariants->first();
        if ($firstVariant) {
            $this->product->update([
                'price' => $firstVariant->discount_price,
            ]);

        }
        else {
            $this->product->update([
                'price' => 0,
            ]);

        }

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El Producto se actualizó correctamente.',
        ]);

        return redirect()->route('admin.products.edit', $this->product);
    }



    public function render()
    {
        return view('livewire.admin.products.product-edit');
    }
}
