<?php

namespace Domains\Customer\Models;

use Database\Factories\LocationFactory;
use Domains\Customer\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /** @use HasFactory<\Database\Factories\LocationFactory> */
    use HasFactory;
    use HasUuid;

    protected $fillable = [
        'uuid',
        'house',
        'street',
        'parish',
        'ward',
        'district',
        'county',
        'postcode',
        'country',
    ];

    protected static function newFactory()
    {
        return new LocationFactory();
    }
}
