<?php

namespace App\Http\Controllers\Api\V1\Carts\Coupons;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Carts\Coupons\StoreRequest;
use Domains\Customer\Aggregates\CartAggregate;
use Domains\Customer\Models\Cart;
use Domains\Customer\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use JustSteveKing\StatusCode\Http;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request, Cart $cart)
    {
        $coupon = Coupon::query()->where('code', $request->code)
            ->firstOrFail();

        CartAggregate::retrieve($cart->uuid)
            ->applyCoupon(
                $cart->id,
                $coupon->code
            )->persist();

        return new Response(
            null,
            Http::ACCEPTED
        );
    }
}
