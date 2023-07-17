<?php

namespace Modules\Auth\Services;

use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Modules\Auth\Emails\SendResetPasswordLink;
use Modules\Auth\Enums\TokenAbility;
use Modules\Auth\Http\Requests\Admin\ForgotPasswordRequest;
use Modules\Auth\Http\Requests\Admin\GetMyAccountRequest;
use Modules\Auth\Http\Requests\Admin\LoginRequest;
use Modules\Auth\Http\Requests\Admin\RefreshTokenRequest;
use Modules\Auth\Http\Requests\Admin\ResetPasswordRequest;
use Modules\Base\Services\BaseService;
use Modules\User\Entities\User;
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
        if (Auth::check()) {
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

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        DB::beginTransaction();
        try {
            $requestedToken = DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->first();
            $allowRequest = true;
            if ($requestedToken) {
                $allowRequest = Carbon::now()->greaterThan(Carbon::parse($requestedToken->created_at)->addMinutes(5));
            }

            if ($allowRequest) {
                DB::table('password_reset_tokens')
                    ->where('email', $request->email)
                    ->delete();

                $rawToken = Str::random(200);
                $passwordResetToken = DB::table('password_reset_tokens')
                    ->insert([
                        'email' => $request->email,
                        'token' => Hash::make($rawToken),
                        'created_at' => Carbon::now()
                    ]);

                $resetLink = $request->reset_password_url . "?email={$request->email}&token=" . $rawToken;
                Mail::to($request->email)->send(new SendResetPasswordLink($resetLink, $request->email));

                DB::commit();
                return $passwordResetToken;
            } else {
                return Response::HTTP_BAD_REQUEST;
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        DB::beginTransaction();
        try {
            $passwordResetToken = DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->first();
            if ($passwordResetToken
                && Hash::check($request->token, $passwordResetToken->token)
                && Carbon::now()->lessThan(Carbon::parse($passwordResetToken->created_at)
                    ->addMinutes(config('auth.passwords.users.expire')))
            ) {
                $user = User::where('email', $request->email)->firstOrFail();
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
                DB::table('password_reset_tokens')
                    ->where('email', $request->email)
                    ->delete();
                DB::commit();
                return true;
            }
            return false;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function checkValidPasswordResetToken($email, $token)
    {
        $resetPasswordToken = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->first();
        if ($resetPasswordToken && Hash::check($token, $resetPasswordToken->token)) {
            $createdAt = Carbon::parse($resetPasswordToken->created_at);
            return Carbon::now()->lessThan($createdAt->addMinutes(config('auth.passwords.users.expire')));
        }
        return false;
    }
}
