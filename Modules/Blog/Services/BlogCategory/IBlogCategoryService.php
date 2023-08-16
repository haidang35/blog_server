<?php

namespace Modules\Blog\Services\BlogCategory;

use Modules\Blog\Http\Requests\Admin\BlogCategory\CreateBlogCategoryRequest;
use Modules\Blog\Http\Requests\Admin\BlogCategory\DeleteBlogCategoriesRequest;
use Modules\Blog\Http\Requests\Admin\BlogCategory\GetBlogCategoryListRequest;
use Modules\Blog\Http\Requests\Admin\BlogCategory\UpdateBlogCategoryRequest;

interface IBlogCategoryService
{
    public function findAll(GetBlogCategoryListRequest $request);

    public function findById($id);

    public function create(CreateBlogCategoryRequest $request);

    public function update(UpdateBlogCategoryRequest $request);

    public function deleteCategories(DeleteBlogCategoriesRequest $request);
}
