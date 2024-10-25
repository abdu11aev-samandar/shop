<?php

namespace Database\Factories;

use Domains\Catalog\Models\Range;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Range>
 */
class RangeFactory extends Factory
{
    protected $model = Range::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => $this->faker->unique()->word,
            'name'        => $this->faker->words(3, true),
            'description' => $this->faker->paragraphs(4, true),
            'active'      => true,
        ];
    }
}
