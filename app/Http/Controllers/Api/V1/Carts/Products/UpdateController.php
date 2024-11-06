<?php

namespace App\Http\Controllers\Api\V1\Carts\Products;

use App\Http\Requests\Api\V1\Carts\Products\UpdateRequest;
use Domains\Customer\Actions\ChangeCartQuantity;
use Domains\Customer\Models\CartItem;
use App\Http\Controllers\Controller;
use JustSteveKing\StatusCode\Http;
use Domains\Customer\Models\Cart;
use Illuminate\Http\Response;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Cart $cart, CartItem $cartItem)
    {
        ChangeCartQuantity::handle(
            $cart,
            $cartItem,
            $request->quantity
        );

        return new Response(
            null,
            Http::ACCEPTED
        );
    }
}
