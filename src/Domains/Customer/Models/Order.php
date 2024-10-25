<?php

namespace Domains\Customer\Models;

use Database\Factories\OrderFactory;
use Domains\Shared\Models\Concerns\HasKey;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    use HasKey;

    protected $fillable = [
        'key',
        'number',
        'state',
        'coupon',
        'total',
        'reduction',
        'user_id',
        'shipping_id',
        'billing_id',
        'completed_at',
        'canceled_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'canceled_at'  => 'datetime',
    ];

    public function shipping(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'shipping_id');
    }

    public function billing(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'billing_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lineItems(): HasMany
    {
        return $this->hasMany(OrderLine::class, 'order_id');
    }

    protected static function newFactory(): Factory
    {
        return new OrderFactory();
    }
}
