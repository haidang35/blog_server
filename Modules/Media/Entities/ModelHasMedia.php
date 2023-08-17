<?php

namespace Modules\Media\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Base\Entities\BaseModel;

class ModelHasMedia extends BaseModel
{
    use HasFactory;

    const TABLE_NAME = 'model_has_media';
    const MODEL_ID = 'model_id';
    const MODEL_TYPE = 'model_type';
    const MEDIA_ID = 'media_id';
    const TYPE = 'type';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        self::MODEL_TYPE,
        self::MODEL_ID,
        self::MEDIA_ID
    ];

    protected static function newFactory()
    {
        return \Modules\Media\Database\factories\ModelHasMediaFactory::new();
    }
}
