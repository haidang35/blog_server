<?php

namespace Modules\Media\Entities;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Base\Traits\HandleFilterRecord;
use Modules\Site\Entities\Site;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    use HasFactory, HandleFilterRecord;

    const ID = 'id';
    const MODEL_ID = 'model_id';
    const MODEL_TYPE = 'model_type';

    protected static function newFactory()
    {
        return \Modules\Media\Database\factories\MediaFactory::new();
    }

    public function site()
    {
        return $this->belongsTo(Site::class, self::MODEL_ID, Site::ID);
    }

    /**
     * @return string
     */
    public function getOriginalUrl(): string
    {
        $appUrl = config('app.url');
        return  "{$appUrl}/media/storage/{$this->file_name}";
    }

    protected function originalUrl(): Attribute
    {
        return Attribute::get(fn () => $this->getOriginalUrl());
    }
}
