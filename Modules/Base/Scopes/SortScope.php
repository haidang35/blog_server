<?php

namespace Modules\Base\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Modules\Base\Enums\FilterOperator;

class SortScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $sort = request('sort') ?? [];
        foreach($sort as $sortItem) {
            $builder->orderBy($sortItem['column'], $sortItem['type']);
        }
    }
}
