<?php

namespace Domains\Customer\Actions;

use Domains\Customer\Models\Cart;
use Domains\Customer\ValueObjects\CartValueObject;
use Illuminate\Database\Eloquent\Model;

class CreateCart
{
    public static function handle(CartValueObject $cart): Model
    {
        return Cart::query()->create($cart->toArray());
    }
}
