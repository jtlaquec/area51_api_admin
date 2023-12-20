<?php

namespace App\Livewire\Admin\Products;

use App\Models\Family;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\WithFileUploads;
use Livewire\Attributes\Computed;

class ProductCreate extends Component
{
    use WithFileUploads;

    public $families;
    public $family_id = '';
    public $category_id = '';
    public $image;
    public $product = [
        'sku' => '',
        'name' => '',
        'description' => '',
        'image_path' => '',
        'price' => '',
        'subcategory_id' => '',
    ];

    public function mount()
    {
        $this->families = Family::all();
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
        $this->product['subcategory_id'] = '';
    }

    public function updatedCategoryId($value)
    {
        $this->product['subcategory_id'] = '';
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

    public function store()
    {
        $this->validate([
            'image' => 'nullable|image|max:1024',
            'product.sku' => 'required|unique:products,sku',
            'product.name' => 'required|max:255',
            'product.description' => 'nullable',
            'product.price' => 'required|numeric|min:0',
            'product.subcategory_id' => 'required|exists:subcategories,id',
        ],
        [
            //Mensajes
        ],
        [
            'image' => 'imagen',
            'product.sku' => 'código de producto (SKU)',
            'product.name' => 'nombre',
            'product.description' => 'descripción',
            'product.price' => 'precio',
            'product.subcategory_id' => 'subcategoría',
        ]);

        $this->product['image_path'] = $this->image->store('products');

        $product = Product::create($this->product);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Producto creado correctamente.',
        ]);

        return redirect()->route('admin.products.edit', $product);
    }


    public function render()
    {
        return view('livewire.admin.products.product-create');
    }
}
