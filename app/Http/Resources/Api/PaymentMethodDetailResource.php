<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentMethodDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'payment_id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image_logo' => Storage::url($this->image_logo),
            'image_qr' => Storage::url($this->image_qr),

        ];
    }
}

