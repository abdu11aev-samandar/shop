<?php

namespace Database\Factories;

use Domains\Catalog\Models\Variant;
use Domains\Customer\Models\Cart;
use Domains\Customer\Models\CartItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domains\Customer\Models\CartItem>
 */
class CartItemFactory extends Factory
{
    protected $model = CartItem::class;

    public function definition(): array
    {
        $variant = Variant::factory()->create();

        return [
            'quantity'          => $this->faker->numberBetween(1, 12),
            'purchasable_id'    => $variant->id,
            'purchasable_type'  => 'variant',
            'cart_id'           => Cart::factory()->create(),
        ];
    }
}
