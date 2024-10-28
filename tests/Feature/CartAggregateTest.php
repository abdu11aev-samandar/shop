<?php

use Domains\Catalog\Models\Product;
use Domains\Catalog\Models\Variant;
use Domains\Customer\Aggregates\CartAggregate;
use Domains\Customer\Events\ProductWasAddedCart;
use Domains\Customer\Models\Cart;

it('can store an event for adding a product', function () {
    $product = Variant::factory()->create();
    $cart    = Cart::factory()->create();

    $event = new ProductWasAddedCart(
        purchasableID: $product->id,
        cartID:        $cart->id,
        type:          Cart::class,
    );

    CartAggregate::fake()
        ->given([
                    $event,
                ])
        ->when(function (CartAggregate $cartAggregate) use ($product, $cart): void {
            $cartAggregate->addProduct(
                $product->id,
                $cart->id,
                Cart::class
            );
        })
        ->assertEventRecorded(
            new ProductWasAddedCart(
                purchasableID: $product->id,
                cartID:        $cart->id,
                type:          Cart::class,
            )
        );
});
