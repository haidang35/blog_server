<?php

namespace Modules\Base\Traits;

use Illuminate\Support\Str;

trait HasUUID
{
    public static function bootHasUUID()
    {
        static::creating(function ($item) {
            $item->uuid = Str::uuid();
        });
    }

    public function scopeFindByUUID($query, $uuid)
    {
        return $query->where('uuid', $uuid)->firstOrFail();
    }
}
