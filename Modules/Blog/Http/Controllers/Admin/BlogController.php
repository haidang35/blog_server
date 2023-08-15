<?php

namespace Modules\Blog\Http\Controllers\Admin;

use Modules\Base\Http\Controllers\ApiController;
use Modules\Blog\Http\Requests\Admin\CreateBlogRequest;
use Modules\Blog\Http\Requests\Admin\DeleteBlogsRequest;
use Modules\Blog\Http\Requests\Admin\GetBlogDetailsRequest;
use Modules\Blog\Http\Requests\Admin\GetBlogListRequest;
use Modules\Blog\Http\Requests\Admin\UpdateBlogRequest;
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
