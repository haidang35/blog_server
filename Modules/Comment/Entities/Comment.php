<?php

namespace Modules\Comment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Base\Entities\BaseModel;
use Modules\Comment\Traits\HasComments;
use Modules\Site\Traits\BelongsToSite;

class Comment extends BaseModel
{
    use HasFactory, BelongsToSite;

    const TABLE_NAME = 'comments';
    CONST MODEL_ID = 'model_id';
    CONST MODEL_TYPE = 'model_type';
    CONST REPLY_ID = 'reply_id';
    const NAME = 'name';
    CONST CONTENT = 'content';
    const EMAIL = 'email';
    const WEBSITE = 'website';
    const PARENT_ID = 'parent_id';
    const TOTAL_LIKE = 'total_like';

    protected $fillable = [
        self::REPLY_ID,
        self::MODEL_ID,
        self::MODEL_TYPE,
        self::NAME,
        self::CONTENT,
        self::EMAIL,
        self::WEBSITE,
        self::PARENT_ID,
        self::TOTAL_LIKE
    ];

    protected static function newFactory()
    {
        return \Modules\Comment\Database\factories\CommentFactory::new();
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, Comment::PARENT_ID, self::ID);
    }

}
