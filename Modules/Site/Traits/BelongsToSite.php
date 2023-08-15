<?php

namespace Modules\Site\Traits;

use Modules\Site\Entities\Site;
use Modules\Site\Entities\SiteHasModel;
use Modules\Site\Scopes\FilterBySiteScope;

trait BelongsToSite
{
    public static function bootBelongsToSite()
    {
        static::created(function ($item) {
            $site = Site::where(Site::DOMAIN, request()->header(config('client.headers.domain')))->firstOrFail();
            SiteHasModel::create([
                SiteHasModel::MODEL_ID => $item->id,
                SiteHasModel::MODEL_TYPE => get_class(),
                SiteHasModel::SITE_ID => $site->id
            ]);
        });

        static::addGlobalScope(new FilterBySiteScope());
    }

    public function site()
    {
        return $this->belongsToMany(
            Site::class,
            SiteHasModel::class,
            SiteHasModel::MODEL_ID,
            SiteHasModel::SITE_ID,
            'id',
            Site::ID
        )->where(SiteHasModel::MODEL_TYPE, get_class());
    }
}
