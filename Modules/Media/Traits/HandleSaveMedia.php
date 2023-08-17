<?php

namespace Modules\Media\Traits;

use Modules\Media\Entities\Media;
use Modules\Media\Entities\ModelHasMedia;

trait HandleSaveMedia
{
    public function files()
    {
        return $this->belongsToMany(
            Media::class,
            ModelHasMedia::class,
            ModelHasMedia::MODEL_ID,
            ModelHasMedia::MEDIA_ID,
            self::ID,
            Media::ID,
        )->wherePivot(ModelHasMedia::MODEL_TYPE, get_class($this));
    }

    public function syncFiles($fileIds)
    {
        $syncList = [];
        foreach ($fileIds as $file) {
            $syncList[$file[ModelHasMedia::ID]] = [
                ModelHasMedia::MODEL_TYPE => get_class($this),
                ModelHasMedia::TYPE => $file[ModelHasMedia::TYPE],
            ];
        }
        return $this->files()->sync($syncList);
    }
}
