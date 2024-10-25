<?php

namespace Domains\Customer\Models;

use Database\Factories\CartFactory;
use Domains\Customer\States\Statuses\CartStatus;
use Domains\Shared\Models\Concerns\HasKey;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory;
    use HasKey;

    protected $fillable = [
        'key',
        'status',
        'coupon',
        'total',
        'reduction',
        'user_id',
    ];

    protected $casts = [
        'status' => CartStatus::class . ':nullable',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected static function newFactory(): Factory
    {
        return new CartFactory();
    }
}
