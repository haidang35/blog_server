<?php

namespace Modules\Blog\Repositories\Blog;

use Modules\Base\Repositories\BaseRepository;
use Modules\Blog\Entities\Blog;

class BlogRepository extends BaseRepository implements IBlogRepository
{
    public function __construct(Blog $model)
    {
        $this->model = $model;
    }

    public function findByUUID($id)
    {
        return $this->model
            ->with(['seoMeta'])
            ->findByUUID($id);
    }

    public function findBySlug($slug)
    {
        $locale = request()->header(config('client.headers.locale'), config('app.fallback_locale'));
        return $this->model->where("slug->{$locale}", $slug)->firstOrFail();
    }
}
