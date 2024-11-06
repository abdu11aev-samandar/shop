<?php

namespace Domains\Customer\Actions;

use Domains\Customer\Aggregates\CartAggregate;
use Domains\Customer\Models\Cart;
use Illuminate\Database\Eloquent\Model;

class RemoveProductFromCart
{
    public static function handle(Cart $cart, Model $cartItem): void
    {
        CartAggregate::retrieve(
            $cart->uuid
        )
            ->removeProduct(
                $cartItem->id,
                $cart->id,
                $cartItem::class
            )->persist();
    }
}
