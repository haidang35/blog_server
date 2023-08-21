<?php

namespace Modules\Blog\Repositories\Blog;

use Modules\Base\Repositories\IBaseRepository;

interface IBlogRepository extends IBaseRepository
{
    public function findBySlug($slug);
}
