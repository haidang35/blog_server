<?php

namespace App\Http\Controllers;

use Modules\Base\Http\Controllers\ApiController;
use Modules\Blog\Entities\Blog;

class HomeController extends ApiController
{
    public function getSiteMap()
    {
        $blogs = Blog::select([
            Blog::SLUG,
            Blog::UPDATED_AT
        ])->get()->toArray();
        return $this->handleResponse($this->formatTranslations($blogs, [Blog::SLUG]));
    }
}
