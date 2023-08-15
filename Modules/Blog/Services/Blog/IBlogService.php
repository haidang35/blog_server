<?php

namespace Modules\Blog\Services\Blog;


use Modules\Blog\Http\Requests\Admin\CreateBlogRequest;
use Modules\Blog\Http\Requests\Admin\DeleteBlogsRequest;
use Modules\Blog\Http\Requests\Admin\GetBlogDetailsRequest;
use Modules\Blog\Http\Requests\Admin\GetBlogListRequest;
use Modules\Blog\Http\Requests\Admin\UpdateBlogRequest;

interface IBlogService
{
    public function getBlogList(GetBlogListRequest $request);

    public function getBlogDetails(GetBlogDetailsRequest $request);

    public function createBlog(CreateBlogRequest $request);

    public function update(UpdateBlogRequest $request);

    public function delete($id);
    public function deleteBlogs(DeleteBlogsRequest $request);
}
