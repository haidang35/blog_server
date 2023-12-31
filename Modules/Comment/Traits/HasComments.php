<?php

namespace Modules\Comment\Traits;

use Modules\Comment\Entities\Comment;

trait HasComments
{
    public function comments()
    {
        return $this->hasMany(Comment::class, Comment::MODEL_ID, self::ID)
            ->where(Comment::MODEL_TYPE, get_class($this));
    }

    public function addComment(array $attributes)
    {
        $attributes[Comment::MODEL_TYPE] = get_class($this);
        return $this->comments()->create($attributes);
    }

    public function replyComment($commentId, array $attributes)
    {
        $comment = $this->comments()->findOrFail($commentId);
        $attributes[Comment::MODEL_TYPE] = get_class($this);
        $replyComment = $comment->replies()->create($attributes);
        return $replyComment;
    }

    public function rootComments()
    {
        return $this->comments()->where(Comment::REPLY_ID, 0);
    }

    public function likeComment($commentId)
    {
        return $this->comments()->findOrFail($commentId)->increment(Comment::TOTAL_LIKE);
    }

    public function unlikeComment($commentId)
    {
        $comment = $this->comments()->findOrFail($commentId);
        if($comment->total_like > 0) {
            return $comment->decrement(Comment::TOTAL_LIKE);
        }
        return false;
    }
}
