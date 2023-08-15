<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Base\Entities\BaseModel;
use Modules\Base\Traits\HandleFilterRecord;
use Modules\Base\Traits\HasUUID;
use Modules\Site\Traits\BelongsToSite;
use Spatie\Translatable\HasTranslations;

class BlogCategory extends BaseModel
{
    use HasFactory, BelongsToSite, HasTranslations, HasUUID, HandleFilterRecord;

    const TABLE_NAME = 'blog_categories';
    const NAME = 'name';
    const DESCRIPTION = 'description';

    protected $table = self::TABLE_NAME;
    protected $fillable = [
        self::UUID,
        self::NAME,
        self::DESCRIPTION
    ];

    protected $translatable = [self::NAME, self::DESCRIPTION];

    protected static function newFactory()
    {
        return \Modules\Blog\Database\factories\BlogCategoryFactory::new();
    }
}
