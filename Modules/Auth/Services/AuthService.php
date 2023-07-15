<?php

namespace Modules\Auth\Services;

use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\Enums\TokenAbility;
use Modules\Auth\Http\Requests\Admin\GetMyAccountRequest;
use Modules\Auth\Http\Requests\Admin\LoginRequest;
use Modules\Auth\Http\Requests\Admin\RefreshTokenRequest;
use Modules\Base\Services\BaseService;
use Modules\User\Repositories\User\IUserRepository;

class AuthService extends BaseService implements IAuthService
{
    public function __construct(protected IUserRepository $userRepository)
    {
    }

    public function login(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $accessToken = $user->createToken('accessToken', [TokenAbility::ACCESS_API->value], Carbon::now()->addMinutes(config('sanctum.expiration')))->plainTextToken;
            $refreshToken = $user->createToken('refreshToken', [TokenAbility::ISSUE_ACCESS_TOKEN->value], Carbon::now()->addMinutes(config('sanctum.rt_expiration')))->plainTextToken;
            return [
                'user_info' => $user,
                'access_token' => $accessToken,
                'refresh_token' => $refreshToken,
                'expires_at' => Carbon::now()->addMinutes(config('sanctum.expiration'))->format('Y:m:d H:i:s')
            ];
        }

        return false;
    }

    public function getMyAccount(GetMyAccountRequest $request)
    {
        if(Auth::check()) {
            $user = Auth::user();
            return $user;
        }
        return false;
    }

    public function refreshToken(RefreshTokenRequest $request)
    {
        $newAccessToken = Auth::user()->createToken('accessToken', [TokenAbility::ACCESS_API->value], Carbon::now()->addMinutes(config('sanctum.expiration')))->plainTextToken;
        return [
            'access_token' => $newAccessToken
        ];
    }
}
