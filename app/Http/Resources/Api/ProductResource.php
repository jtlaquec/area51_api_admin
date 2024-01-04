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
            'image_path' => Storage::url($this->image_path),
            'link' => url('api/products/' . $this->id),
            'colors' => $this->whenLoaded('colors') ? $this->colors->map(function($color) {
                return [
                    'value' => $color->value,
                    'description' => $color->description
                ];
            }) : [],
        ];
    }
}

