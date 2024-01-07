<?php

namespace App\Http\Controllers\Api;

use App\Models\Size;
use App\Models\Color;
use App\Models\Family;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\SizeResource;
use App\Http\Resources\Api\ColorResource;
use App\Http\Resources\Api\FamilyResource;
use App\Http\Resources\Api\ProductResource;
use App\Http\Resources\Api\SubcategoryResource;
use App\Http\Resources\Api\ProductColorResource;
use App\Http\Resources\Api\Subcategory2Resource;

class StoreController extends Controller
{
    /*     public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'productosPorSubcategoria']);
    } */

    public function index(Request $request)
    {
        try {
            $families = Family::with('categories','categories.subcategories')->get();
            return FamilyResource::collection($families);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener datos de familias. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function productosPorSubcategoria(Request $request, $subcategoriaId)
    {
        try {
            $subcategoria = Subcategory::with('products.colors')->findOrFail($subcategoriaId);
            return SubcategoryResource::make($subcategoria);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener datos de subcategoría. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function productosPorSubcategoria2(Request $request, $subcategoriaId)
    {
        try {
            $subcategoria = Subcategory::with('products.colors')->findOrFail($subcategoriaId);
            return Subcategory2Resource::make($subcategoria);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener datos de subcategoría. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function listarTallas(Request $request)
    {
        try {
            $sizes = Size::get();
            return SizeResource::collection($sizes);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener datos de la talla. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function listarColores(Request $request)
    {
        try {
            $colors = Color::get();
            return ColorResource::collection($colors);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener datos del color. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function listarColoresPorProducto(Request $request, $idProduct)
    {
        try {
            $product = Product::with('colors')->find($idProduct);
            return new ProductColorResource($product);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener datos del color. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function search(Request $request)
    {
        try {
            $filters = $request->input('filters', []);
            $orderBy = $request->input('orderBy', 'id');
            $orderDirection = $request->input('orderDirection', 'asc');

            $query = Product::query();

            // Aplicamos los filtros
            foreach ($filters as $field => $value) {
                $query->where($field, 'like', '%' . $value . '%');
            }

            // Ordenamos el query
            $query->orderBy($orderBy, $orderDirection);

            $products = $query->get();

            return ProductResource::collection($products);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al buscar productos. Detalles: ' . $e->getMessage()], 500);
        }
    }
}
