<?php

namespace Domains\Catalog\Models;

use Database\Factories\RangeFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Range extends Model
{
    /** @use HasFactory<\Database\Factories\RangeFactory> */
    use HasFactory;

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

    protected static function newFactory(): Factory
    {
        return new RangeFactory();
    }
}
