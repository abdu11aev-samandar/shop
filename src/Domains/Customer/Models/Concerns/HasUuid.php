<?php

namespace Domains\Customer\Models\Concerns;

use Illuminate\Support\Str;

trait HasUuid
{
    protected static function bootHasUuid(): void
    {
        static::creating(function ($model) {
            $model->uuid = (string)Str::uuid();
        });
    }
}
