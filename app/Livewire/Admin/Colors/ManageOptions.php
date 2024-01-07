<?php

namespace App\Livewire\Admin\Colors;

use App\Models\Color;
use Livewire\Component;

class ManageOptions extends Component
{

    public $colors;
    public $colorValue;
    public $description;

    public function mount()
    {
        $this->colors = Color::all();
    }

    public function save()
    {
        $this->validate([
            'colorValue' => 'required',
            'description' => 'required',
        ]);

        $color = new Color;
        $color->value = $this->colorValue;
        $color->description = $this->description;
        $color->save();

        $this->colors = Color::all();

        $this->colorValue = '';
        $this->description = '';


        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Color agregado correctamente.',
        ]);
    }


    public function deleteColor($id)
    {
        $color = Color::find($id);

        if (!$color) {
            $this->dispatch('swal', [
                'icon' => 'warning',
                'title' => '¡Error!',
                'text' => 'Color no encontrado.',
            ]);
        }

        try {
            $color->delete();
            $this->colors = Color::all();
            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => '¡Bien hecho!',
                'text' => 'Color eliminado correctamente.',
            ]);
        } catch (\Exception $e) {

            $this->dispatch('swal', [
                'icon' => 'error',
                'title' => '¡Error!',
                'text' => 'Existen productos asociados a este color.',
            ]);
        }
    }


    public function render()
    {
        return view('livewire.admin.colors.manage-options');
    }
}
