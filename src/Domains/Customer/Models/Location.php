<?php

namespace Domains\Customer\Models;

use Database\Factories\LocationFactory;
use Domains\Shared\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasUuid;
    use HasFactory;

    protected $fillable = [
        'house',
        'street',
        'parish',
        'ward',
        'district',
        'county',
        'postcode',
        'country',
    ];

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class, 'location_id');
    }

    protected static function newFactory(): Factory
    {
        return LocationFactory::new();
    }
}
