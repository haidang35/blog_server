<?php

namespace Modules\Site\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Modules\Base\Enums\FilterOperator;
use Modules\Site\Entities\Site;

class FilterBySiteScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->whereHas('site', function ($query) {
            $query->where(Site::DOMAIN, request()->header(config('client.headers.domain')));
        });
    }
}
