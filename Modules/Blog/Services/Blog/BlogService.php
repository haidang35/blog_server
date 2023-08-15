<?php

namespace Modules\Blog\Services\Blog;


use Illuminate\Support\Facades\DB;
use Modules\Blog\Entities\Blog;
use Modules\Blog\Http\Requests\Admin\Blog\CreateBlogRequest;
use Modules\Blog\Http\Requests\Admin\Blog\DeleteBlogsRequest;
use Modules\Blog\Http\Requests\Admin\Blog\GetBlogDetailsRequest;
use Modules\Blog\Http\Requests\Admin\Blog\GetBlogListRequest;
use Modules\Blog\Http\Requests\Admin\Blog\UpdateBlogRequest;
use Modules\Blog\Repositories\Blog\IBlogRepository;

class BlogService implements IBlogService
{
    public function __construct(protected IBlogRepository $blogRepository)
    {
    }

    public function getBlogList(GetBlogListRequest $request)
    {
        $filter = collect($request->filter)->map(function($item) {
            if(in_array($item['column'], [Blog::TITLE])) {
                $item['column'] = $item['column'] . '->' . app()->getLocale();
            }
            return $item;
        })->toArray();
        $blogs = $this->blogRepository->findAllWithFilter(
            $request->limit,
            $filter,
            $request->sort,
            [
                Blog::UUID,
                Blog::TITLE,
                Blog::CREATED_AT,
                Blog::UPDATED_AT
            ]
        )->toArray();
        $blogs['data'] = collect($blogs['data'])->map(function($value) {
            if(array_key_exists(app()->getLocale(), $value[Blog::TITLE])) {
                $value[Blog::TITLE] = $value[Blog::TITLE][app()->getLocale()];
            }else {
                $value[Blog::TITLE] = null;
            }
            return $value;
        });
        return $blogs;
    }

    public function createBlog(CreateBlogRequest $request)
    {
        DB::beginTransaction();
        try {
            $blog = $this->blogRepository->create([
                Blog::TITLE => $request->get('title'),
                Blog::CONTENT => $request->get('content'),
            ]);
            $blog->syncFiles($request->get('files'));
            DB::commit();
            return $blog;
        }catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function getBlogDetails(GetBlogDetailsRequest $request)
    {
        return $this->blogRepository->findByUUID($request->id);
    }

    public function update(UpdateBlogRequest $request)
    {
        $blog = $this->blogRepository->findByUUID($request->id);
        $blog->update($request->only([Blog::TITLE, Blog::CONTENT]));
        return $blog;
    }

    public function delete($id)
    {
        try {
            $this->blogRepository->deleteByUUID($id);
            return true;
        }catch (\Exception $e) {
            return false;
        }
    }

    public function deleteBlogs(DeleteBlogsRequest $request)
    {
        try {
            $this->blogRepository->deleteByUUIDs($request->ids);
            return true;
        }catch (\Exception $e) {
            return false;
        }
    }
}
