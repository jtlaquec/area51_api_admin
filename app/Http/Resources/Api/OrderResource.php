<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use App\Http\Resources\Api\OrderDetailsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'order_id' => $this->id,
            'user_id' => $this->user_id,
            'datetime' => $this->datetime,
            'total' => $this->total,
            'state_id' => $this->state_id,
            'reason' => $this->reason,
            'shipping_address' => $this->shipping_address,
            'state' => new StateResource($this->state),
            /* 'payment_detail' => new PaymentDetailResource($this->payment_detail), */
            'payment_detail' => PaymentDetailResource::collection($this->whenLoaded('payment_detail')),
            'order_details' => OrderDetailsResource::collection($this->whenLoaded('order_details')),
        ];
    }
}
