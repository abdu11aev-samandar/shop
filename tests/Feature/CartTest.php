<?php

use Domains\Catalog\Models\Variant;
use Domains\Customer\Models\Cart;
use JustSteveKing\StatusCode\Http;
use Illuminate\Testing\Fluent\AssertableJson;
use Domains\Customer\States\Statuses\CartStatus;

use Spatie\EventSourcing\StoredEvents\Models\EloquentStoredEvent;

use function Pest\Laravel\get;
use function Pest\Laravel\post;

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

    $cart = Cart::factory()->create();
    $variant = Variant::factory()->create();

    post(
        route('carts:products:store', $cart->uuid),
        [
            'quantity' => 1,
            'purchaseable_id' => $variant->id,
            'purchaseable_type' => 'variant',
        ]
    )->assertStatus(
        Http::CREATED
    );

    expect(EloquentStoredEvent::query()->get())->toHaveCount(1);
    expect(EloquentStoredEvent::query()->first()->event_class)->toEqual(\Domains\Customer\Events\ProductWasAddedCart::class);
});
