<?php

namespace Domains\Customer\Models;

use Database\Factories\OrderLineFactory;
use Domains\Shared\Models\Concerns\HasKey;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class OrderLine extends Model
{
    /** @use HasFactory<\Database\Factories\OrderLineFactory> */
    use HasFactory;
    use HasKey;

    protected $fillable = [
        'key',
        'name',
        'description',
        'retail',
        'cost',
        'quantity',
        'purchasable_type',
        'purchasable_id',
        'order_id',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function purchasable(): MorphTo
    {
        return $this->morphTo();
    }

     protected static function newFactory(): Factory
    {
        return new OrderLineFactory();
    }
}
