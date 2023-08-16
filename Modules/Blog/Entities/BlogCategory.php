<?php

namespace Modules\Blog\Entities;

use App\Casts\TransValue;
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
    const PARENT_ID = 'parent_id';
    const NAME = 'name';
    const DESCRIPTION = 'description';

    protected $table = self::TABLE_NAME;
    protected $fillable = [
        self::UUID,
        self::PARENT_ID,
        self::NAME,
        self::DESCRIPTION
    ];

    protected $translatable = [self::NAME, self::DESCRIPTION];

    protected static function newFactory()
    {
        return \Modules\Blog\Database\factories\BlogCategoryFactory::new();
    }

    public function children()
    {
        return $this->hasMany(BlogCategory::class, BlogCategory::PARENT_ID, self::ID)
            ->with(['children']);
    }
}
