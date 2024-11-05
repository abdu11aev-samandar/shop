<?php

namespace App\Http\Controllers\Api\V1\Carts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\CartResource;
use Domains\Customer\Actions\AddProductToCart;
use Domains\Customer\Aggregates\CartAggregate;
use Domains\Customer\Factories\CartFactory;
use Domains\Customer\Models\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StoreController extends Controller
{
    public function __invoke(Request $request, Cart $cart): Response
    {
        CartAggregate::retrieve($cart->uuid)
            ->addProduct(
                $request->get('purchaseable_id'),
                $request->get('purchaseable_type'),
                $cart->id,
            )->persist();

        return new Response(
            content: null,
            status:  Response::HTTP_CREATED
        );
    }
}
