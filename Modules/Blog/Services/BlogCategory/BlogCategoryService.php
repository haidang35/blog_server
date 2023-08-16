<?php

namespace Modules\Blog\Services\BlogCategory;

use Illuminate\Support\Facades\DB;
use Modules\Base\Services\BaseService;
use Modules\Blog\Entities\BlogCategory;
use Modules\Blog\Http\Requests\Admin\BlogCategory\CreateBlogCategoryRequest;
use Modules\Blog\Http\Requests\Admin\BlogCategory\DeleteBlogCategoriesRequest;
use Modules\Blog\Http\Requests\Admin\BlogCategory\GetBlogCategoryListRequest;
use Modules\Blog\Http\Requests\Admin\BlogCategory\UpdateBlogCategoryRequest;
use Modules\Blog\Repositories\BlogCategory\IBlogCategoryRepository;

class BlogCategoryService extends BaseService implements IBlogCategoryService
{
    public function __construct(protected IBlogCategoryRepository $blogCategoryRepository)
    {
    }

    public function findAll(GetBlogCategoryListRequest $request)
    {
        $blogs = $this->blogCategoryRepository->findAll();
        return $this->formatTranslations($blogs->toArray(), [BlogCategory::NAME, BlogCategory::DESCRIPTION], 'children');
    }

    public function findById($id)
    {
        return $this->blogCategoryRepository->findById($id);
    }

    public function create(CreateBlogCategoryRequest $request)
    {
        $request->parent_id = $request->parent_id ?? 0;
        return $this->blogCategoryRepository->create($request->only([
            BlogCategory::PARENT_ID,
            BlogCategory::NAME,
            BlogCategory::DESCRIPTION,
        ]));
    }

    public function update(UpdateBlogCategoryRequest $request)
    {
        $category = $this->blogCategoryRepository->update($request->id, $request->only([
            BlogCategory::PARENT_ID,
            BlogCategory::NAME,
            BlogCategory::DESCRIPTION,
        ]));
        return $category;
    }

    public function deleteCategories(DeleteBlogCategoriesRequest $request)
    {
        DB::beginTransaction();
        try {
            $categories = BlogCategory::whereIn(BlogCategory::ID, $request->ids)->with(['children'])->get();
            $ids = $this->getValuesInTree($categories, 'children', 'id');
            $this->blogCategoryRepository->deleteByIds($ids);
            DB::commit();
            return true;
        }catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
