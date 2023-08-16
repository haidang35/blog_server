<?php

namespace Modules\Blog\Repositories\BlogCategory;

use Modules\Base\Repositories\BaseRepository;
use Modules\Blog\Entities\BlogCategory;

class BlogCategoryRepository extends BaseRepository implements IBlogCategoryRepository
{
    protected $model;

    public function __construct(BlogCategory $model)
    {
        $this->model = $model;
    }

    public function findAll()
    {
        return $this->model
            ->where(BlogCategory::PARENT_ID, 0)
            ->with(['children'])
            ->get();
    }
}
