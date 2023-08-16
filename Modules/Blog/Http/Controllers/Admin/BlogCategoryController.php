<?php

namespace Modules\Blog\Http\Controllers\Admin;

use Modules\Base\Http\Controllers\ApiController;
use Modules\Blog\Http\Requests\Admin\BlogCategory\CreateBlogCategoryRequest;
use Modules\Blog\Http\Requests\Admin\BlogCategory\DeleteBlogCategoriesRequest;
use Modules\Blog\Http\Requests\Admin\BlogCategory\GetBlogCategoryListRequest;
use Modules\Blog\Http\Requests\Admin\BlogCategory\UpdateBlogCategoryRequest;
use Modules\Blog\Services\BlogCategory\IBlogCategoryService;

class BlogCategoryController extends ApiController
{
    public function __construct(protected IBlogCategoryService $blogCategoryService)
    {
    }

    public function index(GetBlogCategoryListRequest $request)
    {
        $result = $this->blogCategoryService->findAll($request);
        return $this->handleResponse($result);
    }

    public function create(CreateBlogCategoryRequest $request)
    {
        $result = $this->blogCategoryService->create($request);
        return $this->handleResponse($result);
    }

    public function update(UpdateBlogCategoryRequest $request)
    {
        $result = $this->blogCategoryService->update($request);
        return $this->handleResponse($result);
    }

    public function deleteCategories(DeleteBlogCategoriesRequest $request)
    {
        $result = $this->blogCategoryService->deleteCategories($request);
        return $this->handleResponse($result);
    }
}
