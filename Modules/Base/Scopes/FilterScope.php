<?php

namespace Modules\Base\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Modules\Base\Enums\FilterOperator;

class FilterScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $filter = request('filter') ?? [];
        foreach ($filter as $filterItem) {
            $operator = $filterItem['operator'];
            $filterValue = array_key_exists('value', $filterItem) ? $filterItem['value'] : NULL;
            $filterColumn = $filterItem['column'];
            switch ($operator) {
                case FilterOperator::CONTAINS->value:
                    $builder->where($filterColumn, 'LIKE', '%' . $filterValue . '%');
                    break;
                case FilterOperator::EQUALS->value:
                    $builder->where($filterColumn, '=', $filterValue);
                    break;
                case FilterOperator::STARTS_WITH->value:
                    $builder->where($filterColumn, 'LIKE', $filterValue . '%');
                    break;
                case FilterOperator::ENDS_WITH->value:
                    $builder->where($filterColumn, 'LIKE', '%' . $filterValue);
                    break;
                case FilterOperator::IS_EMPTY->value:
                    $builder->where(function ($builder) use ($filterColumn) {
                        $builder->where($filterColumn, '=', '')
                            ->orWhereNull($filterColumn);
                    });
                    break;
                case FilterOperator::IS_NOT_EMPTY->value:
                    $builder->whereNotNull($filterColumn);
                    break;
                default:
                    break;
            }
        }
    }
}
