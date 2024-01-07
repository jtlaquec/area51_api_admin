<?php

namespace App\Livewire\Admin\Department;

use Livewire\Component;
use App\Models\District;
use App\Models\Province;
use Livewire\Attributes\Computed;

class DepartmentEdit extends Component
{
    public $departmentName;
    public $departmentId;
    public $provinces;
    public $provinceId;
    public $districtId;
    public $shippingCost;

    public function mount($department)
    {
        $this->departmentName = $department->name;
        $this->departmentId = $department->id;
        $this->provinces = Province::where('department_id', $this->departmentId)->get();
        $this->provinceId = '';
        $this->districtId = '';
        $this->shippingCost = '';
    }

    public function updatedProvinceId($value)
    {
        $this->districtId = '';
    }

    public function updatedDistrictId($value)
    {
        $district = District::find($value);
        if ($district) {
            $this->shippingCost = $district->shipping_cost;
        } else {
            $this->shippingCost = '';
        }
    }

    public function save()
    {
        $this->validate([
            'districtId' => 'required|exists:districts,id',
            'shippingCost' => 'required|numeric'
        ]);

        $district = District::find($this->districtId);
        if($district) {
            $district->shipping_cost = $this->shippingCost;
            $district->save();
            $this->dispatch('swal',[
                'icon' => 'success',
                'title' => '¡Bien hecho!',
                'text' => 'Costo de envío actualizado correctamente.',
            ]);
        } else {
            $this->dispatch('swal',[
                'icon' => 'error',
                'title' => '¡Error!',
                'text' => 'Distrito no encontrado.',
            ]);
        }
    }

    #[Computed()]
    public function getDistrictsProperty()
    {
        return $this->provinceId ? District::where('province_id', $this->provinceId)->get() : collect();

    }

    public function render()
    {
        return view('livewire.admin.department.department-edit');
    }
}
