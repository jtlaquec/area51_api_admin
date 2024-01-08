<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Department;
use Livewire\WithPagination;

class DepartmentsIndex extends Component
{


    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $departments = Department::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('name', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.admin.departments-index', [
            'departments' => $departments
        ]);
    }

}
