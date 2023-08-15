<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Base\Entities\BaseModel;
use Modules\Site\Traits\BelongsToSite;

class BlogHasCategory extends BaseModel
{
    use HasFactory, BelongsToSite;

    public $timestamps = false;

    const TABLE_NAME = 'blog_has_categories';
    const BLOG_ID = 'blog_id';
    const BLOG_CATEGORY_ID = 'blog_category_id';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        self::BLOG_ID,
        self::BLOG_CATEGORY_ID
    ];

    protected static function newFactory()
    {
        return \Modules\Blog\Database\factories\BlogHasCategoryFactory::new();
    }
}
