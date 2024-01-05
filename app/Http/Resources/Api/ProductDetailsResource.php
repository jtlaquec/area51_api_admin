<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
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
            'link' => url('api/products/' . $this->id),
            // Asume que quieres mostrar variantes del producto
            'variants' => ProductVariantResource::collection($this->productvariants),
            // ... puedes agregar más campos según necesites
        ];
    }
}
