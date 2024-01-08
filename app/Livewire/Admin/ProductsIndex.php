<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsIndex extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::where('name', 'like', '%' . $this->search . '%')
                           ->orWhere('sku', 'like', '%' . $this->search . '%')
                           ->orWhere('brand', 'like', '%' . $this->search . '%')
                           ->orWhere('price', 'like', '%' . $this->search . '%')
                           ->paginate(10);

        return view('livewire.admin.products-index', [
            'products' => $products
        ]);
    }
}
