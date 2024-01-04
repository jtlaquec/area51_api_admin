<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            //Campos de la variante de producto
            'id' => $this->id,
            'name' => $this->name,
            'stock' => $this->stock,
            'price' => $this->price,
            'has_discount' => $this->has_discount,
            'percentage_discount' => $this->percentage_discount,
            'discount_price' => $this->discount_price,
            'link' => url('api/variants/' . $this->id),
            'images' => ImageResource::collection($this->images),

        ];
    }
}
