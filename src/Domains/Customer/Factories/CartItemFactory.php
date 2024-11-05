<?php

namespace Domains\Customer\Factories;

use Domains\Customer\ValueObjects\CartItemValueObject;
use Domains\Customer\ValueObjects\CartValueObject;

class CartItemFactory
{
    public static function make(array $attributes): CartItemValueObject
    {
        return new CartItemValueObject(
            quantity:        $attributes['quantity'],
            purchasableId:   $attributes['purchaseable_id'],
            purchasableType: $attributes['purchaseable_type'],
        );
    }
}
