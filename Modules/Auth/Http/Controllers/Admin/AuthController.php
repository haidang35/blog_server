<?php

namespace Modules\Auth\Http\Controllers\Admin;

use Illuminate\Validation\UnauthorizedException;
use Modules\Auth\Http\Requests\Admin\GetMyAccountRequest;
use Modules\Auth\Http\Requests\Admin\LoginRequest;
use Modules\Auth\Http\Requests\Admin\RefreshTokenRequest;
use Modules\Auth\Services\IAuthService;
use Modules\Base\Http\Controllers\ApiController;

class AuthController extends ApiController
{
    public function __construct(protected IAuthService $authService)
    {
    }

    public function login(LoginRequest $request)
    {
        $tokenData = $this->authService->login($request);
        if($tokenData) {
            return $this->handleResponse($tokenData);
        }
        throw new UnauthorizedException();
    }

    public function refreshToken(RefreshTokenRequest $request)
    {
        $result = $this->authService->refreshToken($request);
        return $this->handleResponse($result);
    }

    public function getMyAccount(GetMyAccountRequest $request)
    {
        $account = $this->authService->getMyAccount($request);
        if($account) {
            return $this->handleResponse($account);
        }
        throw new UnauthorizedException();
    }
}
