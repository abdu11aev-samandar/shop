<?php

namespace App\Http\Controllers\Api\V1\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\ProductResource;
use Domains\Catalog\Models\Product;
use Illuminate\Http\Request;
use JustSteveKing\StatusCode\Http;
use Spatie\QueryBuilder\QueryBuilder;

class ShowController extends Controller
{
    public function __invoke(Request $request, string $key)
    {
        $product = QueryBuilder::for(
            Product::class,
        )->allowedIncludes(
            ['variants', 'category', 'range']
        )->active()->where('key', $key)->firstOrFail();

        return response()->json(
            new ProductResource($product),
            Http::OK
        );
    }
}
