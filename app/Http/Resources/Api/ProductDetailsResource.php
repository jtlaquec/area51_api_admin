<?php

namespace App\Http\Resources\Api;

use App\Models\Size;
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
        $allSizes = Size::all();
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
            'comments' => CommentResource::collection($this->comments),
            /* 'colors' => Color2Resource::collection($this->colors), */

            'colors' => $this->colors->map(function ($color) use ($allSizes) {
                return new Color2Resource($color, $this->id, $allSizes);
            }),

            /* 'variants' => ProductVariantResource::collection($this->productvariants), */
        ];
    }
}
