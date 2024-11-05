<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id'            => $this->uuid,
            'type'          => 'cart',
            'attributes'    => [
                'id'     => $this->uuid,
                'status' => $this->status,
                'coupon' => [
                    'code'      => $this->coupon,
                    'reduction' => $this->reduction,
                ],
                'total'  => $this->total,
            ],
            'relationships' => [
                'items' => CartItemResource::collection(
                    $this->whenLoaded(
                        'items'
                    )
                ),
            ],
        ];
    }
}
