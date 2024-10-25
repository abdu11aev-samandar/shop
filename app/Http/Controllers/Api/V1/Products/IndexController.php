<?php

namespace App\Http\Controllers\Api\V1\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\ProductResource;
use Domains\Catalog\Models\Product;
use Illuminate\Http\Request;
use JustSteveKing\StatusCode\Http;
use Spatie\QueryBuilder\QueryBuilder;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $products = QueryBuilder::for(
            Product::class,
        )->allowedIncludes(
            ['variants', 'category', 'range']
        )->allowedFilters(
            ['active', 'vat']
        )->paginate();

        return response()->json(
            ProductResource::collection($products),
            Http::OK
        );
    }
}
