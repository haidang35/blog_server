<?php

namespace Modules\Media\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Base\Scopes\FilterScope;
use Modules\Base\Scopes\SortScope;
use Modules\Base\Traits\HandleFilterRecord;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    use HasFactory;

    const MODEL_ID = 'model_id';
    const MODEL_TYPE = 'model_type';

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
//        static::addGlobalScope(new FilterScope);
//        static::addGlobalScope(new SortScope);
    }

    protected static function newFactory()
    {
        return \Modules\Media\Database\factories\MediaFactory::new();
    }
}
