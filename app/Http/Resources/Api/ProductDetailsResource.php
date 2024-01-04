<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $variantsGroupedByColor = $this->productvariants
            ->groupBy('color_id')
            ->map(function ($variantsByColor) {
                $color = $variantsByColor->first()->color;
                $sizes = $variantsByColor
                    ->groupBy('size_id')
                    ->map(function ($variantsBySize) {
                        $size = $variantsBySize->first()->size;
                        $variants = $variantsBySize->map(function ($variant) {
                            return [
                                //Campos de la variante de producto
                                'id' => $variant->id,
                                'name' => $variant->name,
                                'stock' => $variant->stock,
                                'price' => $variant->price,
/*                                 'has_discount' => $variant->has_discount,
                                'percentage_discount' => $variant->percentage_discount, */
                                'discount_price' => $variant->discount_price,
                                'link' => url('api/variants/' . $this->id),
                                'images' => ImageResource::collection($variant->images),

                            ];
                        })->values();

                        return [
                            'id' => $size->id,
                            'value' => $size->value,
                            'description' => $size->description,
                            'variants' => $variants, // Lista de variantes para talla
                        ];
                    })->values();

                return [
                    'id' => $color->id,
                    'value' => $color->value,
                    'description' => $color->description,
                    'sizes' => $sizes, // Tallas dentro de color
                ];
            })->values();

        return [
            'id' => $this->id,
            'sku' => $this->sku,
            'name' => $this->name,
            'brand' => $this->brand,
            'description' => $this->description,
            'price' => $this->price,
            'has_discount' => $this->has_discount,
            'percentage_discount' => $this->percentage_discount,
            'image_path' => Storage::url($this->image_path),
            'product_details' => $this->product_details,
            'colors' => $variantsGroupedByColor,
        ];
    }
}

