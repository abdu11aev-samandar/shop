<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
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
            'type'          => 'cart-item',
            'attributes'    => [
                'id'       => $this->uuid,
                'quantity' => $this->quantity,
                'item'     => [
                    'purchasable_id'   => $this->purchasable_id,
                    'purchasable_type' => $this->purchasable_type,
                ],
            ],
            'relationships' => [
                'cart' => new CartResource(
                    $this->whenLoaded('cart')
                ),
            ],
        ];
    }
}
