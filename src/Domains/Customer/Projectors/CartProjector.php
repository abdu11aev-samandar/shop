<?php

namespace Domains\Customer\Projectors;

use Domains\Customer\Aggregates\CartAggregate;
use Domains\Customer\Events\IncreaseCartQuantity;
use Domains\Customer\Events\ProductWasAddedCart;
use Domains\Customer\Events\ProductWasRemovedFromCart;
use Domains\Customer\Models\Cart;
use Domains\Customer\Models\CartItem;
use Illuminate\Support\Str;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class CartProjector extends Projector
{
    public function onProductWasAddedToCart(ProductWasAddedCart $event): void
    {
        $cart = Cart::query()->find($event->cartID);

        $cart->items()->create([
                                   'purchaseable_id'   => $event->purchasableID,
                                   'purchaseable_type' => $event->type,
                               ]);
    }

    public function onProductWasRemovedFromCart(ProductWasRemovedFromCart $event): void
    {
        $cart = Cart::query()->find($event->cartID);

        $cart->items()->where('purchaseable_id', $event->purchasableID)
            ->where('purchaseable_type', $event->type)
            ->delete();
    }

    public function onIncreaseCartQuantity(IncreaseCartQuantity $event): void
    {
        $item = CartItem::query()->where(
            'cart_id', $event->cartID
        )->where(
            'id', $event->cartItemID
        )->first();

        $item->update([
                          'quantity' => $item->quantity + $event->quantity,
                      ]);
    }

    public function onDecreaseCartQuantity(IncreaseCartQuantity $event): void
    {
        $item = CartItem::query()->where(
            'cart_id', $event->cartID
        )->where(
            'id', $event->cartItemID
        )->first();

        if ($event->quantity >= $item->quantity) {
            CartAggregate::retrieve(Str::uuid()->toString())
                ->removeProduct(
                    $item->purchasable->id,
                    $item->cart_id,
                    get_class($item->purchasable())
                );

            return;
        }

        $item->update([
                          'quantity' => $item->quantity - $event->quantity,
                      ]);
    }
}
