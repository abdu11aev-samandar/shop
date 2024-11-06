<?php

namespace App\Http\Controllers\Api\V1\Carts\Products;

use App\Http\Controllers\Controller;
use Domains\Customer\Actions\RemoveProductFromCart;
use Domains\Customer\Models\Cart;
use Domains\Customer\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use JustSteveKing\StatusCode\Http;

class DeleteController extends Controller
{
    public function __invoke(Request $request, Cart $cart, CartItem $cartItem): Response
    {
        RemoveProductFromCart::handle(
            $cart,
            $cartItem
        );

        return new Response(
            null,
            Http::ACCEPTED
        );
    }
}
