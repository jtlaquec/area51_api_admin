<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProductVariantResource;

class ProductVariantController extends Controller
{
    public function show(ProductVariant $variant)
    {
        try {
            $variant = ProductVariant::with(['color', 'size' ,'images'])
                                    ->findOrFail($variant->id);

            return new ProductVariantResource($variant);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener datos de la variante del producto. Detalles: ' . $e->getMessage()], 500);
        }
    }
}
