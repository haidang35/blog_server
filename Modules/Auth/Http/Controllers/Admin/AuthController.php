<?php

namespace Modules\Auth\Http\Controllers\Admin;

use Illuminate\Http\Response;
use Illuminate\Validation\UnauthorizedException;
use Modules\Auth\Http\Requests\Admin\Auth\ForgotPasswordRequest;
use Modules\Auth\Http\Requests\Admin\Auth\GetMyAccountRequest;
use Modules\Auth\Http\Requests\Admin\Auth\LoginRequest;
use Modules\Auth\Http\Requests\Admin\Auth\RefreshTokenRequest;
use Modules\Auth\Http\Requests\Admin\Auth\ResetPasswordRequest;
use Modules\Auth\Http\Requests\Admin\Auth\VerifyResetPasswordRequest;
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
        if ($tokenData) {
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
        if ($account) {
            return $this->handleResponse($account);
        }
        throw new UnauthorizedException();
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $result = $this->authService->forgotPassword($request);

        if($result === Response::HTTP_BAD_REQUEST) {
            return $this->handleResponse(null, 400, 'Bạn đã gửi yêu cầu quá nhiều, hãy thử lại sau 5 phút nữa');
        }

        if ($result) {
            return $this->handleResponse();
        }
        return $this->handleResponse(null, 400, 'Bad Request');
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $result = $this->authService->resetPassword($request);
        if ($result) {
            return $this->handleResponse($result);
        }
        return $this->handleResponse(null, 500, 'Server Error');
    }

    public function verifyResetPassword(VerifyResetPasswordRequest $request)
    {
        $result = $this->authService->checkValidPasswordResetToken($request->email, $request->token);

        if ($result) {
            return $this->handleResponse();
        }
        return $this->handleResponse(null, 400, 'Bad Request');
    }
}
