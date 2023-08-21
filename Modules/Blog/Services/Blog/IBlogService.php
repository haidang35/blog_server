<?php

namespace Modules\Blog\Services\Blog;


use Modules\Blog\Http\Requests\Admin\Blog\CreateBlogRequest;
use Modules\Blog\Http\Requests\Admin\Blog\DeleteBlogsRequest;
use Modules\Blog\Http\Requests\Admin\Blog\GetBlogDetailsRequest;
use Modules\Blog\Http\Requests\Admin\Blog\GetBlogListRequest;
use Modules\Blog\Http\Requests\Admin\Blog\UpdateBlogRequest;
use Modules\Blog\Http\Requests\Public\Blog\AddCommentForBlogRequest;
use Modules\Blog\Http\Requests\Public\Blog\ReplyCommentForBlogRequest;

interface IBlogService
{
    public function getBlogList(GetBlogListRequest $request);

    public function getBlogDetails(GetBlogDetailsRequest $request);

    public function createBlog(CreateBlogRequest $request);

    public function update(UpdateBlogRequest $request);

    public function delete($id);
    public function deleteBlogs(DeleteBlogsRequest $request);

    public function getBlogListForClient(\Modules\Blog\Http\Requests\Public\Blog\GetBlogListRequest $request);

    public function findBySlug($slug);

    public function getBlogComments($slug);

    public function postComment(AddCommentForBlogRequest $request);

    public function replyComment(ReplyCommentForBlogRequest $request);
}
