<?php

namespace Modules\SeoMeta\Traits;

use Modules\SeoMeta\Entities\SEOMeta;

trait HasSEOMeta
{
    public function seoMeta()
    {
        return $this->hasMany(
            SEOMeta::class,
            SEOMeta::MODEL_ID,
            self::ID
        )->where(SEOMeta::MODEL_TYPE, get_class($this));
    }

    public function syncSEOMeta($attributes = [])
    {
        $seoMeta = SEOMeta::where(SEOMeta::MODEL_ID, $this->id)
                        ->where(SEOMeta::MODEL_TYPE, get_class($this))->first();
        if($seoMeta) {
            return $seoMeta->update($attributes);
        }
        $attributes[SEOMeta::MODEL_TYPE] = get_class($this);
        return $this->seoMeta()->create($attributes);
    }
}
