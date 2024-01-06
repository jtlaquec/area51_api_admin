<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShippingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'shipping_id' => $this->id,
            'order_id' => $this->order_id,
            'district_id' => $this->district_id,
            'cost' => $this->cost,
            'shipping_datetime' => $this->shipping_datetime,
            'estimated_delivery_date' => $this->estimated_delivery_date,
            'shipping_number' => $this->shipping_number,
            'shipping_code' => $this->shipping_code,
            'notes' => $this->notes,
            'shipping_method' => new ShippingMethodResource($this->shipping_method),
        ];
    }
}
