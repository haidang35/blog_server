<?php

namespace Modules\Blog\Services\Blog;

use Illuminate\Support\Facades\DB;
use Intervention\Image\Exception\NotFoundException;
use Modules\Base\Services\BaseService;
use Modules\Blog\Entities\Blog;
use Modules\Blog\Http\Requests\Admin\Blog\CreateBlogRequest;
use Modules\Blog\Http\Requests\Admin\Blog\DeleteBlogsRequest;
use Modules\Blog\Http\Requests\Admin\Blog\GetBlogDetailsRequest;
use Modules\Blog\Http\Requests\Admin\Blog\GetBlogListRequest;
use Modules\Blog\Http\Requests\Admin\Blog\UpdateBlogRequest;
use Modules\Blog\Repositories\Blog\IBlogRepository;
use Modules\Media\Entities\ModelHasMedia;
use Modules\SeoMeta\Entities\SEOMeta;

class BlogService extends BaseService implements IBlogService
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
                Blog::ID,
                Blog::UUID,
                Blog::TITLE,
                Blog::CREATED_AT,
                Blog::UPDATED_AT
            ]
        )->toArray();
        $blogs['data'] = $this->formatTranslations($blogs['data'], [
            Blog::TITLE,
        ]);
        return $blogs;
    }

    public function createBlog(CreateBlogRequest $request)
    {
        DB::beginTransaction();
        try {
            $blog = $this->blogRepository->create([
                Blog::TITLE => $request->get('title'),
                Blog::CONTENT => $request->get('content'),
                Blog::DESCRIPTION => $request->get('description'),
            ]);
            $blog->categories()->sync($request->categories ?? []);
            $files = $request->get('files');
            $files = collect($files)->map(function($file) {
                $newFile[ModelHasMedia::ID] = $file;
                $newFile[ModelHasMedia::TYPE] = Blog::MEDIA_TYPE_THUMBNAIL;
               return $newFile;
            });
            $blog->syncFiles($files);
            $seoMeta = $request->seo_meta;
            $keywords = &$seoMeta['keywords'];
            $keywords = is_array($keywords) ? implode(',', $keywords) : $keywords;
            $blog->syncSEOMeta([
                SEOMeta::META_TITLE => &$seoMeta['title'],
                SEOMeta::META_DESCRIPTION => &$seoMeta['description'],
                SEOMeta::META_KEYWORDS => $keywords,
                SEOMeta::META_ROBOTS => &$seoMeta['robots'],
            ]);
            DB::commit();
            return $blog;
        }catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function getBlogDetails(GetBlogDetailsRequest $request)
    {
        $blog = $this->blogRepository->findByUUID($request->id);
        $blog['category_ids'] = $blog->categoryIds();
        return $this->formatTranslationsForObject($blog->toArray(), [Blog::TITLE, Blog::CONTENT, Blog::DESCRIPTION]);
    }

    public function update(UpdateBlogRequest $request)
    {
        $blog = $this->blogRepository->findByUUID($request->id);
        $blog->update([
            Blog::TITLE => $request->get('title'),
            Blog::CONTENT => $request->get('content'),
            Blog::DESCRIPTION => $request->get('description'),
        ]);
        $blog->categories()->sync($request->categories ?? []);
        $files = $request->get('files');
        $files = collect($files)->map(function($file) {
            $newFile[ModelHasMedia::ID] = $file;
            $newFile[ModelHasMedia::TYPE] = Blog::MEDIA_TYPE_THUMBNAIL;
            return $newFile;
        });
        $blog->syncFiles($files);
        $seoMeta = $request->seo_meta;
        $keywords = &$seoMeta['keywords'];
        $keywords = is_array($keywords) ? implode(',', $keywords) : $keywords;
        $blog->syncSEOMeta([
            SEOMeta::META_TITLE => &$seoMeta['title'],
            SEOMeta::META_DESCRIPTION => &$seoMeta['description'],
            SEOMeta::META_KEYWORDS => $keywords,
            SEOMeta::META_ROBOTS => &$seoMeta['robots'],
        ]);
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

    public function getBlogListForClient(\Modules\Blog\Http\Requests\Public\Blog\GetBlogListRequest $request)
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
                Blog::ID,
                Blog::UUID,
                Blog::SLUG,
                Blog::TITLE,
                Blog::DESCRIPTION,
                Blog::CONTENT,
                Blog::CREATED_AT,
            ]
        )->toArray();
        $blogs['data'] = $this->formatTranslations($blogs['data'], [
            Blog::TITLE,
            Blog::DESCRIPTION,
            Blog::CONTENT,
            Blog::SLUG,
        ]);
        return $blogs;
    }

    public function findBySlug($slug)
    {
        $blog = Blog::findBySlug($slug);
        if(!$blog) {
            throw new NotFoundException();
        }
        $blog['seo_meta'] = $blog->seoMeta();
        $relatedBlogs = Blog::latest()
            ->select([
                Blog::ID,
                Blog::TITLE,
                Blog::SLUG,
                Blog::CREATED_AT,
            ])
            ->whereNotIn(Blog::ID, [$blog->id])
            ->take(3)
            ->get()->toArray();
        $blog['suggested_blogs'] = $this->formatTranslations($relatedBlogs, [Blog::TITLE, Blog::SLUG]);
        return $this->formatTranslationsForObject($blog->toArray(), [
            Blog::TITLE,
            Blog::DESCRIPTION,
            Blog::CONTENT,
            Blog::SLUG,
        ]);
    }
}
