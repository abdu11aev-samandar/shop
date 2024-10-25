<?php

namespace Domains\Shared\Models\Builders\Shared;

use Illuminate\Database\Eloquent\Builder;

trait HasActiveScope
{
    public function active(): self
    {
        return $this->where('active', true);
    }

    public function inactive(): self
    {
        return $this->where('active', false);
    }
}
