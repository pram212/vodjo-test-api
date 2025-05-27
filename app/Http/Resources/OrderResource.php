<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\OrderProductResource;

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
            'id' => $this->id,
            'order_no' => $this->order_no,
            'customer_name' => $this->customer_name,
            'order_date' => $this->order_date,
            'grand_total' => $this->grand_total,
            'items' => OrderProductResource::collection($this->whenLoaded('orderProducts')),
        ];
    }
}
