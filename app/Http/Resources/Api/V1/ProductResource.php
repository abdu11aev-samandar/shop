<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'type'       => 'product',
            'attributes' => [
                'key'           => $this->key,
                'name'          => $this->name,
                'slug'          => $this->slug,
                'description'   => $this->description,
                'price'         => [
                    'cost'   => $this->cost,
                    'retail' => $this->retail,
                ],
                'active'        => $this->active,
                'vat'           => $this->vat,
                'relationships' => [
                    'category' => new CategoryResource($this->whenLoaded('category')),
                    'range'    => new RangeResource($this->whenLoaded('range')),
                    'variants' => new VariantResource($this->whenLoaded('variants')),
                ],
            ],
            'links'      => [
                '_self'   => route('products:show', $this->key),
                '_parent' => route('products:index'),
            ],
        ];
    }
}
