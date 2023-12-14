<?php

// FamilyResource.php
namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use App\Http\Resources\Api\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FamilyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'categories' => CategoryResource::collection($this->categories),
        ];
    }
}
