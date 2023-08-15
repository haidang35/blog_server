<?php

namespace Modules\Blog\Services\Blog;


use Modules\Blog\Http\Requests\Admin\Blog\CreateBlogRequest;
use Modules\Blog\Http\Requests\Admin\Blog\DeleteBlogsRequest;
use Modules\Blog\Http\Requests\Admin\Blog\GetBlogDetailsRequest;
use Modules\Blog\Http\Requests\Admin\Blog\GetBlogListRequest;
use Modules\Blog\Http\Requests\Admin\Blog\UpdateBlogRequest;

interface IBlogService
{
    public function getBlogList(GetBlogListRequest $request);

    public function getBlogDetails(GetBlogDetailsRequest $request);

    public function createBlog(CreateBlogRequest $request);

    public function update(UpdateBlogRequest $request);

    public function delete($id);
    public function deleteBlogs(DeleteBlogsRequest $request);
}
