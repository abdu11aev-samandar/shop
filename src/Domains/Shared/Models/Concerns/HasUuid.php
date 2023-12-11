<?php

namespace Domains\Shared\Models\Concerns;

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
