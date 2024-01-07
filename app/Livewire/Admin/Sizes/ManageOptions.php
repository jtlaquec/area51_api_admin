<?php

namespace App\Livewire\Admin\Sizes;

use App\Models\Size;
use Livewire\Component;

class ManageOptions extends Component
{
    public $sizes;
    public $sizeValue;
    public $description;

    public function mount()
    {
        $this->sizes = Size::all();
    }

    public function saveSize()
    {
        $this->validate([
            'sizeValue' => 'required',
            'description' => 'required',
        ]);

        $size = new Size;
        $size->value = $this->sizeValue;
        $size->description = $this->description;
        $size->save();

        $this->sizes = Size::all();

        $this->sizeValue = '';
        $this->description = '';


        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Talla agregada correctamente.',
        ]);
    }


    public function deleteSize($id)
    {
        $size = Size::find($id);

        if (!$size) {
            $this->dispatch('swal', [
                'icon' => 'warning',
                'title' => '¡Error!',
                'text' => 'Talla no encontrada.',
            ]);
        }

        try {
            $size->delete();
            $this->sizes = Size::all();
            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => '¡Bien hecho!',
                'text' => 'Talla eliminada correctamente.',
            ]);
        } catch (\Exception $e) {

            $this->dispatch('swal', [
                'icon' => 'error',
                'title' => '¡Error!',
                'text' => 'Existen productos asociados a esta talla.',
            ]);
        }
    }
    public function render()
    {
        return view('livewire.admin.sizes.manage-options');
    }
}
