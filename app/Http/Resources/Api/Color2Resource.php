<?php

namespace App\Http\Resources\Api;

use App\Models\Size;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use Illuminate\Http\Resources\Json\JsonResource;

class Color2Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

     protected $productId;
     protected $sizes;

     public function __construct($resource, $productId, $sizes)
     {
         parent::__construct($resource);
         $this->productId = $productId;
         $this->sizes = $sizes;
     }
    public function toArray(Request $request): array
    {
        $sizesWithVariants = [];

        foreach ($this->sizes as $size) {
            $variant = ProductVariant::where('color_id', $this->id)
                                     ->where('size_id', $size->id)
                                     ->where('product_id', $this->productId)
                                     ->first();

            $sizesWithVariants[] = [
                'id' => $size->id,
                'value' => $size->value,
                'description' => $size->description,
                'variant' => $variant ? new VariantResource($variant) : [],
            ];
        }

        return [
            'id' => $this->id,
            'value' => $this->value,
            'description' => $this->description,
            'sizes' => $sizesWithVariants,
        ];
    }
}
