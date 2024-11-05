<?php

namespace Domains\Customer\Actions;

use Domains\Customer\Models\Cart;
use Illuminate\Database\Eloquent\Model;
use Domains\Customer\ValueObjects\CartItemValueObject;

class AddProductToCart
{
    public static function handle(CartItemValueObject $cartItem, Cart $cart): Model
    {
        return $cart->items()->create($cartItem->toArray());
    }
}
