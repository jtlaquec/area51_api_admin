<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductVariant $productVariant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductVariant $productVariant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductVariant $productVariant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $productVariant = ProductVariant::findOrFail($id);
            $productId = $productVariant->product_id; // Captura el product_id antes de eliminar
            $productVariant->delete();

            session()->flash('swal', [
                'icon' => 'success',
                'title' => '¡Bien hecho!',
                'text' => 'Variante eliminada correctamente.',
            ]);
            return redirect()->route('admin.products.edit', $productId);
        } catch (\Exception $e) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'Hay ordenes asociadas a esta variante',
            ]);
            return redirect()->route('admin.products.edit', $productId);
        }
    }

}
