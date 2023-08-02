<?php

namespace Modules\Site\Http\Controllers\Admin;

use Modules\Base\Http\Controllers\ApiController;
use Modules\Site\Services\Site\ISiteService;

class SiteController extends ApiController
{
    public function __construct(protected ISiteService $siteService)
    {
    }
}
