<?php

namespace App\Livewire\Admin\Subcategories;

use App\Models\Family;
use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Attributes\Computed;

class SubcategoryCreate extends Component
{

    public $families;

    public $subcategory = [
        'family_id' => '',
        'category_id' => '',
        'name' => '',
    ];

    public function mount()
    {
        $this->families = Family::all();
    }

    //Para cambiar la categoría despues de cambiar familia
    //Sintaxis con mayúscula

    public function updatedSubcategoryFamilyId($value)
    {
        $this->subcategory['category_id'] = '';
    }

    #[Computed()]
    public function categories()
    {
        return Category::where('family_id', $this->subcategory['family_id'])->get();

    }

    public function save()
    {
        /* dd($this->subcategory); */


        $this->validate([
            'subcategory.family_id' => 'required|exists:families,id',
            'subcategory.category_id' => 'required|exists:categories,id',
            'subcategory.name' => 'required',
        ],
        [
            //Mensajes
        ],
        [
            'subcategory.family_id' => 'familia',
            'subcategory.category_id' => 'categoría',
            'subcategory.name' => 'nombre',
        ]);

        Subcategory::create($this->subcategory);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Subcategoría creada correctamente.',
        ]);

        return redirect()->route('admin.subcategories.index');

    }

    public function render()
    {
        return view('livewire.admin.subcategories.subcategory-create');
    }
}
