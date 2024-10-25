<?php

namespace Domains\Catalog\Models\Builders;

use Domains\Shared\Models\Builders\Shared\HasActiveScope;
use Illuminate\Database\Eloquent\Builder;

class CategoryBuilder extends Builder
{
    use HasActiveScope;
}