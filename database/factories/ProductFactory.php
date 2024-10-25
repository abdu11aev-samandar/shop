<?php

namespace Database\Factories;

use Domains\Catalog\Models\Category;
use Domains\Catalog\Models\Product;
use Domains\Catalog\Models\Range;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cost = $this->faker->numberBetween(100, 1000);

        return [
            'key'         => $this->faker->unique()->slug(2),
            'name'        => $this->faker->words(4, true),
            'description' => $this->faker->paragraphs(2, true),
            'cost'        => $cost,
            'retail'      => ($cost * config('shop.profit_margin')),
            'active'      => $this->faker->boolean,
            'vat'         => config('shop.vat'),
            'category_id' => Category::factory()->create(),
            'range_id'    => $this->faker->boolean ? Range::factory()->create() : null,
        ];
    }
}
