<?php

namespace Modules\User\Http\Controllers;

use Modules\Base\Http\Controllers\ApiController;
use Modules\User\Services\User\IUserService;

class UserController extends ApiController
{
    public function __construct(protected IUserService $userService)
    {
    }
}
