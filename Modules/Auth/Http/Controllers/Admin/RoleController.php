<?php

namespace Modules\Auth\Http\Controllers\Admin;

use Modules\Auth\Http\Requests\Admin\Role\AssigningPermissionsToRoleRequest;
use Modules\Auth\Http\Requests\Admin\Role\CreateNewRoleRequest;
use Modules\Auth\Http\Requests\Admin\Role\DeleteRoleRequest;
use Modules\Auth\Http\Requests\Admin\Role\GetRoleListRequest;
use Modules\Auth\Http\Requests\Admin\Role\UpdateRoleRequest;
use Modules\Auth\Services\IAuthService;
use Modules\Base\Http\Controllers\ApiController;

class RoleController extends ApiController
{
    public function __construct(protected IAuthService $authService)
    {
    }

    public function getList(GetRoleListRequest $request)
    {
        $result = $this->authService->getRoleList($request);
        return $this->handleResponse($result);
    }

    public function create(CreateNewRoleRequest $request)
    {
        $result = $this->authService->createNewRole($request);
        return $this->handleResponse($result);
    }

    public function update($id, UpdateRoleRequest $request)
    {
        $result = $this->authService->updateRole($id, $request);
        return $this->handleResponse($result);
    }

    public function delete($id, DeleteRoleRequest $request)
    {
        $result = $this->authService->deleteRoleById($id);
        return $this->handleResponse($result);
    }

    public function assigningPermissionsToRole(AssigningPermissionsToRoleRequest $request)
    {
        $result = $this->authService->assigningPermissionsToRole($request);
        return $this->handleResponse($result);
    }
}
