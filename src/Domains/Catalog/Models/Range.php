<?php

namespace Domains\Catalog\Models;

use Database\Factories\RangeFactory;
use Domains\Catalog\Models\Builders\RangeBuilder;
use Domains\Shared\Models\Concerns\HasKey;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Range extends Model
{
    /** @use HasFactory<\Database\Factories\RangeFactory> */
    use HasFactory;
    use HasKey;

    public $timestamps = false;

    protected $fillable = [
        'key',
        'name',
        'description',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function newEloquentBuilder($query): Builder
    {
        return new RangeBuilder(
            $query
        );
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'range_id');
    }

    protected static function newFactory(): Factory
    {
        return new RangeFactory();
    }
}
