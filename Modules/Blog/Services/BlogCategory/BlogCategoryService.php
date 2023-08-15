<?php

namespace Modules\Blog\Services\BlogCategory;

use Modules\Base\Services\BaseService;
use Modules\Blog\Entities\BlogCategory;
use Modules\Blog\Http\Requests\Admin\BlogCategory\CreateBlogCategoryRequest;
use Modules\Blog\Http\Requests\Admin\BlogCategory\GetBlogCategoryListRequest;
use Modules\Blog\Repositories\BlogCategory\IBlogCategoryRepository;

class BlogCategoryService extends BaseService implements IBlogCategoryService
{
    public function __construct(protected IBlogCategoryRepository $blogCategoryRepository)
    {
    }

    public function findAll(GetBlogCategoryListRequest $request)
    {
        $filter = collect($request->filter)->map(function($item) {
            if(in_array($item['column'], [BlogCategory::NAME])) {
                $item['column'] = $item['column'] . '->' . app()->getLocale();
            }
            return $item;
        })->toArray();
        $blogs = $this->blogCategoryRepository->findAllWithFilter(
            $request->limit,
            $filter,
            $request->sort,
            [
                BlogCategory::ID,
                BlogCategory::NAME,
                BlogCategory::CREATED_AT,
                BlogCategory::UPDATED_AT
            ]
        )->toArray();
        $blogs['data'] = collect($blogs['data'])->map(function($value) {
            if(array_key_exists(app()->getLocale(), $value[BlogCategory::NAME])) {
                $value[BlogCategory::NAME] = $value[BlogCategory::NAME][app()->getLocale()];
            }else {
                $value[BlogCategory::NAME] = null;
            }
            return $value;
        });
        return $blogs;
    }

    public function findById()
    {
        // TODO: Implement findById() method.
    }

    public function create(CreateBlogCategoryRequest $request)
    {
        return $this->blogCategoryRepository->create($request->only([BlogCategory::NAME, BlogCategory::DESCRIPTION]));
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function deleteCategories()
    {
        // TODO: Implement deleteCategories() method.
    }
}
