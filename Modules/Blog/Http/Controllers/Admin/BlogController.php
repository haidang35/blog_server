<?php

namespace Modules\Blog\Http\Controllers\Admin;

use Modules\Base\Http\Controllers\ApiController;
use Modules\Blog\Http\Requests\Admin\Blog\CreateBlogRequest;
use Modules\Blog\Http\Requests\Admin\Blog\DeleteBlogsRequest;
use Modules\Blog\Http\Requests\Admin\Blog\GetBlogDetailsRequest;
use Modules\Blog\Http\Requests\Admin\Blog\GetBlogListRequest;
use Modules\Blog\Http\Requests\Admin\Blog\UpdateBlogRequest;
use Modules\Blog\Services\Blog\IBlogService;

class BlogController extends ApiController
{
    public function __construct(protected IBlogService $blogService)
    {
    }

    public function index(GetBlogListRequest $request)
    {
        $result = $this->blogService->getBlogList($request);
        return $this->handleResponse($result);
    }

    public function show(GetBlogDetailsRequest $request)
    {
        $result = $this->blogService->getBlogDetails($request);
        return $this->handleResponse($result);
    }

    public function create(CreateBlogRequest $request)
    {
        $result = $this->blogService->createBlog($request);
        return $this->handleResponse($result);
    }

    public function update(UpdateBlogRequest $request)
    {
        $result = $this->blogService->update($request);
        return $this->handleResponse($result);
    }

    public function delete($id)
    {
        $result = $this->blogService->delete($id);
        return $this->handleResponse($result);
    }

    public function deleteBlogs(DeleteBlogsRequest $request)
    {
        $result = $this->blogService->deleteBlogs($request);
        return $this->handleResponse($result);
    }
}
