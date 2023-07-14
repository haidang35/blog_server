<?php

namespace Modules\Auth\Services;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\Http\Requests\Admin\GetMyAccountRequest;
use Modules\Auth\Http\Requests\Admin\LoginRequest;
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
            $token = Auth::user()->createToken('test')->plainTextToken;
            return [
                'token' => $token
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
}
