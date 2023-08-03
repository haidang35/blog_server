<?php

namespace Modules\Base\Traits;

use Modules\Base\Enums\FilterOperator;
use Modules\Base\Scopes\FilterScope;
use Modules\Base\Scopes\SortScope;

trait HandleSortFilter
{
    public static function bootHandleSortFilter()
    {
        static::addGlobalScope(new FilterScope());
        static::addGlobalScope(new SortScope());
    }

    public function scopeFilterValue($query, array $filter)
    {
        foreach ($filter as $filterItem) {
            $operator = $filterItem['operator'];
            $filterValue = array_key_exists('value', $filterItem) ? $filterItem['value'] : NULL;
            $filterColumn = $filterItem['column'];
            switch ($operator) {
                case FilterOperator::CONTAINS->value:
                    $query->where($filterColumn, 'LIKE', '%' . $filterValue . '%');
                    break;
                case FilterOperator::EQUALS->value:
                    $query->where($filterColumn, '=', $filterValue);
                    break;
                case FilterOperator::STARTS_WITH->value:
                    $query->where($filterColumn, 'LIKE', $filterValue . '%');
                    break;
                case FilterOperator::ENDS_WITH->value:
                    $query->where($filterColumn, 'LIKE', '%' . $filterValue);
                    break;
                case FilterOperator::IS_EMPTY->value:
                    $query->where(function ($query) use ($filterColumn) {
                        $query->where($filterColumn, '=', '')
                            ->orWhereNull($filterColumn);
                    });
                    break;
                case FilterOperator::IS_NOT_EMPTY->value:
                    $query->whereNotNull($filterColumn);
                    break;
                default:
                    break;
            }
        }
        return $query;
    }

    public function scopeSortColumn($query, array $sort)
    {
        foreach($sort as $sortItem) {
            $query->orderBy($sortItem['column'], $sortItem['type']);
        }
        return $query;
    }
}
