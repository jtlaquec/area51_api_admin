<?php

namespace App\Http\Controllers\Api;

use App\Models\Family;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\FamilyResource;
use App\Http\Resources\Api\SubcategoryResource;

class StoreController extends Controller
{
/*     public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'productosPorSubcategoria']);
    } */

    public function index(Request $request)
    {
        try {
            $families = Family::with('categories.subcategories')->get();
            return FamilyResource::collection($families);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener datos de familias. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function productosPorSubcategoria(Request $request, $subcategoriaId)
    {
        try {
            $subcategoria = Subcategory::with('products')->findOrFail($subcategoriaId);
            return SubcategoryResource::make($subcategoria);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener datos de subcategoría. Detalles: ' . $e->getMessage()], 500);
        }
    }

}
