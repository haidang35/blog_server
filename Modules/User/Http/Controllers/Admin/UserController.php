<?php

namespace Modules\User\Http\Controllers\Admin;

use Modules\Base\Http\Controllers\ApiController;
use Modules\User\Http\Requests\Admin\User\CreateUserRequest;
use Modules\User\Http\Requests\Admin\User\DeleteUsersRequest;
use Modules\User\Http\Requests\Admin\User\GetUserListRequest;
use Modules\User\Http\Requests\Admin\User\UpdateUserRequest;
use Modules\User\Services\User\IUserService;

class UserController extends ApiController
{
    public function __construct(protected IUserService $userService)
    {
    }

    public function getList(GetUserListRequest $request)
    {
        $result = $this->userService->findAll($request);
        return $this->handleResponse($result);
    }

    public function getDetails($id)
    {
        $result = $this->userService->findById($id);
        return $this->handleResponse($result);
    }

    public function create(CreateUserRequest $request)
    {
        $result = $this->userService->create($request);
        return $this->handleResponse($result);
    }

    public function update(UpdateUserRequest $request)
    {
        $result = $this->userService->update($request);
        return $this->handleResponse($result);
    }

    public function delete($id)
    {
        $result = $this->userService->deleteById($id);
        return $this->handleResponse();
    }

    public function deleteByIds(DeleteUsersRequest $request)
    {
        $result = $this->userService->deleteByIds($request->ids);
        return $this->handleResponse($result);
    }
}
