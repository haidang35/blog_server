<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Base\Http\Controllers\ApiController;
use Modules\Blog\Http\Requests\Public\Blog\AddCommentForBlogRequest;
use Modules\Blog\Http\Requests\Public\Blog\GetBlogListRequest;
use Modules\Blog\Http\Requests\Public\Blog\LikeCommentRequest;
use Modules\Blog\Http\Requests\Public\Blog\ReplyCommentForBlogRequest;
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

    public function getBlogComments($slug)
    {
        $result = $this->blogService->getBlogComments($slug);
        return $this->handleResponse($result);
    }

    public function postComment(AddCommentForBlogRequest $request)
    {
        $result = $this->blogService->postComment($request);
        return $this->handleResponse($result);
    }

    public function replyComment(ReplyCommentForBlogRequest $request)
    {
        $result = $this->blogService->replyComment($request);
        return $this->handleResponse($result);
    }

    public function likeComment(LikeCommentRequest $request)
    {
        $result = $this->blogService->likeComment($request);
        return $this->handleResponse($result);
    }
}
