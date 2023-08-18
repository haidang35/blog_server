<?php

namespace Modules\SeoMeta\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Base\Entities\BaseModel;
use Spatie\Translatable\HasTranslations;

class SEOMeta extends BaseModel
{
    use HasFactory, HasTranslations;

    const TABLE_NAME = 'seo_meta';
    const MODEL_ID = 'model_id';
    const MODEL_TYPE = 'model_type';
    const META_TITLE = 'meta_title';
    const META_DESCRIPTION = 'meta_description';
    const META_KEYWORDS = 'meta_keywords';
    const META_ROBOTS = 'meta_robots';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        self::MODEL_ID,
        self::MODEL_TYPE,
        self::META_TITLE,
        self::META_DESCRIPTION,
        self::META_KEYWORDS,
        self::META_ROBOTS,
    ];

    protected $translatable = [
        self::META_TITLE,
        self::META_DESCRIPTION,
        self::META_KEYWORDS,
    ];

    protected $casts = [
      self::META_ROBOTS => 'json'
    ];

    protected static function newFactory()
    {
        return \Modules\SeoMeta\Database\factories\SEOMetaFactory::new();
    }
}
