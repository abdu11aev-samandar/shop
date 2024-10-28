<?php

namespace Database\Factories;

use Domains\Customer\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domains\Customer\Models\Coupon>
 */
class CouponFactory extends Factory
{
    protected $model = Coupon::class;

    public function definition(): array
    {
        $max = $this->faker->numberBetween(1, 1000);

        return [
            'code'      => $this->faker->bothify('COUP-????-????'),
            'reduction' => $this->faker->numberBetween(100, 5000),
            'uses'      => $this->faker->numberBetween(1, $max),
            'max_uses'  => $this->faker->boolean() ? $max : null,
            'active'    => $this->faker->boolean(),
        ];
    }
}
