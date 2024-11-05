<?php

namespace Domains\Customer\Factories;

use Domains\Customer\ValueObjects\CartValueObject;

class CartFactory
{
    public static function make(array $attributes): CartValueObject
    {
        return new CartValueObject(
            status:    $attributes['status'],
            user_id:   $attributes['user_id'],
        );
    }
}
