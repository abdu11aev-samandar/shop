<?php

namespace Domains\Customer\Aggregates;

use Domains\Customer\Events\CouponWasApplied;
use Domains\Customer\Events\IncreaseCartQuantity;
use Domains\Customer\Events\ProductWasAddedCart;
use Domains\Customer\Events\ProductWasRemovedFromCart;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class CartAggregate extends AggregateRoot
{
    public function addProduct(int $purchasableID, int $cartID, string $type): self
    {
        $this->recordThat(
            new ProductWasAddedCart(
                purchasableID: $purchasableID,
                cartID:    $cartID,
                type:      $type
            )
        );

        return $this;
    }

    public function removeProduct(int $purchasableID, int $cartID, string $type): self
    {
        $this->recordThat(
            new ProductWasRemovedFromCart(
                purchasableID: $purchasableID,
                cartID:    $cartID,
                type:      $type
            )
        );

        return $this;
    }

    public function increaseQuantity(int $cartID, int $cartItemID, int $quantity): self
    {
        $this->recordThat(
            new IncreaseCartQuantity(
                cartID:     $cartID,
                cartItemID: $cartItemID,
                quantity:   $quantity
            )
        );

        return $this;
    }

    public function decreaseQuantity(int $cartID, int $cartItemID, int $quantity): self
    {
        $this->recordThat(
            new IncreaseCartQuantity(
                cartID:     $cartID,
                cartItemID: $cartItemID,
                quantity:   $quantity
            )
        );

        return $this;
    }

    public function applyCoupon(int $cartID, string $code): self
    {
        $this->recordThat(
            new CouponWasApplied(
                cartID: $cartID,
                code:   $code
            )
        );

        return $this;
    }
}
