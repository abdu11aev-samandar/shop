<?php

namespace Domains\Customer\Actions;

use Domains\Customer\Aggregates\CartAggregate;
use Domains\Customer\Models\CartItem;
use Domains\Customer\Models\Cart;

class ChangeCartQuantity
{
    public static function handle(Cart $cart, CartItem $cartItem, int $quantity = 0): void
    {
        $aggregate = CartAggregate::retrieve($cart->uuid);

        match (true) {
            $quantity === 0 => $aggregate->removeProduct(
                $cartItem->id,
                $cart->id,
                $cartItem::class
            )->persist(),
            $quantity < $cartItem->quantity => $aggregate->increaseQuantity(
                $cart->id,
                $quantity,
                $cartItem->id
            )->persist(),
            $quantity > $cartItem->quantity => $aggregate->decreaseQuantity(
                $cart->id,
                $quantity,
                $cartItem->id
            )->persist(),
        };
    }
}
