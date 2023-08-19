<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Base\Http\Controllers\ApiController;
use Modules\Blog\Http\Requests\Public\Blog\GetBlogListRequest;
use Modules\Blog\Services\Blog\IBlogService;

class BlogController extends ApiController
{
    public function __construct(protected IBlogService $blogService)
    {
    }

    public function getBlogList(GetBlogListRequest $request)
    {
        $result = $this->blogService->getBlogListForClient($request);
        return $this->handleResponse($result);
    }

    public function getSingleBlog($slug)
    {
        $result = $this->blogService->findBySlug($slug);
        if(!$result) {
            return $this->handleResponse(null, 404, "Not Found");
        }
        return $this->handleResponse($result);
    }
}
