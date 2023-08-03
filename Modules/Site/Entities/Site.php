<?php

namespace Modules\Site\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Base\Entities\BaseModel;
use Modules\Base\Traits\HandleSortFilter;
use Modules\Media\Entities\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Site extends BaseModel implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleSortFilter;


    const TABLE_NAME = 'sites';

    protected $table = self::TABLE_NAME;

    const ID = 'id';
    const NAME = 'name';
    const DOMAIN = 'domain';
    const UUID = 'uuid';

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Site\Database\factories\SiteFactory::new();
    }

    public function mediaItems()
    {
        return $this->hasMany(Media::class, Media::MODEL_ID, self::ID)
            ->where(Media::MODEL_TYPE, get_class($this));
    }

}
