<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Base\Entities\BaseModel;
use Modules\Base\Traits\HandleFilterRecord;
use Modules\Base\Traits\HasUUID;
use Modules\Media\Entities\Media;
use Modules\Media\Entities\ModelHasMedia;
use Modules\Media\Traits\HandleSaveMedia;
use Modules\Site\Traits\BelongsToSite;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Blog extends BaseModel implements HasMedia
{
    use HasFactory, HasTranslations, SoftDeletes, InteractsWithMedia, HandleFilterRecord, HasUUID, HandleSaveMedia, BelongsToSite;

    const TABLE_NAME = 'blogs';
    protected $table = self::TABLE_NAME;
    const UUID = 'uuid';
    const TITLE = 'title';
    const CONTENT = 'content';
    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'updated_by';
    const DELETED_BY = 'deleted_by';

    const MEDIA_TYPE_THUMBNAIL = 'thumbnail';

    protected $fillable = [
        self::UUID,
        self::TITLE,
        self::CONTENT,
        self::CREATED_BY,
        self::UPDATED_BY,
        self::DELETED_BY
    ];

    protected $hidden = [
    ];

    protected $appends = [
        'thumbnail'
    ];

    protected static function newFactory()
    {
        return \Modules\Blog\Database\factories\BlogFactory::new();
    }

    public $translatable = [self::TITLE, self::CONTENT];

    public function categories()
    {
        return $this->belongsToMany(
            BlogCategory::class,
            BlogHasCategory::class,
            BlogHasCategory::BLOG_ID,
            BlogHasCategory::BLOG_CATEGORY_ID,
            self::ID,
            BlogCategory::ID
        );
    }

    public function categoryIds()
    {
        return $this->categories()->pluck(BlogCategory::ID);
    }

    public function getThumbnailAttribute()
    {
        $file = $this->files()
            ->wherePivot(ModelHasMedia::TYPE, self::MEDIA_TYPE_THUMBNAIL)
            ->first();
        return [
            'original_url' => $file ? $file['original_url'] : null,
            'name' => $file ? $file['name'] : null,
            'id' => $file ? $file['id'] : null,
        ];
    }
}
