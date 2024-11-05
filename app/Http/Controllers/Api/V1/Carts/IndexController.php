<?php

namespace App\Http\Controllers\Api\V1\Carts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\CartResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JustSteveKing\StatusCode\Http;

class IndexController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        if (!auth()->check() || !auth()->user()->cart()->count()) {
            return response()->json([
                'message' => null,
            ], Http::NO_CONTENT);
        }

        return new JsonResponse(
            new CartResource(
                auth()->user()->cart
            ),
            Http::OK
        );
    }
}
