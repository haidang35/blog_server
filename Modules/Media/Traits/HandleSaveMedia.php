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
        )->where(ModelHasMedia::MODEL_TYPE, get_class($this));
    }

    public function syncFiles($fileIds)
    {
        $syncList = [];
        foreach ($fileIds as $file) {
            $syncList[$file] = [
                ModelHasMedia::MODEL_TYPE => get_class($this),
            ];
        }
        return $this->files()->sync($syncList);
    }
}
