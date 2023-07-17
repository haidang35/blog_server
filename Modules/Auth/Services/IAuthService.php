<?php

namespace Modules\Auth\Services;

use Modules\Auth\Http\Requests\Admin\ForgotPasswordRequest;
use Modules\Auth\Http\Requests\Admin\GetMyAccountRequest;
use Modules\Auth\Http\Requests\Admin\LoginRequest;
use Modules\Auth\Http\Requests\Admin\RefreshTokenRequest;
use Modules\Auth\Http\Requests\Admin\ResetPasswordRequest;

interface IAuthService
{
    public function login(LoginRequest $request);

    public function refreshToken(RefreshTokenRequest $request);

    public function getMyAccount(GetMyAccountRequest $request);

    public function forgotPassword(ForgotPasswordRequest $request);

    public function resetPassword(ResetPasswordRequest $request);

    public function checkValidPasswordResetToken($email, $token);
}
