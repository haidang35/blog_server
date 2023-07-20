<?php

namespace Modules\Auth\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Auth\Http\Requests\Admin\Permission\CreateNewPermissionRequest;
use Modules\Auth\Http\Requests\Admin\Permission\DeletePermissionRequest;
use Modules\Auth\Http\Requests\Admin\Permission\GetPermissionListRequest;
use Modules\Auth\Http\Requests\Admin\Permission\UpdatePermissionRequest;
use Modules\Auth\Services\IAuthService;
use Modules\Base\Http\Controllers\ApiController;

class PermissionController extends ApiController
{
    public function __construct(protected IAuthService $authService)
    {
    }

    public function getList(GetPermissionListRequest $request)
    {
        $result = $this->authService->getPermissionList($request);
        return $this->handleResponse($result);
    }

    public function create(CreateNewPermissionRequest $request)
    {
        $result = $this->authService->createNewPermission($request);
        return $this->handleResponse($result);
    }

    public function update($id, UpdatePermissionRequest $request)
    {
        $result = $this->authService->updatePermission($id, $request);
        return $this->handleResponse($result);
    }

    public function delete($id, DeletePermissionRequest $request)
    {
        $result = $this->authService->deletePermissionById($id);
        return $this->handleResponse($result);
    }
}
