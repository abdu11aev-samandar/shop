<?php

namespace Database\Factories;

use Domains\Catalog\Models\Product;
use Domains\Catalog\Models\Variant;
use Domains\Customer\Models\Order;
use Domains\Customer\Models\OrderLine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domains\Customer\Models\OrderLine>
 */
class OrderLineFactory extends Factory
{
    protected $model = OrderLine::class;

    public function definition(): array
    {
        $variant = Variant::factory()->create();

        return [
            'name'             => $variant->name,
            'description'      => $variant->product->description,
            'retail'           => $variant->retail,
            'cost'             => $variant->cost,
            'quantity'         => $this->faker->numberBetween(1, 7),
            'purchasable_type' => 'variant',
            'purchasable_id'   => $variant->id,
            'order_id'         => Order::factory()->create(),
        ];
    }
}
