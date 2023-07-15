<?php

namespace Modules\Auth\Services;

use Modules\Auth\Http\Requests\Admin\GetMyAccountRequest;
use Modules\Auth\Http\Requests\Admin\LoginRequest;
use Modules\Auth\Http\Requests\Admin\RefreshTokenRequest;

interface IAuthService
{
    public function login(LoginRequest $request);

    public function refreshToken(RefreshTokenRequest $request);

    public function getMyAccount(GetMyAccountRequest $request);
}
