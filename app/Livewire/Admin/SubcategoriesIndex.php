<?php

namespace App\Livewire\Admin;

use App\Models\Subcategory;
use Livewire\Component;
use Livewire\WithPagination;

class SubcategoriesIndex extends Component
{

    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $subcategories = Subcategory::where('name', 'like', '%' . $this->search . '%')
            ->orWhereHas('category', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);

        return view('livewire.admin.subcategories-index', [
            'subcategories' => $subcategories
        ]);
    }
}
