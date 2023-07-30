<?php

namespace Modules\Base\Enums;

enum FilterOperator: string
{
    case CONTAINS = 'contains';
    case EQUALS = 'equals';
    case STARTS_WITH = 'startsWith';
    case ENDS_WITH = 'endsWith';
    case IS_EMPTY = 'isEmpty';
    case IS_NOT_EMPTY = "isNotEmpty";
}
