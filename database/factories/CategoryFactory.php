<?php

namespace Database\Factories;

use Domains\Catalog\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => $this->faker->unique()->word,
            'name'        => $this->faker->word(3, true),
            'description' => $this->faker->paragraph(4, true),
            'active'      => true,
        ];
    }
}
