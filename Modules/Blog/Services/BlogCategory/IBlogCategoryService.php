<?php

namespace Modules\Blog\Services\BlogCategory;

use Modules\Blog\Http\Requests\Admin\BlogCategory\CreateBlogCategoryRequest;
use Modules\Blog\Http\Requests\Admin\BlogCategory\GetBlogCategoryListRequest;

interface IBlogCategoryService
{
    public function findAll(GetBlogCategoryListRequest $request);

    public function findById();

    public function create(CreateBlogCategoryRequest $request);

    public function update();

    public function deleteCategories();
}
