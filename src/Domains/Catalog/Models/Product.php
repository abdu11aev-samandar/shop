<?php

namespace Domains\Catalog\Models;

use Database\Factories\ProductFactory;
use Domains\Catalog\Models\Builders\ProductBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'key',
        'name',
        'description',
        'cost',
        'retail',
        'active',
        'vat',
        'category_id',
        'range_id',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function newEloquentBuilder($query): Builder
    {
        return new ProductBuilder(
            $query
        );
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function range(): BelongsTo
    {
        return $this->belongsTo(Range::class, 'range_id');
    }

    protected static function newFactory(): Factory
    {
        return new ProductFactory();
    }
}
