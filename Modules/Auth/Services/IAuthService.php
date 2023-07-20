<?php

namespace Modules\Auth\Services;

use Modules\Auth\Http\Requests\Admin\Auth\ForgotPasswordRequest;
use Modules\Auth\Http\Requests\Admin\Auth\GetMyAccountRequest;
use Modules\Auth\Http\Requests\Admin\Auth\LoginRequest;
use Modules\Auth\Http\Requests\Admin\Auth\RefreshTokenRequest;
use Modules\Auth\Http\Requests\Admin\Auth\ResetPasswordRequest;
use Modules\Auth\Http\Requests\Admin\Permission\CreateNewPermissionRequest;
use Modules\Auth\Http\Requests\Admin\Permission\DeletePermissionRequest;
use Modules\Auth\Http\Requests\Admin\Permission\GetPermissionListRequest;
use Modules\Auth\Http\Requests\Admin\Permission\UpdatePermissionRequest;
use Modules\Auth\Http\Requests\Admin\Role\AssigningPermissionsToRoleRequest;
use Modules\Auth\Http\Requests\Admin\Role\CreateNewRoleRequest;
use Modules\Auth\Http\Requests\Admin\Role\GetRoleListRequest;
use Modules\Auth\Http\Requests\Admin\Role\UpdateRoleRequest;

interface IAuthService
{
    public function login(LoginRequest $request);

    public function refreshToken(RefreshTokenRequest $request);

    public function getMyAccount(GetMyAccountRequest $request);

    public function forgotPassword(ForgotPasswordRequest $request);

    public function resetPassword(ResetPasswordRequest $request);

    public function checkValidPasswordResetToken($email, $token);

    public function getRoleList(GetRoleListRequest $request);

    public function createNewRole(CreateNewRoleRequest $request);

    public function updateRole($id, UpdateRoleRequest $request);

    public function deleteRoleById($id);

    public function getPermissionList(GetPermissionListRequest $request);

    public function createNewPermission(CreateNewPermissionRequest $request);

    public function deletePermissionById($id);

    public function updatePermission($id, UpdatePermissionRequest $request);

    public function assigningPermissionsToRole(AssigningPermissionsToRoleRequest $request);
}
