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
}
