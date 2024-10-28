<?php

namespace Domains\Customer\Models;

use Database\Factories\CouponFactory;
use Domains\Shared\Models\Concerns\HasKey;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    /** @use HasFactory<\Database\Factories\CouponFactory> */
    use HasFactory;
    use HasKey;

    protected $fillable = [
        'key',
        'code',
        'reduction',
        'uses',
        'max_uses',
        'active',
    ];

     protected $casts = [
        'active' => 'boolean',
    ];

     protected static function newFactory(): Factory
    {
        return new CouponFactory();
    }
}
