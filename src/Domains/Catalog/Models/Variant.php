<?php

namespace Domains\Catalog\Models;

use Database\Factories\VariantFactory;
use Domains\Catalog\Models\Builders\VariantBuilder;
use Domains\Customer\Models\CartItem;
use Domains\Customer\Models\OrderLine;
use Domains\Shared\Models\Builders\Shared\HasActiveScope;
use Domains\Shared\Models\Concerns\HasKey;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Variant extends Model
{
    /** @use HasFactory<\Database\Factories\VariantFactory> */
    use HasFactory;
    use HasActiveScope;
    use HasKey;

    protected $fillable = [
        'key',
        'name',
        'cost',
        'retail',
        'height',
        'width',
        'length',
        'weight',
        'active',
        'shippable',
        'product_id',
    ];

    public function newEloquentBuilder($query): Builder
    {
        return new VariantBuilder(
            $query
        );
    }

    protected $casts = [
        'active'    => 'boolean',
        'shippable' => 'boolean',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function purchases(): MorphMany
    {
        return $this->morphMany(CartItem::class, 'purchasable');
    }

    public function orders(): MorphMany
    {
        return $this->morphMany(OrderLine::class, 'purchasable');
    }

    protected static function newFactory(): Factory
    {
        return new VariantFactory();
    }
}
