<?php

use Domains\Catalog\Models\Variant;
use Domains\Customer\Events\CouponWasApplied;
use Domains\Customer\Events\DecreaseCartQuantity;
use Domains\Customer\Events\IncreaseCartQuantity;
use Domains\Customer\Events\ProductWasAddedCart;
use Domains\Customer\Events\ProductWasRemovedFromCart;
use Domains\Customer\Models\Cart;
use Domains\Customer\Models\CartItem;
use Domains\Customer\Models\Coupon;
use JustSteveKing\StatusCode\Http;
use Illuminate\Testing\Fluent\AssertableJson;
use Domains\Customer\States\Statuses\CartStatus;
use Spatie\EventSourcing\StoredEvents\Models\EloquentStoredEvent;

use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\patch;

it('can create a cart for an anonymous user', function () {
    post(
        route('carts:store')
    )->assertStatus(
        Http::CREATED
    )->assertJson(fn(AssertableJson $json) => $json
        ->where('type', 'cart')
        ->where('attributes .status', CartStatus::pending()->label)
        ->etc()
    );
});

it('returns a cart for a logged in user', function () {
    $cart = Cart::factory()->create();

    auth()->loginUsingId(
        $cart->user->id
    );

    get(
        route('carts:index')
    )->assertStatus(
        Http::OK
    );
});

it('returns a not found status when a guest tries to retrieve their cart', function () {
    get(
        route('carts:index')
    )->assertStatus(
        Http::NO_CONTENT
    );
});

it('can add a new product to a cart', function () {
    expect(EloquentStoredEvent::query()->get())->toHaveCount(0);

    $cart    = Cart::factory()->create();
    $variant = Variant::factory()->create();

    post(
        route('carts:products:store', $cart->uuid),
        [
            'quantity'          => 1,
            'purchaseable_id'   => $variant->id,
            'purchaseable_type' => 'variant',
        ]
    )->assertStatus(
        Http::CREATED
    );

    expect(EloquentStoredEvent::query()->get())->toHaveCount(0)
        ->and(EloquentStoredEvent::query()
                  ->first()->event_class)->toEqual(ProductWasAddedCart::class);
});

it('can increase the quantity of an item in the cart', function () {
    expect(EloquentStoredEvent::query()->get())->toHaveCount(0);
    $item = CartItem::factory()->create(['quantity' => 1]);

    expect($item->quantity)->toEqual(1);

    patch(
        route('carts:products:update', [
            'cart'     => $item->cart->uuid,
            'cartItem' => $item->uuid,
        ]),
        [
            'quantity' => 2,
        ],
    )->assertStatus(Http::ACCEPTED);

    expect(EloquentStoredEvent::query()->get())->toHaveCount(0)
        ->and(EloquentStoredEvent::query()
                  ->first()->event_class)->toEqual(IncreaseCartQuantity::class);
});

it('can decrease the quantity of an item in the cart', function () {
    expect(EloquentStoredEvent::query()->get())->toHaveCount(0);
    $item = CartItem::factory()->create(['quantity' => 3]);

    expect($item->quantity)->toEqual(3);

    patch(
        route('carts:products:update', [
            'cart'     => $item->cart->uuid,
            'cartItem' => $item->uuid,
        ]),
        [
            'quantity' => 1,
        ],
    )->assertStatus(Http::ACCEPTED);

    expect(EloquentStoredEvent::query()->get())->toHaveCount(1)
        ->and(EloquentStoredEvent::query()
                  ->first()->event_class)->toEqual(DecreaseCartQuantity::class);
});

it('removes an items from the cart when the quantity is zero', function () {
    expect(EloquentStoredEvent::query()->get())->toHaveCount(0);
    $item = CartItem::factory()->create(['quantity' => 3]);

    expect($item->quantity)->toEqual(3);

    patch(
        route('carts:products:update', [
            'cart'     => $item->cart->uuid,
            'cartItem' => $item->uuid,
        ]),
        [
            'quantity' => 0,
        ],
    )->assertStatus(Http::ACCEPTED);

    expect(EloquentStoredEvent::query()->get())->toHaveCount(1)
        ->and(EloquentStoredEvent::query()
                  ->first()->event_class)->toEqual(ProductWasRemovedFromCart::class);
});

it('can remove an item from the cart', function () {
    expect(EloquentStoredEvent::query()->get())->toHaveCount(0);
    $item = CartItem::factory()->create(['quantity' => 3]);

    delete(
        route('carts:products:destroy', [
            'cart'     => $item->cart->uuid,
            'cartItem' => $item->uuid,
        ])
    )->assertStatus(Http::ACCEPTED);

    expect(EloquentStoredEvent::query()->get())->toHaveCount(1)
        ->and(EloquentStoredEvent::query()
                  ->first()->event_class)->toEqual(ProductWasRemovedFromCart::class);
});

it('can apply a coupon to a cart', function () {
    expect(EloquentStoredEvent::query()->get())->toHaveCount(0);
    $coupon = Coupon::factory()->create();
    $cart = Cart::factory()->create();

    expect($cart)->reducation->toEqual(0);

    post(
        route('carts:coupon:store', $cart->uuid),
        [
            'code' => $coupon->code,
        ]
    )->assertStatus(Http::ACCEPTED);

    expect(EloquentStoredEvent::query()->get())->toHaveCount(1)
        ->and(EloquentStoredEvent::query()
                  ->first()->event_class)->toEqual(CouponWasApplied::class);
});
