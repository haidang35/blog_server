<?php

namespace Modules\Media\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Base\Traits\HandleFilterRecord;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    use HasFactory, HandleFilterRecord;

    CONST ID = 'id';
    const MODEL_ID = 'model_id';
    const MODEL_TYPE = 'model_type';

    protected static function newFactory()
    {
        return \Modules\Media\Database\factories\MediaFactory::new();
    }
}
