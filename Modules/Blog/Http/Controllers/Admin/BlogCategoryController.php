<?php

namespace Modules\Blog\Http\Controllers\Admin;

use Modules\Base\Http\Controllers\ApiController;
use Modules\Blog\Http\Requests\Admin\BlogCategory\CreateBlogCategoryRequest;
use Modules\Blog\Http\Requests\Admin\BlogCategory\GetBlogCategoryListRequest;
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
}
