<?php

namespace Modules\Auth\Services;

use Modules\Auth\Http\Requests\Admin\GetMyAccountRequest;
use Modules\Auth\Http\Requests\Admin\LoginRequest;

interface IAuthService
{
    public function login(LoginRequest $request);

    public function getMyAccount(GetMyAccountRequest $request);
}
