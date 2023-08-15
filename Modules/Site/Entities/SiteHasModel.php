<?php

namespace Modules\Site\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Base\Entities\BaseModel;

class SiteHasModel extends Model
{
    use HasFactory;

    public $timestamps = false;

    const TABLE_NAME = 'site_has_models';
    const SITE_ID = 'site_id';
    const MODEL_ID = 'model_id';
    const MODEL_TYPE = 'model_type';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        self::SITE_ID,
        self::MODEL_ID,
        self::MODEL_TYPE
    ];

    protected static function newFactory()
    {
        return \Modules\Site\Database\factories\SiteHasModelFactory::new();
    }
}
