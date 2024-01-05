<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'payment_id' => $this->payment_id,
            'order_id' => $this->order_id,
            'pay' => $this->pay,
            'image_path' => Storage::url($this->image_path),
            'date' => $this->date,
            'link' => url('api/payments/' . $this->id),
            'payment_state' => new PaymentStateResource($this->payment_state),
        ];
    }
}
