<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'brand' => $this->brand,
            'price' => $this->price,
            'has_discount' => $this->has_discount,
            'percentage_discount' => $this->percentage_discount,
            'image_path' => Storage::url($this->image_path),
            'link' => url('api/products/' . $this->id),
            'colors' => ColorResource::collection($this->colors),
        ];
    }
}

