<?php

namespace App\Http\Resources\Api;
use Illuminate\Http\Request;
use App\Http\Resources\Api\SubcategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'subcategories' => SubcategoryResource::collection($this->subcategories),
        ];
    }
}
